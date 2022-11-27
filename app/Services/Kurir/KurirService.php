<?php

namespace App\Services\Kurir;

use App\Repositories\Kurir\KurirRepository;
use App\Repositories\Pengiriman\PengirimanRepository;
use Config\Database;

class KurirService implements IKurirService
{
    private $kurirRepo;
    private $pengirimanRepo;

    public function __construct()
    {
        $this->kurirRepo = new KurirRepository();
        $this->pengirimanRepo = new PengirimanRepository();
    }

    private function _queryDataTable($search, $order)
    {
        $column_order = ['id', 'nama']; //field yang ada di table user
        $column_search = ['id', 'nama']; //field yang diizin untuk pencarian
        $order_by = ['id' => 'asc']; // default order

        $query = $this->kurirRepo->getActive();

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
        $countAll = $this->kurirRepo->getActive()
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

    public function findLayanans($request)
    {
        return $this->pengirimanRepo->findByKurir($request->search_data);
    }

    public function getLayanans($request)
    {
        return $this->pengirimanRepo->getByKurir($request->kurir_id);
    }

    public function saveData($post)
    {
        $message = 'Data berhasil disimpan';
        $kurir = [
        'id' => $post['id'],
        'nama' => $post['nama']
        ];
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $upload_location = './uploads/kurir/';

            $new_name = time() . '.' . $ext;
            $path = $upload_location . $new_name;
            if (move_uploaded_file($file['tmp_name'], $path)) {
                $kurir['image'] = $new_name;
            }
        }

        if ((int)$kurir['id'] > 0) {
            $message = 'Data berhasil diubah';
            $kurir['updated_at'] = date('Y-m-d H:i:s');
        } else {
            $kurir['created_by'] = session()->get('user_id');
        }

        $db = Database::connect();
        $db->transStart();
        $kurir_id = $this->kurirRepo->save($kurir);
        $kurir_id = $kurir_id === 0 ? $kurir['id'] : $kurir_id;

        $layanans = json_decode($post['layanans']);
        foreach ($layanans as $i => $item) {
            $item = (array) $item;
            $layanan = [
            'id' => $item['id'],
            'kurir_id' => $kurir_id,
            'nama' => $item['nama']
            ];

            if ((int)$layanan['id'] > 0) {
                $message = 'Data berhasil diubah';
                $layanan['updated_at'] = date('Y-m-d H:i:s');
            } else {
                $layanan['created_by'] = session()->get('user_id');
            }

            $layanan_id = $this->pengirimanRepo->save($layanan);
            $layanan_id = $layanan_id === 0 ? $layanan['id'] : $layanan_id;
            $layanans[$i]->id = $layanan_id;
        }

        $layananDbs = $this->pengirimanRepo
            ->getByKurir($kurir_id);

        foreach ($layananDbs as $layananDb) {
            $checkLayanan = in_array($layananDb->id, array_column($layanans, 'id'));
            if (!$checkLayanan) {
                $layananDb->is_active = false;
                $this->pengirimanRepo->save((array) $layananDb);
            }
        }
        $db->transComplete();

        $response = [
        'status' => true,
        'message' => $message
        ];

        return $response;
    }

    public function removeData($data)
    {
        $data['is_active'] = false;
        $db = Database::connect();
        $db->transStart();

        $this->kurirRepo->save($data);
        $this->pengirimanRepo->removeByKurir($data['id']);

        $db->transComplete();

        $response = [
        'status' => true,
        'message' => 'Data berhasil dihapus'
        ];

        return $response;
    }
}
