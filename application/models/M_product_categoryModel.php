<?php

class m_product_categoryModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id DESC');
    $this->db->where("status_data != 'deleted' AND id != '1'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_kategori_produk', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted' AND id != '1'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_kategori_produk');
    return $get_table->num_rows();
  }

  public function getId($id)
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id DESC');
    $this->db->where("status_data != 'deleted' AND id='$id'");
    $get_table = $this->db->get('m_kategori_produk');
    return $get_table->row_array();
  }

  public function insertData()
  {
    $data = [
      'name' => $this->input->post('name', true),
      'status_data' => 'active'
    ];
    $this->db->insert('m_kategori_produk', $data);
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('m_kategori_produk', $data);
  }

  public function editData($id)
  {
    $data = [
      'name' => $this->input->post('name', true),
      'status_data' => $this->input->post('status_data', true)
    ];
    $this->db->where('id', $id);
    $this->db->update('m_kategori_produk', $data);
  }
}
