<?php
function is_logged_in()
{
  $ci = get_instance();
  $feature = $ci->uri->segment(1);
  if (!$ci->session->userdata('m_role_id')) {
    redirect('auth');
  } else {
    $m_role_id = $ci->session->userdata('m_role_id');

    $ci->db->from("m_role_feature m_role_feature");
    $ci->db->where("m_feature.id = m_role_feature.m_feature_id AND m_feature.status_data = 'active' AND m_feature.code = '$feature' AND m_role_feature.m_role_id = '$m_role_id'");
    $get_access = $ci->db->get("m_feature m_feature");

    if ($get_access->num_rows() < 1) {
      redirect('auth/blocked');
    }
  }

  // if (APPPATH . 'controllers/' . $feature . '.php') {
  //   echo 'ada';
  // } else {
  //   echo 'tidak ada';
  // }
  // die;
}
