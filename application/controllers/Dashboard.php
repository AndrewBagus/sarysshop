<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_featureModel');
		is_logged_in();
	}

	public function index()
	{
		$get_feature = $this->m_featureModel->getFeature();
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$data = [
			'title' => $title['name'],
			'feature' => $get_feature,
			'url' => $title['url']
		];
		$this->load->view('main/base', $data);
	}

	public function view_content($feature)
	{
		$title = $this->db->get_where('m_feature', "code = '$feature'")->row_array();
		$data = [
			'title' => $title['name']
		];

		$this->load->view("scope/$feature/index", $data);
	}
}
