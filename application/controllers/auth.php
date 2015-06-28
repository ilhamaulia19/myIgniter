<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('auth');
		$this->load->library('OutputView');		
	}

	function index()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login');
		}else{
			redirect('crud/index');
		}
	}

	public function login()
	{
		$data['redirect'] = site_url('crud/index');
		$view             = 'auth/login';
		$template         = 'auth_template';
		$this->outputview->output_front($view, $template, $data);
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

	public function logout()
	{
		$logout = $this->ion_auth->logout();
		redirect('auth/login');
	}

}