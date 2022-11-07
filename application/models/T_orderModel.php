<?php

class t_orderModel extends CI_Model
{
  public function getOrderID($status_id, $limit, $start)
  {
    $status_id = $status_id ? $status_id : '1';
    $this->db->select("t_order.id");
    $this->db->from('m_order_status m_order_status');
    $this->db->from('m_pelanggan m_pelanggan');
    $this->db->order_by('t_order.id DESC');
    $this->db->where("t_order.status_data != 'deleted' AND t_order.m_order_status_id = m_order_status.id AND t_order.m_order_status_id='$status_id'");
    $this->db->where("m_pelanggan.id = t_order.m_pelanggan_id");

    if ($this->input->get('key')) {
      $search_option = $this->input->get('search_option', true);
      $key = $this->input->get('key', true);
      if ($search_option == "id") {
        $this->db->like('t_order.id', $key);
      } else if ($search_option == "nama_customer") {
        $this->db->like('m_pelanggan.name', $key);
      }
    }
    $get_table = $this->db->get('t_order t_order', $limit, $start);
    return $get_table;
  }

  public function getTable($id)
  {
    $status_order = $this->input->post('status_order', true);
    $status_order = $status_order ? $status_order : "unpaid";
    $this->db->select("t_order.id, t_order.code, t_order.note, t_order.status_pembayaran, t_order.grandtotal, t_order.no_resi, t_order.biaya_kurir, t_order.total_berat,m_order_status.name AS status_order, t_order.tanggal_order, t_order.estimasi_pengiriman, m_kurir.id AS kurir_id, m_kurir.name AS kurir, m_kurir.image_url, (SELECT COUNT(*) FROM t_order_detail WHERE t_order_id = t_order.id) AS count_order, m_pelanggan.name AS nama_pelanggan, (SELECT name from m_kategori_pelanggan WHERE id = m_pelanggan.m_kategori_pelanggan_id) AS kategori_pelanggan, kirim.name AS nama_kirim, (SELECT name from m_kategori_pelanggan WHERE id = kirim.m_kategori_pelanggan_id) AS kategori_kirim, (SELECT name FROM m_user WHERE id = t_order.m_user_id) AS nama_user, (SELECT SUM(nominal) FROM t_order_pembayaran WHERE t_order_id = t_order.id) AS total_bayar, (SELECT COUNT(m_produk_varian_id) FROM t_order_detail WHERE t_order_id = t_order.id) AS jumlah_order");
    $this->db->from('m_order_status m_order_status');
    $this->db->from('m_kurir m_kurir');
    $this->db->from('m_pelanggan m_pelanggan');
    $this->db->from('m_pelanggan kirim');
    $this->db->order_by('t_order.id DESC');
    $this->db->where("t_order.status_data != 'deleted' AND t_order.m_order_status_id = m_order_status.id AND t_order.m_kurir_id = m_kurir.id");
    $this->db->where("m_pelanggan.id = t_order.m_pelanggan_id AND kirim.id = t_order.m_pelanggan_id_pengiriman");
    $array = $this->result_toarray($id);
    $this->db->where_in('t_order.id', $array);

    $get_table = $this->db->get('t_order t_order');
    return $get_table->result_array();
  }

  public function getOrderDetail($id)
  {
    $this->db->select("m_produk.id, t_order_detail.t_order_id, t_order_detail.qty, m_produk.name, m_jenis_produk.name AS jenis_produk, m_produk_varian.warna, m_produk_varian.ukuran");
    $this->db->from('m_produk_varian m_produk_varian');
    $this->db->from('m_produk m_produk');
    $this->db->from('m_jenis_produk m_jenis_produk');
    $this->db->where("t_order_detail.m_produk_varian_id = m_produk_varian.id AND m_produk_varian.m_produk_id = m_produk.id AND m_produk.m_jenis_produk_id = m_jenis_produk.id");

    $array = $this->result_toarray($id);
    $this->db->where_in('t_order_detail.t_order_id', $array);

    if ($this->input->post('key')) {
      $search_option = $this->input->post('search_option', true);
      $key = $this->input->post('key', true);
      if ($search_option == "name") {
        $this->db->like('m_produk.name', $key);
      } else if ($search_option == "supplier") {
        $this->db->like('m_supplier.name', $key);
      }
    }
    $get_table = $this->db->get('t_order_detail t_order_detail');
    return $get_table->result_array();
  }

  public function result_toarray($id)
  {
    if ($id->num_rows() != 0) {
      $i = 1;
      foreach ($id->result() as $row) {
        $array[] = $row->id;
      }
    } else {
      $array[] = -1;
    }
    return $array;
  }

