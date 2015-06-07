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
		$data['settings']       = $this->CI->crud_model->select('settings','*','','1')->row();
		$whereGroups['user_id'] = $this->CI->ion_auth->user()->row()->id;
		$groups                 = $this->CI->crud_model->select('users_groups','*',$whereGroups);
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

		$data['header_menu'] = $this->CI->crud_model->select('view_header_menu','*',$whereAkses,'','order ASC','id_header_menu');
		$data['menu']        = $this->CI->crud_model->select('view_menu','*',$whereMenu,'','order ASC','id_menu');
		$data['menu_lvlOne'] = $this->CI->crud_model->select('view_menu','*',$whereLvlOne,'','order ASC','id_menu');
		$data['menu_lvlTwo'] = $this->CI->crud_model->select('view_menu','*',$whereLvlTwo,'','order ASC','id_menu');
		$data['title']       = $data['settings']->judul;
		foreach ($data_add as $key => $value) {
			$data[$key] = $value;
		}

		return $data;
	}

    public function output_admin($view, $template, $data_add = null, $output = null)
	{
		$this->auth();
		$data         = $this->data_output($data_add);
		if ($output) {
			$data['page'] = $this->CI->load->view($view, $output, TRUE); //GROCERY CRUD PAGE
		}else{
			$data['page'] = $this->CI->load->view($view, $data, TRUE); //NON GROCERY CRUD
		}
		$this->CI->load->view('template/'.$template, $data);
	}

    //OUTPUT FRONT PAGE
    public function output_front($view, $template, $data_add = null)
	{
		$data['settings']    = $this->CI->crud_model->select('settings','*','','1')->row();
		$data['title']       = $data['settings']->judul;
		$data['page'] 		 = $this->CI->load->view($view, $data_add, TRUE); 
		$this->CI->load->view('template/'.$template, $data);
	}
}