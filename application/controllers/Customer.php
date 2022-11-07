<?php
defined('BASEPATH') or exit('No direct script access allowed');

class customer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_featureModel');
		$this->load->model('m_customerModel');
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
		$config['total_rows'] = $this->m_customerModel->countAllData();
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
		$get_table = $this->m_customerModel->getTable($config['per_page'], $start);

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
		$get_kategori_pelanggan = $this->m_customerModel->getKategori();

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/insert', $data);
	}

	public function load_edit($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$get_kategori_pelanggan = $this->m_customerModel->getKategori();
		$result = $this->m_customerModel->getId($id);
		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'kategori_pelanggan' => $get_kategori_pelanggan,
			'data' => $result
		];
		$this->load->view('scope/' . $title['url'] . '/edit', $data);
	}

	public function save()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('m_kelurahan_desa_id', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->m_customerModel->insertData();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Customer berhasil ditambahkan!'
			];
			$this->session->set_flashdata('flash_success', 'Customer berhasil ditambahkan!');
			print json_encode($msg);
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('m_kelurahan_desa_id', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('status_data', 'Status', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->m_customerModel->editData($id);
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Customer berhasil diubah!'
			];
			$this->session->set_flashdata('flash_success', 'Customer berhasil diubah!');
			print json_encode($msg);
		}
	}

	public function delete($id)
	{
		$result = $this->m_customerModel->deleteData($id);
		$msg = [
			'status' => $result,
			'data' => [],
			'message' => 'Customer berhasil dihapus!'
		];
		$this->session->set_flashdata('flash_success', 'Customer berhasil dihapus!');
		print json_encode($msg);
	}

	public function get_autocomplete()
	{
		if ($this->input->get('term')) {
			$result = $this->m_customerModel->getAutoCompleteName($this->input->get('term'));
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

	public function get_kelurahan_desa()
	{
		if ($this->input->get('search_data')) {
			$result = $this->m_customerModel->getKecamatan($this->input->get('search_data'));
			if (count($result) > 0) {
				$data = [];
				foreach ($result as $row) {
					$data[] = [
						'id' => $row['id'],
						'text' => $row['kecamatan']
					];
				}
				echo json_encode($data);
			}
		}
	}

	public function get_kode_pos()
	{
		if ($this->input->get('m_kelurahan_desa_id')) {
			$result = $this->m_customerModel->getKodePos($this->input->get('m_kelurahan_desa_id'));
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = $row->kode_pos;
					// var_dump($arr_result);
					// echo json_encode($arr_result);
				}
				echo json_encode($arr_result);
			}
		}
	}
}