  public function getProduk($key = "", $m_kategori_pelanggan_id = "")
  {
    if ($key) {
      $this->db->distinct('m_produk_varian.id');
      $this->db->select("m_produk.id, m_produk_varian.id AS varian_id, m_produk.name, m_produk.tempo_kedatangan_barang, m_produk_varian.ukuran, m_produk_varian.warna, m_produk_varian.stok, m_produk_varian.berat, (SELECT name FROM m_jenis_produk WHERE id = m_produk.m_jenis_produk_id) AS jenis_produk, m_produk_varian_harga.harga, (SELECT image_url FROM m_produk_varian_image WHERE m_produk_varian_id = m_produk_varian.id) AS image_url");
      $this->db->from('m_produk_varian m_produk_varian');
      $this->db->from('m_produk_varian_harga m_produk_varian_harga');
      $this->db->order_by("m_produk.name = '$key' DESC");
      $this->db->where("m_produk.status_data != 'deleted' AND m_produk.id = m_produk_varian.m_produk_id AND m_produk_varian.status_data != 'deleted'");
      $this->db->where("m_produk_varian.id = m_produk_varian_harga.m_produk_varian_id AND m_produk_varian_harga.m_kategori_pelanggan_id = '$m_kategori_pelanggan_id'");
      $array_key = explode(' ', $key);
      $like = "";
      foreach ($array_key as $key => $value) {
        if ($key == 0) {
          $like = "CONCAT(m_produk.name, ' ', m_produk_varian.ukuran, ' ', m_produk_varian.warna) LIKE '%$value%'";
        } else {
          $like = $like . " OR CONCAT(m_produk.name, ' ', m_produk_varian.ukuran, ' ', m_produk_varian.warna) LIKE '%$value%'";
        }
      }
    }
    $this->db->where("($like)");
    $get_table = $this->db->get('m_produk m_produk', 10);
    return $get_table->result_array();
  }

  public function countAllData($status_id)
  {
    $status_id = $status_id ? $status_id : '1';
    $get_table = $this->db->get_where('t_order t_order', "t_order.status_data != 'deleted' AND t_order.m_order_status_id = '$status_id'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_produk.name', $key);
    }
    return $get_table->num_rows();
  }

  public function getCustomer($key)
  {
    $this->db->select("m_pelanggan.id, m_pelanggan.name, m_pelanggan.alamat, m_kelurahan_desa.nama_propinsi, m_kelurahan_desa.jenis_kabupaten_kota, m_kelurahan_desa.nama_kabupaten_kota, m_kelurahan_desa.nama_kecamatan, m_kelurahan_desa.nama_kelurahan_desa, m_kelurahan_desa.kode_pos");
    $this->db->like('m_pelanggan.name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $this->db->from('m_kelurahan_desa m_kelurahan_desa');
    $this->db->where("m_pelanggan.status_data != 'deleted' AND m_pelanggan.m_kelurahan_desa_id = m_kelurahan_desa.id");
    $get_table = $this->db->get('m_pelanggan m_pelanggan');
    return $get_table->result();
  }

  public function getId($id)
  {
    $this->db->select("m_produk.id, m_produk.name, m_produk.m_supplier_id, m_produk.tempo_kedatangan_barang, m_produk.m_kategori_produk_id, m_produk.m_jenis_produk_id, m_produk.keterangan, m_produk.image_url, m_produk.status_data, (SELECT name FROM m_jenis_produk WHERE id = m_produk.m_jenis_produk_id) AS jenis_produk, m_kategori_produk.name as kategori_produk, CONCAT(m_supplier.name, ' (', m_supplier.code, ' )') as nama_supplier, (SELECT COUNT(id) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS count_varian, (SELECT MAX(id) FROM m_produk_varian WHERE m_produk_id = m_produk.id) AS max_id_varian, (SELECT SUM(stok) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS stok");
    $this->db->from('m_kategori_produk m_kategori_produk');
    $this->db->from('m_supplier m_supplier');
    $this->db->order_by('m_produk.id DESC');
    $this->db->where("m_produk.status_data != 'deleted' AND m_produk.id='$id'");
    $this->db->where('m_produk.m_kategori_produk_id = m_kategori_produk.id');
    $this->db->where('m_produk.m_supplier_id = m_supplier.id');
    $get_table = $this->db->get('m_produk m_produk');
    return $get_table->row_array();
  }


  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('m_produk', $data);
  }

  public function getSupplier($key = "")
  {
    $this->db->select("id, CONCAT(name, ' (', code, ' )') AS name");
    $this->db->order_by('name ASC');
    $this->db->like("CONCAT(name, ' (', code, ' )')", $key);
    $get_table = $this->db->get('m_supplier', 10);
    return $get_table->result_array();
  }

  public function getKurir()
  {
    $this->db->select("id, CONCAT(name, ' (', kategori, ')') AS name, image_url");
    $this->db->order_by('id ASC');
    $get_table = $this->db->get('m_kurir');
    return $get_table->result_array();
  }

