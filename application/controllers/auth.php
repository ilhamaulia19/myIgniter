<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
		$this->load->helper('language');
	}

	function index()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login');
		}else{
			redirect('crud/index');
		}
	}

	//OUTPUT IONAUTH
	function output_ionauth($view, $data = null)
	{
		$data['settings']    = $this->crud_model->select('settings','*','','1')->row();
		$data['title']       = $data['settings']->judul;
		$data['page'] 		 = $this->load->view($view, $data, TRUE); 
		$this->load->view('template/auth_template', $data);
	}

	public function login()
	{
		//SUCCESS LOGIN
		$data['redirect'] = site_url('crud/index');
		$view = 'auth/login';
		$this->output_ionauth($view, $data);
	}

	function ajax_login()
	{
		$remember = (bool) $this->input->post('remember');
	
		if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
			echo "true";
		}else{
			echo "false";
		}
	}

	function logout()
	{
		$logout = $this->ion_auth->logout();
		redirect('auth/login');
	}
}