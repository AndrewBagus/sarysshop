<?php

class m_customerModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select('m_pelanggan.id, m_pelanggan.name, m_pelanggan.code, m_pelanggan.no_telepon, m_pelanggan.email, m_pelanggan.alamat, m_pelanggan.status_data, m_kelurahan_desa.nama_propinsi, m_kelurahan_desa.nama_kabupaten_kota, m_kelurahan_desa.jenis_kabupaten_kota, m_kelurahan_desa.nama_kecamatan, m_kelurahan_desa.kode_pos, m_kategori_pelanggan.name as kategori_pelanggan');
    $this->db->from('m_kelurahan_desa m_kelurahan_desa');
    $this->db->from('m_kategori_pelanggan m_kategori_pelanggan');
    $this->db->order_by('m_pelanggan.id DESC');
    $this->db->where("m_pelanggan.status_data != 'deleted' AND m_pelanggan.m_kelurahan_desa_id = m_kelurahan_desa.id");
    $this->db->where('m_pelanggan.m_kategori_pelanggan_id = m_kategori_pelanggan.id');
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_pelanggan.name', $key);
    }
    $get_table = $this->db->get('m_pelanggan m_pelanggan', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_pelanggan');
    return $get_table->num_rows();
  }

  public function getAutoCompleteName($key)
  {
    $this->db->like('name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $this->db->where("m_pelanggan.status_data != 'deleted'");
    $get_table = $this->db->get('m_pelanggan m_pelanggan');
    return $get_table->result();
  }

  public function getId($id)
  {
    $this->db->select("m_pelanggan.id, m_pelanggan.name, m_pelanggan.code, m_pelanggan.no_telepon, m_pelanggan.email, m_pelanggan.alamat, m_pelanggan.status_data, m_kelurahan_desa.id AS m_kelurahan_desa_id, m_kelurahan_desa.nama_propinsi, m_kelurahan_desa.nama_kabupaten_kota, m_kelurahan_desa.jenis_kabupaten_kota, m_kelurahan_desa.nama_kecamatan, m_kelurahan_desa.kode_pos, CONCAT(nama_kecamatan, ' ,', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ' ,', nama_propinsi) AS kecamatan, m_kategori_pelanggan.id AS m_kategori_pelanggan_id, m_kategori_pelanggan.name as kategori_pelanggan");
    $this->db->from('m_kelurahan_desa m_kelurahan_desa');
    $this->db->from('m_kategori_pelanggan m_kategori_pelanggan');
    $this->db->where("m_pelanggan.status_data != 'deleted' AND m_pelanggan.id='$id' AND m_pelanggan.m_kelurahan_desa_id = m_kelurahan_desa.id");
    $this->db->where('m_pelanggan.m_kategori_pelanggan_id = m_kategori_pelanggan.id');
    $get_table = $this->db->get('m_pelanggan');
    return $get_table->row_array();
  }

  public function getKategori()
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id ASC');
    $this->db->where("status_data != 'deleted'");
    $get_table = $this->db->get('m_kategori_pelanggan');
    return $get_table->result_array();
  }

  public function getKecamatan($key = "")
  {
    $this->db->select("id, CONCAT(nama_kecamatan, ' ,', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ' ,', nama_propinsi) AS kecamatan");
    $this->db->group_by('kecamatan');
    $this->db->order_by('kecamatan ASC');
    // $this->db->like("nama_kecamatan", $key);
    // $this->db->or_like("CONCAT(nama_kecamatan, ', ', jenis_kabupaten_kota)", $key);
    // $this->db->or_like("jenis_kabupaten_kota", $key);
    // $this->db->or_like("CONCAT(nama_kecamatan, ' ,', jenis_kabupaten_kota, ' ', nama_kabupaten_kota)", $key);
    // $this->db->or_like("nama_kabupaten_kota", $key);
    $this->db->like("CONCAT(nama_kecamatan, ' ,', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ' ,', nama_propinsi)", $key);
    // $this->db->or_like("nama_propinsi", $key);
    $get_table = $this->db->get('m_kelurahan_desa', 10);
    return $get_table->result_array();
  }

  public function getKodePos($id = '')
  {
    $get_kelurahan_desa = $this->db->get_where('m_kelurahan_desa', "id = '$id'")->row_array();
    $nama_propinsi = $get_kelurahan_desa['nama_propinsi'];
    $jenis_kabupaten_kota = $get_kelurahan_desa['jenis_kabupaten_kota'];
    $nama_kabupaten_kota = $get_kelurahan_desa['nama_kabupaten_kota'];
    $nama_kecamatan = $get_kelurahan_desa['nama_kecamatan'];

    $this->db->select('id, kode_pos');
    $this->db->order_by('id ASC');
    $this->db->group_by('kode_pos');
    $this->db->where("nama_propinsi = '$nama_propinsi' AND jenis_kabupaten_kota = '$jenis_kabupaten_kota' AND nama_kabupaten_kota = '$nama_kabupaten_kota' AND nama_kecamatan = '$nama_kecamatan'");
    $get_table = $this->db->get('m_kelurahan_desa');
    return $get_table->result();
  }

  public function insertData()
  {
    $data = [
      'm_kategori_pelanggan_id' => $this->input->post('m_kategori_pelanggan_id', true),
      'name' => $this->input->post('name', true),
      'code' => $this->input->post('code', true),
      'm_kelurahan_desa_id' => $this->input->post('m_kelurahan_desa_id', true),
      'kode_pos' => $this->input->post('kode_pos', true),
      'no_telepon' => $this->input->post('no_telepon', true),
      'email' => $this->input->post('email', true),
      'alamat' => $this->input->post('alamat', true),
      'status_data' => 'active'
    ];
    $this->db->insert('m_pelanggan', $data);
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('m_pelanggan', $data);
  }

  public function editData($id)
  {
    $data = [
      'm_kategori_pelanggan_id' => $this->input->post('m_kategori_pelanggan_id', true),
      'name' => $this->input->post('name', true),
      'm_kelurahan_desa_id' => $this->input->post('m_kelurahan_desa_id', true),
      'kode_pos' => $this->input->post('kode_pos', true),
      'no_telepon' => $this->input->post('no_telepon', true),
      'email' => $this->input->post('email', true),
      'alamat' => $this->input->post('alamat', true),
      'status_data' => $this->input->post('status_data', true),
    ];
    $this->db->where('id', $id);
    $this->db->update('m_pelanggan', $data);
  }
}
