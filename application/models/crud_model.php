<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function select($table, $rows, $where = null, $limit= null)
	{
		$this->db->from($table);
		$this->db->select($rows);
		if ($where != null) {
			$this->db->where($where);
		}

		if ($limit != null) {
			$this->db->limit($limit);
		}

		return $this->db->get();
	}

	function insert($table, $data)
	{
		$this->db->insert($table, $data);
	}

	function update($table, $data, $where)
	{
        $this->db->where($where); 
        $this->db->update($table, $data);
	}

	function delete($table, $where)
	{
        $this->db->where($where);
        $this->db->delete($table);
	}
}
/* End of file crud_model.php */
/* Location: ./application/models/crud_model.php */