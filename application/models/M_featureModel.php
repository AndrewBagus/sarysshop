<?php

class m_featureModel extends CI_Model
{
  public function getFeature()
  {
    $m_role_id = $this->session->userdata('m_role_id');

    $this->db->select("m_feature.id, m_feature.name, m_feature.code, m_feature.icon, m_feature.sequence, m_feature.url, m_feature_group.id as group_id, m_feature_group.name as group_name, m_feature_group.sequence as group_sequence,(SELECT COUNT(*) FROM m_feature where m_feature_group_id = m_feature_group.id AND m_feature.status_data = 'active' AND m_feature.visible = true) as group_count");
    $this->db->from("m_feature_group m_feature_group");
    $this->db->from("m_role_feature m_role_feature");
    $this->db->where("m_feature.m_feature_group_id = m_feature_group.id AND m_feature.status_data = 'active' AND m_feature.visible = true");
    $this->db->where("m_feature.id = m_role_feature.m_feature_id AND m_role_id = '$m_role_id'");
    $this->db->order_by('m_feature.m_feature_group_id ASC, m_feature.sequence ASC');
    $get_feature = $this->db->get("m_feature m_feature");
    return $get_feature->result_array();
  }
}
