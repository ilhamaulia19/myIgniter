<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('OutputView');		
	}

	//CRUD EXAMPLES HERE
	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
						
			$output = $crud->render();

			$data['judul'] = 'Offices';
			$data['crumb'] = array( 'Offices' => '' );

			$template = 'admin_template';
			$view = 'grocery';
			$this->outputview->output_admin($view, $template, $data, $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function employees_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');
		$crud->unset_columns('lastName', 'email');

		$crud->set_field_upload('file_url','assets/uploads/files', 'pdf');

		$output = $crud->render();
	
		$data['judul'] = 'Employees';
		$data['crumb'] = array( 'Employees' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->outputview->output_admin($view, $template, $data, $output);
	}

	public function customers_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('customers');
		$crud->columns('customerName','phone','city','country');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
		
		$output = $crud->render();
	
		$data['judul'] = 'Customers';
		$data['crumb'] = array( 'Customers' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->outputview->output_admin($view, $template, $data, $output);
	}

	public function orders_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
		$crud->display_as('customerNumber','Customer');
		$crud->set_table('orders');
		$crud->set_subject('Order');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_columns('comments');

		$output = $crud->render();
	
		$data['judul'] = 'Orders';
		$data['crumb'] = array( 'Orders' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->outputview->output_admin($view, $template, $data, $output);
	}

	public function products_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('products');
		$crud->set_subject('Product');
		$crud->unset_columns('productDescription','productName','productVendor','MSRP');
		$crud->callback_column('buyPrice',array($this,'valueToEuro'));
		
		$output = $crud->render();
	
		$data['judul'] = 'Products';
		$data['crumb'] = array( 'Products' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->outputview->output_admin($view, $template, $data, $output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors','release_year','rental_duration','rental_rate','replacement_cost');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		$crud->set_theme('flexigrid');

		$output = $crud->render();
		
		$data['judul'] = 'Films';
		$data['crumb'] = array( 'Films' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->outputview->output_admin($view, $template, $data, $output);
	}

}

/* End of file examples.php */
/* Location: ./application/controllers/examples.php */