<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //SESSION START HERE

class crud extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
     }
 
    public function index()
    {
		$this->auth();
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$notif = "<div class='alert alert-danger alert-dismissible' role='alert'>There's no table selected</div>";
		$this->_example_output((object)array('data' => $data , 'output' => $notif , 'js_files' => array() , 'css_files' => array()));
	}
 
    function _example_output($output = null)
    {
        $this->load->view('crud_view.php',$output);    
    }
    
	
	function auth()
	{
		if(!$this->session->userdata('logged_in'))
		{
	      redirect('login', 'refresh');
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('crud', 'refresh');
	}
	
	//Crud Table Start Here
	public function offices_management()
	{
		$this->auth();
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();

			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function employees_management()
	{
			$this->auth();
			$crud = new grocery_CRUD();

			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');

			$crud->required_fields('lastName');

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
			$this->_example_output($output);
	}

	public function customers_management()
	{
			$this->auth();
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
			$this->_example_output($output);
	}

	public function orders_management()
	{
			$this->auth();
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
			$this->_example_output($output);
	}

	public function products_management()
	{
			$this->auth();
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
			$this->_example_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$this->auth();
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$output->data = $data;
		$this->_example_output($output);
	}


	function multigrids()
	{
			$this->auth();
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$this->_example_output((object)array(
				'js_files' 	=> $js_files,
				'css_files' => $css_files,
				'output'	=> $output,
				'data'		=> $data
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');

		$crud->set_field_upload('file_url','assets/uploads/files');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{

		$crud = new grocery_CRUD();

		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}
}
 