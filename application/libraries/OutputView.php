<?php defined('BASEPATH') OR exit('No direct script access allowed');

class OutputView {

	protected $CI;

	function __construct()
    {
    	$this->CI =& get_instance();
    }

    //OUTPUT ADMIN PAGE
	public function auth()
    {
     	if (!$this->CI->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
    }

    function data_output($data_add)
	{
		$data = $data_add;
		$data['settings'] = $this->CI->db->get('settings', 1)->row();
		$this->CI->db->where('user_id', $this->CI->ion_auth->user()->row()->id);
		$groups    = $this->CI->db->get('users_groups');
		$i         = 0;
		$id_groups = '';
		foreach ($groups->result() as $groups) {
			if ($i != 0) {
				$id_groups .= ",";
			}
			$id_groups .= $groups->group_id;
			$i++;
		}
		$whereAkses  = "id_groups in (".$id_groups.")";
		$whereMenu 	 = "level_one = '0' and level_two = '0' and ".$whereAkses;
		$whereLvlOne = "level_one != '0' and level_two = '0' and ".$whereAkses;
		$whereLvlTwo = "level_one != '0' and level_two != '0' and ".$whereAkses;

		$this->CI->db->where($whereAkses);
		$this->CI->db->order_by('sort', 'ASC');
		$this->CI->db->group_by('id_header_menu');
		$data['header_menu'] = $this->CI->db->get('view_header_menu');

		$this->CI->db->where($whereMenu);
		$this->CI->db->order_by('sort', 'ASC');
		$this->CI->db->group_by('id_menu');		
		$data['menu']        = $this->CI->db->get('view_menu');

		$this->CI->db->where($whereLvlOne);
		$this->CI->db->order_by('sort', 'ASC');
		$this->CI->db->group_by('id_menu');
		$data['menu_lvlOne'] = $this->CI->db->get('view_menu');

		$this->CI->db->where($whereLvlTwo);
		$this->CI->db->order_by('sort', 'ASC');
		$this->CI->db->group_by('id_menu');
		$data['menu_lvlTwo'] = $this->CI->db->get('view_menu');

		$data['title'] = $data['settings']->judul;

		return $data;
	}

    public function output_admin($view, $template, $data_add = null, $output = null)
	{
		$this->auth();
		$data = $this->data_output($data_add);
		if ($output) {
			$data['page'] = $this->CI->load->view($view, $output, TRUE); //GROCERY CRUD PAGE
		}else{
			$view = explode('<script', $this->CI->load->view($view, $data, TRUE));
			$data['page'] = $view[0]; //NON GROCERY CRUD
			if (isset($view[1])) {
				$data['scriptView'] = '<script'.$view[1];
			}
		}
		$this->CI->load->view('template/'.$template, $data);
	}

    //OUTPUT FRONT PAGE
    public function output_front($view, $template, $data_add = null, $output = null)
	{
		$data['settings'] = $this->CI->db->get('settings', 1)->row();
		$data['title']    = $data['settings']->judul;
		if ($output) {
			$data['page'] = $this->CI->load->view($view, $output, TRUE); //GROCERY CRUD PAGE
		}else{
			$view = explode('<script', $this->CI->load->view($view, $data_add, TRUE));
			$data['page'] =  $view[0]; //NON GROCERY CRUD
			if (isset($view[1])) {
				$data['scriptView'] = '<script'.$view[1];
			}
		}
		$this->CI->load->view('template/'.$template, $data);
	}
}