  public function getBank()
  {
    $this->db->select("id, CONCAT(bank_code, ' - ', atas_nama, '') AS name, no_rekening, image_url");
    $this->db->order_by('id ASC');
    $get_table = $this->db->get('m_bank');
    return $get_table->result_array();
  }

  public function checkingCode($code = "")
  {
    $this->db->like("code", $code);
    $get_table = $this->db->get('m_produk_varian');
    return $get_table->num_rows();
  }

  public function insertData()
  {
    $customer_id = $this->input->post('customer_id', true);
    $get_pelanggan = $this->db->get_where('m_pelanggan', "id='$customer_id'")->row_array();
    $kategori_id = $get_pelanggan['m_kategori_pelanggan_id'];
    $status_pembayaran = $this->input->post('status_pembayaran', true);
    $m_order_status = $this->db->get_where('m_order_status', "code='$status_pembayaran'")->row_array();

    $no_varian = json_decode($this->input->post('no_varian', true));
    $this->db->select("m_produk_varian.id, m_produk_varian.m_produk_id, m_produk_varian.berat, m_produk_varian_harga.harga");
    $this->db->from('m_produk_varian_harga m_produk_varian_harga');
    $this->db->where("m_produk_varian.status_data != 'deleted'");
    $this->db->where("m_produk_varian_harga.m_produk_varian_id = m_produk_varian.id AND m_produk_varian_harga.m_kategori_pelanggan_id = '$kategori_id'");
    $this->db->where_in('m_produk_varian.id', $no_varian);
    $get_produk_varian = $this->db->get('m_produk_varian m_produk_varian')->result_array();

    $total_berat = 0;
    $subtotal = 0;
    foreach ($get_produk_varian as $varian) {
      $varian_id = $varian['id'];
      $berat = $varian['berat'];
      $harga = $varian['harga'];
      $qty = $this->input->post("produk_qty_$varian_id", true);

      $total_berat += (int)$qty * (int)$berat;
      $subtotal += (int)$qty * (int)$harga;
    }

    $kode_diskon = json_decode($this->input->post('kode_diskon_array', true));
    $total_diskon = 0;
    foreach ($kode_diskon as $kode) {
      $diskon = $this->input->post("diskon_nominal_$kode", true);
      $total_diskon += (int)$diskon;
    }

    $kode_biaya = json_decode($this->input->post('kode_biaya_array', true));
    $total_biaya = 0;
    foreach ($kode_biaya as $kode) {
      $biaya = $this->input->post("biaya_nominal_$kode", true);
      $total_biaya += (int)$biaya;
    }

    $grandtotal = $subtotal - $total_diskon + $total_biaya;

    $time = $this->input->post("tanggal_order", true) . ' ' . date('H:i:s');
    $tanggal_order = date('Y-m-d H:i:s', strtotime($time));

    $data = [
      'code' => $this->input->post('code', true),
      'm_pelanggan_id' => $this->input->post('customer_id', true),
      'm_pelanggan_id_pengiriman' => $this->input->post('dikirim_ke', true),
      'm_kategori_pelanggan_id' => $kategori_id,
      'm_user_id' => $this->session->userdata('m_user_id'),
      'tanggal_order' => $tanggal_order,
      'estimasi_pengiriman' => $this->input->post('preorder', true),
      'note' => $this->input->post("note", true),
      'subtotal_pembelian' => $subtotal,
      'm_kurir_id' => $this->input->post("m_kurir", true),
      'biaya_kurir' => str_replace(',', '', $this->input->post("biaya_kurir", true)),
      'total_berat' => $total_berat,
      'total_diskon' => $total_diskon,
      'total_biaya' => $total_biaya,
      'grandtotal' => $grandtotal,
      'status_pembayaran' => $status_pembayaran,
      'm_order_status_id' => $m_order_status['id'],
      'status_data' => 'active',
    ];

    $insert = $this->db->insert('t_order', $data);
    $t_order_id = $this->db->insert_id();
    if ($insert) {
      foreach ($get_produk_varian as $varian) {
        $varian_id = $varian['id'];

        $qty = $this->input->post("produk_qty_$varian_id", true);
        $subtotal = (int)$varian['harga'] * (int)$qty;
        $varian_data = [
          't_order_id' => $t_order_id,
          'm_produk_varian_id' => $varian_id,
          'qty' => $this->input->post("produk_qty_$varian_id", true),
          'harga' => $varian['harga'],
          'berat' => $varian['berat'],
          'subtotal' => $subtotal,
        ];
        $this->db->insert('t_order_detail', $varian_data);
      }

      foreach ($kode_diskon as $kode) {
        $dikon_option = $this->input->post("diskon_option_$kode", true);
        $persen = 0;
        if ($dikon_option != 'nominal') {
          $persen = $this->input->post("diskon_persen_$kode", true);
        }
        $diskon_data = [
          't_order_id' => $t_order_id,
          'name' => $this->input->post("diskon_name_$kode", true),
          'tipe_diskon' => $this->input->post("diskon_option_$kode", true),
          'diskon_persen' => $persen,
          'diskon_nominal' => $this->input->post("diskon_nominal_$kode", true)
        ];
        $this->db->insert('t_order_diskon', $diskon_data);
      }

      foreach ($kode_biaya as $kode) {
        $biaya_option = $this->input->post("biaya_option_$kode", true);
        $persen = 0;
        if ($biaya_option != 'nominal') {
          $persen = $this->input->post("biaya_persen_$kode", true);
        }
        $biaya_data = [
          't_order_id' => $t_order_id,
          'name' => $this->input->post("biaya_name_$kode", true),
          'tipe_biaya' => $this->input->post("biaya_option_$kode", true),
          'biaya_persen' => $persen,
          'biaya_nominal' => $this->input->post("biaya_nominal_$kode", true)
        ];
        $this->db->insert('t_order_biaya_lain', $biaya_data);
      }

      $time = $this->input->post("tanggal_bayar", true) . ' ' . date('H:i:s');
      $tanggal_bayar = date('Y-m-d H:i:s', strtotime($time));

      if ($status_pembayaran == 'installment') {
        $pembayaran_data = [
          't_order_id' => $t_order_id,
          'jenis_pembayaran' => $status_pembayaran,
          'tanggal_pembayaran' => $tanggal_bayar,
          'm_bank_id' => $this->input->post("m_bank", true),
          'nominal' => str_replace(',', '', $this->input->post("nominal_pembayaran", true))
        ];
        $this->db->insert('t_order_pembayaran', $pembayaran_data);
      } else if ($status_pembayaran == 'paid') {
        $pembayaran_data = [
          't_order_id' => $t_order_id,
          'jenis_pembayaran' => $status_pembayaran,
          'tanggal_pembayaran' => $tanggal_bayar,
          'm_bank_id' => $this->input->post("m_bank", true),
          'nominal' => $grandtotal
        ];
        $this->db->insert('t_order_pembayaran', $pembayaran_data);
      }
    }
  }

