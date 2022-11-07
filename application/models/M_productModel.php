<?php

class m_productModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select("m_produk.id, m_produk.name, m_produk.image_url, m_produk.status_data, m_produk.tempo_kedatangan_barang, m_jenis_produk.name as jenis_produk, m_kategori_produk.name as kategori_produk, m_supplier.name as nama_supplier, m_supplier.alamat as alamat_supplier, (SELECT MIN(harga) FROM m_produk_varian_harga WHERE m_produk_varian_id IN(SELECT id FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted')) AS min_harga,(SELECT MAX(harga) FROM m_produk_varian_harga WHERE m_produk_varian_id IN(SELECT id FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted')) AS max_harga, (SELECT SUM(stok) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS stok, (SELECT COUNT(id) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS count_varian");
    $this->db->from('m_jenis_produk m_jenis_produk');
    $this->db->from('m_kategori_produk m_kategori_produk');
    $this->db->from('m_supplier m_supplier');
    $this->db->order_by('m_produk.id DESC');
    $this->db->where("m_produk.status_data != 'deleted' AND m_produk.m_jenis_produk_id = m_jenis_produk.id");
    $this->db->where('m_produk.m_kategori_produk_id = m_kategori_produk.id');
    $this->db->where('m_produk.m_supplier_id = m_supplier.id');
    if ($this->input->post('key')) {
      $search_option = $this->input->post('search_option', true);
      $key = $this->input->post('key', true);
      if ($search_option == "name") {
        $this->db->like('m_produk.name', $key);
      } else if ($search_option == "supplier") {
        $this->db->like('m_supplier.name', $key);
      }
    }
    $get_table = $this->db->get('m_produk m_produk', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $get_table = $this->db->get_where('m_produk m_produk', "m_produk.status_data != 'deleted'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_produk.name', $key);
    }
    return $get_table->num_rows();
  }

  public function getAutoCompleteName($key)
  {
    $this->db->like('m_produk.name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $get_table = $this->db->get('m_produk m_produk');
    return $get_table->result();
  }

  public function getId($id)
  {
    $this->db->select("m_produk.id, m_produk.name, m_produk.m_supplier_id, m_produk.tempo_kedatangan_barang, m_produk.m_kategori_produk_id, m_produk.m_jenis_produk_id, m_produk.keterangan, m_produk.image_url, m_produk.status_data, m_jenis_produk.name as jenis_produk, m_kategori_produk.name as kategori_produk, CONCAT(m_supplier.name, ' (', m_supplier.code, ' )') as nama_supplier, (SELECT COUNT(id) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS count_varian, (SELECT MAX(id) FROM m_produk_varian WHERE m_produk_id = m_produk.id) AS max_id_varian, (SELECT SUM(stok) FROM m_produk_varian WHERE m_produk_id = m_produk.id AND status_data != 'deleted') AS stok");
    $this->db->from('m_jenis_produk m_jenis_produk');
    $this->db->from('m_kategori_produk m_kategori_produk');
    $this->db->from('m_supplier m_supplier');
    $this->db->order_by('m_produk.id DESC');
    $this->db->where("m_produk.status_data != 'deleted' AND m_produk.m_jenis_produk_id = m_jenis_produk.id AND m_produk.id='$id'");
    $this->db->where('m_produk.m_kategori_produk_id = m_kategori_produk.id');
    $this->db->where('m_produk.m_supplier_id = m_supplier.id');
    $get_table = $this->db->get('m_produk m_produk');
    return $get_table->row_array();
  }

  public function getVarian($id)
  {
    $this->db->select("m_produk_varian.id, m_produk_varian.code,m_produk_varian.berat,m_produk_varian.harga_beli, m_produk_varian.ukuran,m_produk_varian.warna, m_produk_varian.stok");
    $this->db->order_by('m_produk_varian.id ASC');
    $this->db->where("m_produk_varian.status_data != 'deleted' AND m_produk_varian.m_produk_id='$id'");
    $get_table = $this->db->get('m_produk_varian m_produk_varian');
    return $get_table->result_array();
  }

  public function getVarianImage($id)
  {
    $this->db->select("m_produk_varian_image.m_produk_varian_id, m_produk_varian_image.image_url");
    $this->db->from('m_produk_varian m_produk_varian');
    $this->db->order_by('m_produk_varian_image.id ASC');
    $this->db->where("m_produk_varian.id = m_produk_varian_image.m_produk_varian_id AND m_produk_varian_image.status_data != 'deleted' AND m_produk_varian.m_produk_id='$id'");
    $get_table = $this->db->get('m_produk_varian_image m_produk_varian_image');
    return $get_table->result_array();
  }

  public function getVarianHarga($id)
  {
    $this->db->select("m_produk_varian_harga.m_produk_varian_id, m_produk_varian_harga.m_kategori_pelanggan_id, m_produk_varian_harga.harga");
    $this->db->from('m_produk_varian m_produk_varian');
    $this->db->order_by('m_produk_varian_harga.id ASC');
    $this->db->where("m_produk_varian.id = m_produk_varian_harga.m_produk_varian_id AND m_produk_varian.m_produk_id='$id'");
    $get_table = $this->db->get('m_produk_varian_harga m_produk_varian_harga');
    return $get_table->result_array();
  }

  public function getKategori()
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id ASC');
    $this->db->where("status_data != 'deleted'");
    $get_table = $this->db->get('m_kategori_produk');
    return $get_table->result_array();
  }

  public function getJenis()
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id ASC');
    $this->db->where("status_data != 'deleted'");
    $get_table = $this->db->get('m_jenis_produk');
    return $get_table->result_array();
  }

  public function getKategoriPelanggan()
  {
    $this->db->select('id, name');
    $this->db->order_by('id ASC');
    $this->db->where("status_data = 'active'");
    $get_table = $this->db->get('m_kategori_pelanggan');
    return $get_table->result_array();
  }

  public function insertData()
  {
    $thumbnail = $_FILES['upload_thumbnail_1']['name'];
    $data = [
      'name' => $this->input->post('name', true),
      'm_supplier_id' => $this->input->post('m_supplier_id', true),
      'm_kategori_produk_id' => $this->input->post('m_kategori_produk_id', true),
      'm_jenis_produk_id' => $this->input->post('m_jenis_produk_id', true),
      'keterangan' => $this->input->post('keterangan', true),
      'tempo_kedatangan_barang' => $this->input->post("tempo_kedatangan_barang", true),
      'status_data' => 'active'
    ];

    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '5000';
    $config['upload_path'] = './app_assets/upload/produk/';
    $this->load->library('upload', $config);
    if ($thumbnail) {
      if ($this->upload->do_upload('upload_thumbnail_1')) {
        $new_image = $this->upload->data('file_name');
        $data['image_url'] = $new_image;
      } else {
        $data['image_url'] = 'product-default.png';
      }
    } else {
      $data['image_url'] = 'product-default.png';
    }

    $insert = $this->db->insert('m_produk', $data);
    $m_produk_id = $this->db->insert_id();
    if ($insert) {
      $get_kategori_pelanggan = $this->getKategoriPelanggan();
      $no_varian = json_decode($this->input->post('no_varian', true));
      foreach ($no_varian as $no) {
        $varian = [
          'm_produk_id' => $m_produk_id,
          'code' => $this->input->post("code_$no", true),
          'warna' => $this->input->post("warna_$no", true),
          'ukuran' => $this->input->post("ukuran_$no", true),
          'berat' => $this->input->post("berat_$no", true),
          'harga_beli' => str_replace(',', '', $this->input->post("harga_beli_$no", true)),
          'stok' => $this->input->post("stok_$no", true),
          'status_data' => 'active'
        ];
        $insert_varian = $this->db->insert('m_produk_varian', $varian);
        $m_produk_varian_id = $this->db->insert_id();
        if ($insert_varian) {
          foreach ($get_kategori_pelanggan as $pelanggan) {
            $id_pelanggan = $pelanggan['id'];
            $harga = [
              'm_produk_varian_id' => $m_produk_varian_id,
              'm_kategori_pelanggan_id' => $id_pelanggan,
              'harga' => str_replace(',', '', $this->input->post("harga_jual_$no" . "_$id_pelanggan", true)),
            ];
            $this->db->insert('m_produk_varian_harga', $harga);
          }

          $image = $_FILES["upload_image_$no"]['name'];

          if ($image) {
            if ($this->upload->do_upload("upload_image_$no")) {
              $new_image = $this->upload->data('file_name');
              $image_varian = [
                'm_produk_varian_id' => $m_produk_varian_id,
                'image_url' => $new_image,
                'status_data' => 'active'
              ];
              $this->db->insert('m_produk_varian_image', $image_varian);
            }
          }
        }
      }
    }
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('m_produk', $data);
  }

  public function editData($id)
  {
    $thumbnail = $_FILES['upload_thumbnail_1']['name'];
    $data = [
      'name' => $this->input->post('name', true),
      'm_supplier_id' => $this->input->post('m_supplier_id', true),
      'm_kategori_produk_id' => $this->input->post('m_kategori_produk_id', true),
      'm_jenis_produk_id' => $this->input->post('m_jenis_produk_id', true),
      'keterangan' => $this->input->post('keterangan', true),
      'tempo_kedatangan_barang' => $this->input->post("tempo_kedatangan_barang", true),
      'status_data' => $this->input->post('status_data', true)
    ];

    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '5000';
    $config['upload_path'] = './app_assets/upload/produk/';
    $this->load->library('upload', $config);
    if ($thumbnail) {
      if ($this->upload->do_upload('upload_thumbnail_1')) {
        $new_image = $this->upload->data('file_name');
        $data['image_url'] = $new_image;
      }
    }

    $this->db->where('id', $id);
    $this->db->update('m_produk', $data);

    $id_varian = json_decode($this->input->post('id_varian', true));
    $this->db->where('m_produk_id', $id);
    $this->db->where_not_in('id', $id_varian);
    $get_deleted = $this->db->get('m_produk_varian m_produk_varian')->result_array();
    foreach ($get_deleted as $row) {
      $row['status_data'] = 'deleted';
      $this->db->where('id', $row['id']);
      $this->db->update('m_produk_varian', $row);
    }

    $get_kategori_pelanggan = $this->getKategoriPelanggan();

    foreach ($id_varian as $no) {
      $varian = [
        'code' => $this->input->post("code_$no", true),
        'warna' => $this->input->post("warna_$no", true),
        'ukuran' => $this->input->post("ukuran_$no", true),
        'berat' => $this->input->post("berat_$no", true),
        'harga_beli' => str_replace(',', '', $this->input->post("harga_beli_$no", true)),
        'status_data' => 'active'
      ];
      $this->db->where('id', $no);
      $this->db->update('m_produk_varian', $varian);

      foreach ($get_kategori_pelanggan as $pelanggan) {
        $id_pelanggan = $pelanggan['id'];
        $harga = [
          'harga' => str_replace(',', '', $this->input->post("harga_jual_$no" . "_$id_pelanggan", true)),
        ];
        $get_harga = $this->db->get_where('m_produk_varian_harga', "m_produk_varian_id = '$no' AND m_kategori_pelanggan_id = '$id_pelanggan'");
        if ($get_harga->num_rows() != 0) {
          $this->db->where('m_produk_varian_id', $no);
          $this->db->where('m_kategori_pelanggan_id', $id_pelanggan);
          $this->db->update('m_produk_varian_harga', $harga);
        } else {
          $harga['m_produk_varian_id'] =  $no;
          $harga['m_kategori_pelanggan_id'] = $id_pelanggan;
          $this->db->insert('m_produk_varian_harga', $harga);
        }
      }

      $image = $_FILES["upload_image_$no"]['name'];

      if ($image) {
        if ($this->upload->do_upload("upload_image_$no")) {
          $new_image = $this->upload->data('file_name');
          $image_varian = [
            'image_url' => $new_image,
            'status_data' => 'active'
          ];
          $get_image = $this->db->get_where('m_produk_varian_image', "m_produk_varian_id = '$no'");
          if ($get_image->num_rows() != 0) {
            $this->db->where('m_produk_varian_id', $no);
            $this->db->update('m_produk_varian_image', $image_varian);
          } else {
            $image_varian['m_produk_varian_id'] =  $no;
            $this->db->insert('m_produk_varian_image', $image_varian);
          }
        }
      }
    }

    $no_varian = json_decode($this->input->post('no_varian', true));
    foreach ($no_varian as $no) {
      $varian = [
        'm_produk_id' => $id,
        'code' => $this->input->post("code_$no", true),
        'warna' => $this->input->post("warna_$no", true),
        'ukuran' => $this->input->post("ukuran_$no", true),
        'berat' => $this->input->post("berat_$no", true),
        'harga_beli' => str_replace(',', '', $this->input->post("harga_beli_$no", true)),
        'stok' => $this->input->post("stok_$no", true),
        'status_data' => 'active'
      ];
      $insert_varian = $this->db->insert('m_produk_varian', $varian);
      $m_produk_varian_id = $this->db->insert_id();
      if ($insert_varian) {
        foreach ($get_kategori_pelanggan as $pelanggan) {
          $id_pelanggan = $pelanggan['id'];
          $harga = [
            'm_produk_varian_id' => $m_produk_varian_id,
            'm_kategori_pelanggan_id' => $id_pelanggan,
            'harga' => str_replace(',', '', $this->input->post("harga_jual_$no" . "_$id_pelanggan", true)),
          ];
          $this->db->insert('m_produk_varian_harga', $harga);
        }

        $image = $_FILES["upload_image_$no"]['name'];

        if ($image) {
          if ($this->upload->do_upload("upload_image_$no")) {
            $new_image = $this->upload->data('file_name');
            $image_varian = [
              'm_produk_varian_id' => $m_produk_varian_id,
              'image_url' => $new_image,
              'status_data' => 'active'
            ];
            $this->db->insert('m_produk_varian_image', $image_varian);
          }
        }
      }
    }
  }

  public function getSupplier($key = "")
  {
    $this->db->select("id, CONCAT(name, ' (', code, ' )') AS name");
    $this->db->order_by('name ASC');
    $this->db->like("CONCAT(name, ' (', code, ' )')", $key);
    $get_table = $this->db->get('m_supplier', 10);
    return $get_table->result_array();
  }

  public function checkingCode($code = "")
  {
    $this->db->like("code", $code);
    $get_table = $this->db->get('m_produk_varian');
    return $get_table->num_rows();
  }
}
