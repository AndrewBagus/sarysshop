<?php

class m_userModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select('m_user.id, m_user.email, m_user.name, m_user.phone, m_user.status_data, m_role.name AS role_name');
    $this->db->from('m_user_role m_user_role');
    $this->db->from('m_role m_role');
    $this->db->order_by('m_user.id DESC');
    $this->db->where("m_user.status_data != 'deleted' AND m_user.id = m_user_role.m_user_id");
    $this->db->where("m_user_role.m_role_id = m_role.id AND m_role.id != '1'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_user.name', $key);
    }
    $get_table = $this->db->get('m_user m_user', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_user');
    return $get_table->num_rows();
  }

  public function getAutoCompleteName($key)
  {
    $this->db->like('name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $get_table = $this->db->get('m_user m_user');
    return $get_table->result();
  }

  public function getRole()
  {
    $this->db->select('id, name, status_data');
    $this->db->order_by('id ASC');
    $this->db->where("status_data != 'deleted' AND id != '1'");
    $get_table = $this->db->get('m_role');
    return $get_table->result_array();
  }

  public function getId($id)
  {
    $this->db->select('m_user.id, m_user.email, m_user.name, m_user.phone, m_user.status_data, m_role.name AS role_name');
    $this->db->from('m_user_role m_user_role');
    $this->db->from('m_role m_role');
    $this->db->where("m_user.status_data != 'deleted' AND m_user.id = m_user_role.m_user_id AND m_user.id = '$id'");
    $this->db->where("m_user_role.m_role_id = m_role.id");
    $get_table = $this->db->get('m_user m_user');
    return $get_table->row_array();
  }

  public function insertData()
  {
    $data = [
      'email' => $this->input->post('email', true),
      'name' => $this->input->post('name', true),
      'phone' => $this->input->post('phone', true),
      'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
      'status_data' => 'active'
    ];
    $insert = $this->db->insert('m_user', $data);
    $m_user_id = $this->db->insert_id();
    if ($insert) {
      $user_role = [
        'm_role_id' =>  $this->input->post('m_role_id', true),
        'm_user_id' => $m_user_id,
        'status_aktif' => 1,
        'status_data' => 'active'
      ];
      $this->db->insert('m_user_role', $user_role);
    }
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $delete = $this->db->update('m_user', $data);
    if ($delete) {
      $user_role = [
        'm_user_id' => $id,
        'status_data' => 'deleted'
      ];
      $this->db->where("m_user_id = '$id'");
      $this->db->update('m_user_role', $user_role);
    }
  }

  public function resetPassword($id)
  {
    $data = [
      'password' => password_hash('123456', PASSWORD_DEFAULT)
    ];
    $this->db->where('id', $id);
    $this->db->update('m_user', $data);
  }

  public function editData($id)
  {
    $data = [
      'email' => $this->input->post('email', true),
      'name' => $this->input->post('name', true),
      'phone' => $this->input->post('phone', true),
      'status_data' => $this->input->post('status_data', true),
    ];
    $this->db->where('id', $id);
    $update = $this->db->update('m_user', $data);
    if ($update) {
      $user_role = [
        'm_role_id' =>  $this->input->post('m_role_id', true),
        'm_user_id' => $id,
      ];
      $this->db->where("m_user_id = '$id'");
      $this->db->update('m_user_role', $user_role);
    }
  }
}