  public function prosesPembayaran()
  {
    $id = $this->input->post('id', true);
    $status_cicilan = $this->input->post('status_cicilan', true);
    $status = $status_cicilan == 'true' ? 'installment' : 'paid';
    $status_id = $status_cicilan == 'true' ? 2 : 3;
    $data = [
      'status_pembayaran' => $status,
      'm_order_status_id' => $status_id,
    ];
    $this->db->where('id', $id);
    $update = $this->db->update('t_order', $data);
    if ($update) {
      $time = $this->input->post("tanggal_bayar", true) . ' ' . date('H:i:s');
      $tanggal_bayar = date('Y-m-d H:i:s', strtotime($time));
      $pembayaran = [
        't_order_id' =>  $id,
        'jenis_pembayaran' =>  $status,
        'tanggal_pembayaran' => $tanggal_bayar,
        'm_bank_id' => $this->input->post("m_bank", true)
      ];
      if ($status == 'installment') {
        $pembayaran['nominal'] = str_replace(',', '', $this->input->post("nominal_pembayaran", true));
      } else {
        $order = $this->db->get_where('t_order', "id = '$id'")->row_array();

        $this->db->select_sum('nominal');
        $this->db->where("t_order_id", $id);
        $total_bayar = $this->db->get('t_order_pembayaran')->row_array();

        $sisa_bayar = (int)$order['grandtotal'] - (int)$total_bayar['nominal'];
        $pembayaran['nominal'] = $sisa_bayar;
      }
      $this->db->insert('t_order_pembayaran', $pembayaran);
    }
  }

  public function prosesPengiriman()
  {
    $id = $this->input->post('id', true);
    $time = $this->input->post("tanggal_pengiriman", true) . ' ' . date('H:i:s');
    $tanggal_pengiriman = date('Y-m-d H:i:s', strtotime($time));
    $data = [
      'tanggal_dikirim' => $tanggal_pengiriman,
      'm_order_status_id' => '5',
      'no_resi' => $this->input->post('no_resi', true)
    ];
    $this->db->where('id', $id);
    $this->db->update('t_order', $data);
  }

  public function prosesOrderan()
  {
    $id = $this->input->post('id', true);
    $data = [
      'm_order_status_id' => '4',
    ];
    $this->db->where('id', $id);
    $this->db->update('t_order', $data);
  }

  public function diterimaPelanggan()
  {
    $id = $this->input->post('id', true);
    $data = [
      'm_order_status_id' => '6',
    ];
    $this->db->where('id', $id);
    $this->db->update('t_order', $data);
  }
}
