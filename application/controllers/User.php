<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_featureModel');
		$this->load->model('m_userModel');
		$this->load->library('form_validation');
		is_logged_in();
	}

	public function index()
	{
		$this->load->library('pagination');
		$feature_url = $this->uri->segment(1);
		$start = $this->uri->segment(3);

		// pagination config
		$config['base_url'] = '' . base_url() . $feature_url . '/index';
		$config['total_rows'] = $this->m_userModel->countAllData();
		$config['per_page'] = 10;
		// $config['uri_segment'] = 3;
		// $config['num_links'] = 2;
		// $config['use_page_numbers'] = true;
		// $config['enable_query_strings'] = true;

		//pagination style
		$config['full_tag_open'] = '<nav style="text-align:right"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// pagination initialize
		$this->pagination->initialize($config);

		$get_feature = $this->m_featureModel->getFeature();
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$get_table = $this->m_userModel->getTable($config['per_page'], $start);

		$data = [
			'title' => $title['name'],
			'feature' => $get_feature,
			'url' => $title['url'],
			'table' => $get_table,
			'start' => $start
		];
		$this->load->view('main/base', $data);
	}

	public function load_insert()
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$get_role = $this->m_userModel->getRole();

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'role' => $get_role
		];
		$this->load->view('scope/' . $title['url'] . '/insert', $data);
	}

	public function load_edit($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$result = $this->m_userModel->getId($id);
		$get_role = $this->m_userModel->getRole();
		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'data' => $result,
			'role' => $get_role
		];
		$this->load->view('scope/' . $title['url'] . '/edit', $data);
	}

	public function save()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('phone', 'No Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[m_user.email]', [
			'is_unique' => 'email sudah ada!'
		]);
		$this->form_validation->set_rules('m_role_id', 'Role', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[re_password]', [
			'min_length' => 'Password minimal 6 karakter!',
			'matches' => 'Password harus sama!'
		]);
		$this->form_validation->set_rules('re_password', 'Re Password', 'required|trim|matches[password]');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => validation_errors(),
				'message' => 'Validasi gagal ' . validation_errors()
			];
			print json_encode($msg);
		} else {
			$result = $this->m_userModel->insertData();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'User berhasil ditambahkan!'
			];
			$this->session->set_flashdata('flash_success', 'User berhasil ditambahkan!');
			print json_encode($msg);
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('phone', 'No Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('m_role_id', 'Role', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => validation_errors(),
				'message' => 'Validasi gagal ' . validation_errors()
			];
			print json_encode($msg);
		} else {
			$result = $this->m_userModel->editData($id);
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'User berhasil diubah!'
			];
			$this->session->set_flashdata('flash_success', 'User berhasil diubah!');
			print json_encode($msg);
		}
	}

	public function delete($id)
	{
		$result = $this->m_userModel->deleteData($id);
		$msg = [
			'status' => $result,
			'data' => [],
			'message' => 'User berhasil dihapus!'
		];
		$this->session->set_flashdata('flash_success', 'User berhasil dihapus!');
		print json_encode($msg);
	}

	public function reset_password($id)
	{
		$result = $this->m_userModel->resetPassword($id);
		$msg = [
			'status' => $result,
			'data' => [],
			'message' => 'Password berhasil direset!'
		];
		$this->session->set_flashdata('flash_success', 'Password berhasil direset!');
		print json_encode($msg);
	}

	public function get_autocomplete()
	{
		if ($this->input->get('term')) {
			$result = $this->m_userModel->getAutoCompleteName($this->input->get('term'));
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = $row->name;
					// var_dump($arr_result);
					// echo json_encode($arr_result);
				}
				echo json_encode($arr_result);
			}
		}
	}
}
