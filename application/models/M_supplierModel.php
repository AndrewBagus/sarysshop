<?php

class m_supplierModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select('m_supplier.id, m_supplier.name, m_supplier.code, m_supplier.no_telepon, m_supplier.email, m_supplier.alamat, m_supplier.status_data, m_kelurahan_desa.nama_propinsi, m_kelurahan_desa.nama_kabupaten_kota, m_kelurahan_desa.jenis_kabupaten_kota, m_kelurahan_desa.nama_kecamatan, m_kelurahan_desa.kode_pos');
    $this->db->from('m_kelurahan_desa m_kelurahan_desa');
    $this->db->order_by('m_supplier.id DESC');
    $this->db->where("m_supplier.status_data != 'deleted' AND m_supplier.m_kelurahan_desa_id = m_kelurahan_desa.id");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_supplier.name', $key);
    }
    $get_table = $this->db->get('m_supplier m_supplier', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_supplier');
    return $get_table->num_rows();
  }

  public function getAutoCompleteName($key)
  {
    $this->db->like('name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $get_table = $this->db->get('m_supplier m_supplier');
    return $get_table->result();
  }

  public function getId($id)
  {
    $this->db->select("m_supplier.id, m_supplier.name, m_supplier.code, m_supplier.no_telepon, m_supplier.email, m_supplier.alamat, m_supplier.status_data, m_kelurahan_desa.id AS m_kelurahan_desa_id, m_kelurahan_desa.nama_propinsi, m_kelurahan_desa.nama_kabupaten_kota, m_kelurahan_desa.jenis_kabupaten_kota, m_kelurahan_desa.nama_kecamatan, m_kelurahan_desa.kode_pos, CONCAT(nama_kecamatan, ' ,', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ' ,', nama_propinsi) AS kecamatan");
    $this->db->from('m_kelurahan_desa m_kelurahan_desa');
    $this->db->where("m_supplier.status_data != 'deleted' AND m_supplier.id='$id' AND m_supplier.m_kelurahan_desa_id = m_kelurahan_desa.id");
    $get_table = $this->db->get('m_supplier m_supplier');
    return $get_table->row_array();
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
      'name' => $this->input->post('name', true),
      'code' => $this->input->post('code', true),
      'm_kelurahan_desa_id' => $this->input->post('m_kelurahan_desa_id', true),
      'kode_pos' => $this->input->post('kode_pos', true),
      'no_telepon' => $this->input->post('no_telepon', true),
      'email' => $this->input->post('email', true),
      'alamat' => $this->input->post('alamat', true),
      'status_data' => 'active'
    ];
    $this->db->insert('m_supplier', $data);
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('m_supplier', $data);
  }

  public function editData($id)
  {
    $data = [
      'name' => $this->input->post('name', true),
      'm_kelurahan_desa_id' => $this->input->post('m_kelurahan_desa_id', true),
      'kode_pos' => $this->input->post('kode_pos', true),
      'no_telepon' => $this->input->post('no_telepon', true),
      'email' => $this->input->post('email', true),
      'alamat' => $this->input->post('alamat', true),
      'status_data' => $this->input->post('status_data', true),
    ];
    $this->db->where('id', $id);
    $this->db->update('m_supplier', $data);
  }
}
