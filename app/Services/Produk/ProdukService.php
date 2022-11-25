<?php

namespace App\Services\Produk;

use App\Repositories\KategoriPelanggan\KategoriPelangganRepository;
use App\Repositories\Produk\ProdukRepository;
use App\Repositories\ProdukVarian\ProdukVarianRepository;
use App\Repositories\ProdukVarianHarga\ProdukVarianHargaRepository;

class ProdukService implements IProdukService
{
  private $produkRepo;
  private $produkVarianRepo;
  private $produkVarianHargaRepo;
  private $kategoriPelangganRepo;
  private $column;

  public function __construct()
  {
    $this->produkRepo = new ProdukRepository();
    $this->produkVarianRepo = new ProdukVarianRepository();
    $this->produkVarianHargaRepo = new ProdukVarianHargaRepository();
    $this->kategoriPelangganRepo = new KategoriPelangganRepository();

    $column = $this->produkRepo->produkSelect;
    foreach ($column as $i => $item) {
      $split = explode(' as ', $item);
      $column[$i] = $item;
      if (count($split) > 0) {
        $column[$i] = $split[0];
      }
    }
    $this->column = $column;
  }

  private function _queryDataTable($search, $order)
  {
    $id = $this->produkRepo->produkSelect[0];
    $column_order = $this->column; //field yang ada di table user
    $column_search = $this->column; //field yang diizin untuk pencarian
    $order_by = [$id => 'asc']; // default order

    $query = $this->produkRepo->getActive();

    $query = datatableQuery($query, $search, $column_search, $column_order, $order, $order_by);

    return $query;
  }

  public function getDataTable($request)
  {
    $search = $request->search;
    $order = $request->order;
    $length = $request->length;
    $start = $request->start;
    $draw = $request->draw;

    $query = $this->_queryDataTable($search, $order);
    if ($length != -1) {
      $query = $query->limit($length, $start);
    }
    $query = $query->get();

    $list = $query->getResult();
    $countFilltered = $query->getNumRows();
    $countAll = $this->produkRepo->getActive()
      ->get()
      ->getNumRows();

    foreach ($list as $i => $v) {
      $start++;
      $list[$i]->no = $start;
    }

    $response = [
      "draw" => $draw,
      "recordsTotal" => $countFilltered,
      "recordsFiltered" => $countAll,
      "data" => $list,
    ];


    return $response;
  }

  public function getProduks()
  {
    return $this->produkRepo->getActive();
  }

