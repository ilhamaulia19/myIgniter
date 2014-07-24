<?php
//File products_model.php

class Products_model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	function getAllProducts()
	{
		//select semua data yang ada pada table msProduct
		$this->db->select("*");
		$this->db->from("msProduct");

		return $this->db->get();
	}

	function getProduct($id)
	{
		//select produk berdasarkan id yang dimiliki	
        $this->db->where('productId', $id); //Akan melakukan select terhadap row yang memiliki productId sesuai dengan productId yang telah dipilih
        $this->db->select("*");
        $this->db->from("msProduct");
        
        return $this->db->get();
	}

	function addProduct($data)
	{
		//untuk insert data ke database
		$this->db->insert('msProduct', $data);
	}

	function updateProduct($data, $condition)
	{
		//update produk
        $this->db->where($condition); //Hanya akan melakukan update sesuai dengan condition yang sudah ditentukan
        $this->db->update('msProduct', $data); //Melakukan update terhadap table msProduct sesuai dengan data yang telah diterima dari controller
	}

	function deleteProduct($id)
	{
		//delete produk berdasarkan id
        $this->db->where('productId', $id);
        $this->db->delete('msProduct');
	}
}