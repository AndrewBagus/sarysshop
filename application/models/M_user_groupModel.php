<?php

class m_user_groupModel extends CI_Model
{
  public function getTable($limit, $start)
  {
    $this->db->select("m_role.id, m_role.name, m_role.description, m_role.status_data, (SELECT COUNT(*) FROM m_role_feature WHERE m_role_id = m_role.id) AS feature_count");
    $this->db->order_by('m_role.id ASC');
    $this->db->where("m_role.status_data != 'deleted' AND m_role.id != 1");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('m_role.name', $key);
    }
    $get_table = $this->db->get('m_role m_role', $limit, $start);
    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted'");
    if ($this->input->post('key')) {
      $key = $this->input->post('key', true);
      $this->db->like('name', $key);
    }
    $get_table = $this->db->get('m_role');
    return $get_table->num_rows();
  }

  public function getAutoCompleteName($key)
  {
    $this->db->like('name', $key);
    $this->db->order_by('id ASC');
    $this->db->limit(10);
    $this->db->where("status_data != 'deleted' AND id != 1");
    $get_table = $this->db->get('m_role');
    return $get_table->result();
  }

  public function getFeature($id)
  {
    $this->db->select("m_feature.id, m_feature.name, m_feature.code, m_feature.icon, m_feature.sequence, m_feature.url, m_feature_group.id as group_id, m_feature_group.name as group_name, m_feature_group.sequence as group_sequence,(SELECT COUNT(*) FROM m_feature where m_feature_group_id = m_feature_group.id AND m_feature.status_data = 'active' AND m_feature.visible = true) as group_count, (SELECT COUNT(*) FROM m_role_feature WHERE m_feature_id = m_feature.id AND m_role_id = '$id') AS checked");
    $this->db->from("m_feature_group m_feature_group");
    $this->db->where("m_feature.m_feature_group_id = m_feature_group.id AND m_feature.status_data = 'active' AND m_feature.visible = true");
    $this->db->order_by('m_feature.m_feature_group_id ASC, m_feature.sequence ASC');
    $get_feature = $this->db->get("m_feature m_feature");
    return $get_feature->result_array();
  }

  public function getId($id)
  {
    $this->db->select('id, name, description, status_data');
    $this->db->order_by('id ASC');
    $this->db->where("status_data != 'deleted' AND id != 1 AND id = '$id'");
    $get_table = $this->db->get('m_role');
    return $get_table->row_array();
  }

  public function insertData()
  {
    $data = [
      'name' => $this->input->post('name', true),
      'code' => str_replace(' ', '_', strtolower($this->input->post('name', true))),
      'description' => $this->input->post('description', true),
      'status_data' => 'active'
    ];
    $this->db->insert('m_role', $data);
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $delete = $this->db->update('m_role', $data);
  }

  public function editData($id)
  {
    $data = [
      'name' => $this->input->post('name', true),
      'code' => str_replace(' ', '_', strtolower($this->input->post('name', true))),
      'description' => $this->input->post('description', true),
      'status_data' => $this->input->post('status_data', true),
    ];
    $this->db->where('id', $id);
    $this->db->update('m_role', $data);
  }

  public function updateFeature($id)
  {
    $feature = $this->input->post('feature', true);
    foreach ($feature as $row) {
      $this->db->where("m_role_id = '$id' AND m_feature_id = '$row'");
      $check_feature = $this->db->count_all_results('m_role_feature');
      if ($check_feature == 0) {
        $insert = [
          'm_role_id' => $id,
          'm_feature_id' =>  $row,
          'visible' => true
        ];

        $this->db->insert('m_role_feature', $insert);
      }
    }

    $this->db->where('m_role_id', $id);
    $this->db->where_not_in('m_feature_id', $feature);
    $to_delete = $this->db->get('m_role_feature')->result_array();
    foreach ($to_delete as $row) {
      $get_id = $row['id'];
      $this->db->where("id = '$get_id'");
      $this->db->delete('m_role_feature');
    }
  }
}
