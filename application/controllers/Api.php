<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

	public function __construct()
	{
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
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

    function user_post()
    {
        $api = array(
                        'name' => $this->post('name'), 
                        'email' => $this->post('email')
                    );

        if ($this->post('name') && $this->post('email')) {
            $this->db->insert('api', $api);
            $message['message'] = 'Success POST';
        }else{
            $message['message'] = 'Error POST';
        }

        $this->response($message, 201);
    }

    function user_delete()
    {
        if ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $this->db->delete('api');
            $message['message'] = 'Success DELETE';
        }else{
            $message['message'] = 'Error DELETE';
        }

        $this->response($message, 204);
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */