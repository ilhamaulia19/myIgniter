<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('OutputView');		
	}

	public function index()
	{
        $this->output->set_status_header('404');
		if (!$this->ion_auth->logged_in()) {
			$template      = 'auth_template';
			$view          = 'error_page/error_404';
	        $this->outputview->output_front($view, $template);
		}else{
			$data['judul'] = '404 Error Page';
			$data['crumb'] = array( '404 Error' => '' );
			$template      = 'admin_template';
			$view          = 'error_page/error_404';
	        $this->outputview->output_admin($view, $template, $data);
	    }
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */