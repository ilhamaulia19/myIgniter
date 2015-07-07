<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

	public function __construct()
	{
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header('Access-Control-Allow-Origin: *');
		parent::__construct();		
	}

	function user_get()
    {
        $apiAll = $this->db->get('api')->result();

        if (!$this->get('id'))
        {
            $this->response($apiAll, 200);
        }

        $this->db->where('id_api', $this->get('id'));
        $apiGet = $this->db->get('api')->row();

        if ($apiGet)
        {
            $this->response($apiGet, 200);
        }

        else
        {
            $this->response(['error' => 'Api could not be found'], 404);
        }
    }
    
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */