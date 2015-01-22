<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class template
{
  protected 	$ci;
	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function output($data=null, $content)
	{
		$this->ci->load->view('template/head', $data);
		$this->ci->load->view('template/nav', $data);
		$this->ci->load->view($content, $data);
		$this->ci->load->view('template/foot', $data);
	}

	public function login_form($data=null, $content)
	{
		$this->ci->load->view('template/head', $data);
		$this->ci->load->view($content, $data);
		$this->ci->load->view('template/foot', $data);
	}	
}
/* End of file template.php */
/* Location: ./application/libraries/template.php */