<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller 
{

	function __construct(){
		parent::__construct();
		$this->load->model("products_model"); //constructor yang dipanggil ketika memanggil products.php untuk melakukan pemanggilan pada model : products_model.php yang ada di folder models
	}

	public function index()
	{
		//Function yang digunakan untuk menampilkan view products_view.php
		$data['listProducts'] = $this->products_model->getAllProducts(); //berisi dari return value pada function getAllProducts() di file models/products_model.php
		$this->load->view('products_view', $data); //menampilkan view 'products_view' dan juga passing data dengan nama $data(Bentuknya array) yang berisi 'listProducts'
	}

	public function addProduct()
	{
		//Function yang dipanggil ketika ingin melakukan add produk kemudian menampilkan add_product_view
		$this->load->view('add_product_view');
	}

	public function addProductDb()
	{
		//Function yang dipanggil ketika ingin memasukan produk ke dalam database
		$data = array(
					'productName' => $this->input->post('productName'),
					'stock' => $this->input->post('stock')
				);
		$this->products_model->addProduct($data); //passing variable $data ke products_model

		redirect('products'); //redirect page ke halaman utama controller products
	}

	public function updateProduct($productId) //Apabila kita menambahkan parameter seperti ini, maka kita menggunakan method GET untuk mengirimkan parameter dari view ke controller
	{
		//Function yang dipanggil ketika ingin melakukan update produk kemudian menampilkan update_product_view
        $data['product'] = $this->products_model->getProduct($productId); //Melakukan pemanggilan fungsi getProduct yang ada di dalam products_model untuk mendapatkan informasi / data mengenai produk berdasarkan productId yang dikirimkan
        
        $this->load->view('update_product_view', $data); //menampilkan view 'update_product_view' dan juga passing data dengan nama $data(Bentuknya array) yang berisi 'product'
	}

	public function updateProductDb()
	{
		//Function yang dipanggil ketika ingin melakukan update terhadap produk yang ada di dalam database
        $data = array(
					'productName' => $this->input->post('productName'), //Didapatkan dari form yang disubmit pada file update_product_view.php
					'stock' => $this->input->post('stock') //Didapatkan dari form yang disubmit pada file update_product_view.php
				);
        $condition['productId'] = $this->input->post('productId'); //Digunakan untuk melakukan validasi terhadap produk mana yang akan diupdate nantinya
        
		$this->products_model->updateProduct($data, $condition); //passing variable $data ke products_model

		redirect('products'); //redirect page ke halaman utama controller products
	}

	public function deleteProductDb($productId)
	{
		//Function yang dipanggil ketika ingin melakukan delete produk dari database
        $this->products_model->deleteProduct($productId); //Memanggil fungsi deleteProduct yang ada pada model products_model dan mengirimkan parameter yaitu productId yang akan di delete
        
        redirect('products'); //redirect page ke halaman utama controller products
	}
}

/* Location: ./application/controllers/products.php */