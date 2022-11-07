<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		// $data = [
		// 	'email' => 'owner@mail.com',
		// 	'name' => 'Owner',
		// 	'phone' => '081',
		// 	'password' => password_hash('owner', PASSWORD_DEFAULT),
		// 	'status_data' => 'active'
		// ];
		// $this->db->insert('m_user', $data);

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('main/login');
		} else {
			$this->_login();
		}
	}
	public function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->db->select("m_user.id, m_user.name, m_user.email, m_user.password, m_user.status_data, m_user_role.m_role_id as role_id");
		$this->db->from("m_user_role m_user_role");
		$this->db->where('m_user_role.m_user_id = m_user.id');
		$get_user = $this->db->get_where('m_user', ['email' => $email])->row_array();

		if ($get_user) {
			if ($get_user['status_data'] == 'active') {
				if (password_verify($password, $get_user['password'])) {
					$data = [
						'm_user_id' => $get_user['id'],
						'name' =>  $get_user['name'],
						'email' => $get_user['email'],
						'm_role_id' => $get_user['role_id']
					];
					$this->session->set_userdata($data);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					$this->load->view('main/login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not active!</div>');
				$this->load->view('main/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			$this->load->view('main/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('m_role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');

		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('main/blocked');
	}
	public function soon()
	{
		$this->load->view('main/soon');
	}
}