  public function saveData($post)
  {
    $message = 'Data berhasil disimpan';
    $produkData = [
      'id' => $post['id'],
      'kategori_produk_id' => $post['kategori_produk_id'],
      'jenis_produk_id' => $post['jenis_produk_id'],
      'supplier_id' => $post['supplier_id'],
      'gudang_id' => $post['gudang_id'],
      'nama' => $post['nama'],
      'keterangan' => $post['keterangan'],
      'tempo_kedatangan' => $post['tempo_kedatangan'],
    ];

    if (isset($_FILES['produkFile'])) {
      $file = $_FILES['produkFile'];
      $filename = $file['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $upload_location = './uploads/produk/';

      $new_name = time() . '.' . $ext;
      $path = $upload_location . $new_name;
      if (move_uploaded_file($_FILES['produkFile']['tmp_name'], $path)) {
        $produkData['image'] = $new_name;
      }
    }

    if ((int)$produkData['id'] > 0) {
      $message = 'Data berhasil diubah';
      $produkData['updated_at'] = date('Y-m-d H:i:s');
      $produkData['updated_by'] = session()->get('user_id');
    } else {
      $produkData['created_by'] = session()->get('user_id');
    }
    $produk_id = $this->produkRepo->save($produkData);

    $varians = json_decode($post['varians']);
    foreach ($varians as $i => $varian) {
      $varian = (array) $varian;
      $varianData = [
        'produk_id' => $produk_id,
        'id' => $varian['id'],
        'code' => $varian['code'],
        'warna' => $varian['warna'],
        'ukuran' => $varian['ukuran'],
        'berat' => $varian['berat'],
        'harga_beli' => (int) str_replace(',', '', $varian['code']),
        'stok' => $varian['stok'],
      ];

      if (isset($_FILES['varianFile_' . $i])) {
        $file = $_FILES['varianFile_' . $i];
        $filename = $file['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $upload_location = './uploads/varian/';

        $new_name = time() . '.' . $ext;
        $path = $upload_location . $new_name;
        if (move_uploaded_file($_FILES['varianFile_' . $i]['tmp_name'], $path)) {
          $varianData['image'] = $new_name;
        }
      }

      if ((int)$varianData['id'] > 0) {
        $message = 'Data berhasil diubah';
        $varianData['updated_at'] = date('Y-m-d H:i:s');
        $varianData['updated_by'] = session()->get('user_id');
      } else {
        $varianData['created_by'] = session()->get('user_id');
      }
      $varian_id = $this->produkVarianRepo->save($varianData);
      $varians[$i]->id = $varian_id;

      $keys = array_keys($varian);
      foreach ($keys as $key) {
        $checkPelanggan = $this->kategoriPelangganRepo->getById((int) $key)->get()->getRow();
        if (!empty($checkPelanggan)) {
          $hargaData = [
            'produk_varian_id' => $varian_id,
            'kategori_pelanggan_id' => $key,
            'harga' => (int) str_replace(',', '', $varian[$key])
          ];
          $checkHarga = $this->produkVarianHargaRepo->getByVarianKategoriPelanggan($varian_id, $key)->get()->getRow();
          if (empty($checkHarga)) {
            $hargaData['created_by'] = session()->get('user_id');
          } else {
            $hargaDatap['id'] = $checkHarga->id;
            $hargaData['updated_at'] = date('Y-m-d H:i:s');
            $hargaData['updated_by'] = session()->get('user_id');
          }
          $this->produkVarianHargaRepo->save($hargaData);
        }
      }
      $hargaDbs = $this->produkVarianHargaRepo->getByVarian($varian_id)->get()->getResult();
      foreach ($hargaDbs as $hargaDb) {
        if (!in_array($hargaDb->kategori_pelanggan_id, $keys)) {
          $hargaDb->is_active = false;
          $this->produkVarianHargaRepo->save((array) $hargaDb);
        }
      }
    }

    $varianDbs = $this->produkVarianRepo
      ->getByProduk($produk_id)
      ->get()
      ->getResult();
    foreach ($varianDbs as $varianDb) {
      $checkVarian = in_array($varianDb->id, array_column($varians, 'id'));
      if (!$checkVarian) {
        $varianDb->is_active = false;
        $this->produkVarianRepo->save((array) $varianDb);
      }
    }

    $response = [
      'status' => true,
      'message' => $message
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->produkRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }

  public function getProdukVarians($request)
  {
    $varians = $this->produkVarianRepo
      ->getByProduk($request->produk_id)
      ->get()
      ->getResult();
    $varianIds = array_column($varians, 'id');
    $varianHargas = $this->produkVarianHargaRepo->getInVarians($varianIds)
      ->get()
      ->getResult();
    foreach ($varians as $i => $varian) {
      $varian = (array)$varian;
      $hargas = array_filter($varianHargas, function ($obj) use ($varian) {
        if ($obj->produk_varian_id === $varian['id']) return true;
      });
      foreach ($hargas as $harga) {
        $varian[$harga->pelanggan_id] = $harga->harga;
      }
      $varians[$i] = $varian;
    }
    $kategoris = [];
    foreach ($varianHargas as $item) {
      if (!in_array($item->pelanggan_id, array_column($kategoris, 'id')))
        array_push($kategoris, [
          'id' => $item->pelanggan_id,
          'nama' => $item->nama
        ]);
    }

    $response = [
      'kategoris' => $kategoris,
      'varians' => $varians
    ];

    return $response;
  }
}
