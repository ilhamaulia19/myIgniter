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

    /**
     * Table Name : api
     * GET, POST, PUT, DELETE
     **/

	function user_get()
    {

        if (!$this->get('id'))
        {
            $apiAll = $this->db->get('api')->result();
            $this->response($apiAll, 200);
        } 
        elseif ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $apiGet = $this->db->get('api')->row();
            $this->response($apiGet, 200);
        } 
        else {
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
            $this->response(['message' => 'Success POST'], 201);
        }
        else {
            $this->response(['error' => 'Api could not be found'], 404);
        }

        $this->response($message, 201);
    }

    function user_put()
    {
        $api = array(
                        'name' => $this->put('name'), 
                        'email' => $this->put('email')
                    );

        if ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $this->db->update('api', $api);
            $this->response(['message' => 'Success PUT'], 201);
        }
        else {
            $this->response(['error' => 'Api could not be found'], 404);
        }
    }

    function user_delete()
    {
        if ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $this->db->delete('api');
            $this->response(['message' => 'Success DELETE'], 201);
        }
        else {
            $this->response(['error' => 'Api could not be found'], 404);
        }
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */