<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_featureModel');
		$this->load->model('m_productModel');
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
		$config['total_rows'] = $this->m_productModel->countAllData();
		$config['per_page'] = 8;
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


		$get_table = $this->m_productModel->getTable($config['per_page'], $start);

		$get_feature = $this->m_featureModel->getFeature();
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();

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

		$get_kategori_produk = $this->m_productModel->getKategori();
		$get_jenis_produk = $this->m_productModel->getJenis();
		$get_kategori_pelanggan = $this->m_productModel->getKategoriPelanggan();

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'kategori_produk' => $get_kategori_produk,
			'jenis_produk' => $get_jenis_produk,
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/insert', $data);
	}

	public function load_edit($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$result = $this->m_productModel->getId($id);
		$varian = $this->m_productModel->getVarian($id);
		$varian_image = $this->m_productModel->getVarianImage($id);
		$get_kategori_pelanggan = $this->m_productModel->getKategoriPelanggan();
		$varian_harga = $this->m_productModel->getVarianHarga($id);


		$get_kategori_produk = $this->m_productModel->getKategori();
		$get_jenis_produk = $this->m_productModel->getJenis();
		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'data' => $result,
			'kategori_produk' => $get_kategori_produk,
			'jenis_produk' => $get_jenis_produk,
			'varian' => $varian,
			'varian_image' => $varian_image,
			'varian_harga' => $varian_harga,
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/edit', $data);
	}

	public function load_detail($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$result = $this->m_productModel->getId($id);
		$varian = $this->m_productModel->getVarian($id);
		$varian_image = $this->m_productModel->getVarianImage($id);
		$get_kategori_pelanggan = $this->m_productModel->getKategoriPelanggan();
		$varian_harga = $this->m_productModel->getVarianHarga($id);

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'data' => $result,
			'varian' => $varian,
			'varian_image' => $varian_image,
			'varian_harga' => $varian_harga,
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/detail', $data);
	}

	public function save()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->m_productModel->insertData();
			if ($result == 'failed') {
				$msg = [
					'status' => 'failed',
					'data' => [],
					'message' => 'Server eror, Upload gambar gagal!'
				];
				$this->session->set_flashdata('flash_failed', 'Server eror, Upload gambar gagal!');
				print json_encode($msg);
			} else {
				$msg = [
					'status' => $result,
					'data' => [],
					'message' => 'Jenis produk berhasil ditambahkan!'
				];
				$this->session->set_flashdata('flash_success', 'Jenis produk berhasil ditambahkan!');
				print json_encode($msg);
			}
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->m_productModel->editData($id);
			if ($result == 'failed') {
				$msg = [
					'status' => 'failed',
					'data' => [],
					'message' => 'Server eror, Upload gambar gagal!'
				];
				$this->session->set_flashdata('flash_failed', 'Server eror, Upload gambar gagal!');
				print json_encode($msg);
			} else {
				$msg = [
					'status' => $result,
					'data' => [],
					'message' => 'Jenis produk berhasil diubah!'
				];
				$this->session->set_flashdata('flash_success', 'Jenis produk berhasil diubah!');
				print json_encode($msg);
			}
		}
	}

	public function delete($id)
	{
		$result = $this->m_productModel->deleteData($id);
		$msg = [
			'status' => $result,
			'data' => [],
			'message' => 'Produk berhasil dihapus!'
		];
		$this->session->set_flashdata('flash_success', 'Produk berhasil dihapus!');
		print json_encode($msg);
	}

	public function get_autocomplete()
	{
		if ($this->input->get('term')) {
			$result = $this->m_productModel->getAutoCompleteName($this->input->get('term'));
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

	public function get_supplier()
	{
		if ($this->input->get('search_data')) {
			$result = $this->m_productModel->getSupplier($this->input->get('search_data'));
			if (count($result) > 0) {
				$data = [];
				foreach ($result as $row) {
					$data[] = [
						'id' => $row['id'],
						'text' => $row['name']
					];
				}
				echo json_encode($data);
			}
		}
	}

	public function checking_code()
	{
		if ($this->input->post('code')) {
			$result = $this->m_productModel->checkingCode($this->input->post('code'));
			if ($result > 0) {
				$msg = [
					'status' => false,
					'data' => [],
					'message' => 'Duplicate code!'
				];
				print json_encode($msg);
			} else {
				$msg = [
					'status' => true,
					'data' => [],
					'message' => 'Code ready to use!'
				];
				print json_encode($msg);
			}
		}
	}
}