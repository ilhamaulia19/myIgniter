<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {
 
    function __construct()
    {
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');

		$this->auth();
    }
 	
 	public function auth()
    {
     	if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
    }

    public function index()
    {
		if (!$this->ion_auth->is_admin())
		{
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$notif = "<div class='alert alert-danger alert-dismissible' role='alert'>There's no table selected</div>";
			$this->output_grocery((object)array('data' => '' , 'output' => $notif , 'js_files' => null , 'css_files' => null));
		}
	}

	//Output Grocery here
    function output_grocery($output = null, $data = null)
    {
		$data['title'] = 'myIgniter';
		$data['page'] = $this->load->view('grocery', $output, TRUE); 
		$this->load->view('template/admin_template', $data);
    }

    //Users Management
    public function users()
    {
    	$crud = new grocery_CRUD();

    	$crud->set_table('users');
    	$crud->set_subject('Users');
    	$crud->columns('username','email','active');
    	if ($this->uri->segment(3) !== 'read')
		{
	    	$crud->add_fields('first_name', 'last_name', 'email', 'phone', 'password', 'password_confirm');
		}
		$crud->edit_fields('first_name', 'last_name', 'email', 'phone', 'last_login');

		//VALIDATION
		$crud->required_fields('first_name', 'last_name', 'email', 'phone', 'password', 'password_confirm');
		$crud->set_rules('email', 'E-mail', 'required|valid_email');
		$crud->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
		$crud->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
    
		//FIELD TYPES
		$crud->change_field_type('last_login', 'readonly');
		$crud->change_field_type('password', 'password');
		$crud->change_field_type('password_confirm', 'password');

		//CALLBACKS
		$crud->callback_insert(array($this, 'create_user_callback'));
		$crud->callback_update(array($this, 'edit_user_callback'));
		$crud->callback_field('last_login',array($this,'last_login_callback'));
		$crud->callback_column('active',array($this,'active_callback'));

		//VIEW
		$output = $crud->render();
		$this->output_grocery($output);
    }

    public function users_groups() {
		$crud = new grocery_CRUD();

		$crud->set_table('users');
		$crud->unset_add();
		$crud->unset_delete();

		$crud->change_field_type('username', 'readonly');

		$crud->columns('username', 'email', 'groups');
		$crud->edit_fields('username', 'groups', 'id');
		$crud->change_field_type('id', 'hidden');

		$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');

		//VIEW
		$output = $crud->render();
		$this->output_grocery($output);
	}

	public function groups() {
		$crud = new grocery_CRUD();

		$crud->set_table('groups');
		$crud->set_subject('Groups');

		//VIEW
		$output = $crud->render();
		$this->output_grocery($output);
	}

	function active_callback($value, $row)
	{
		if ($value == 1) {
			$val = 'active';
		}else{
			$val = 'inactive';
		}
		return "<a href='".site_url('crud/activate/'.$row->id.'/'.$value)."'>$val</a>";
	}

	function activate($id, $value)
	{
		if ($value == 1) {
			$this->ion_auth->deactivate($id);
		}else{
			$this->ion_auth->activate($id);
		}

		redirect('crud/users','refresh');
	}

	function last_login_callback($value = '', $primary_key = null)
	{
		$value = date('l Y/m/d H:i', $value);
	    return $value;
	}

	function delete_user($primary_key) {
		if ($this->ion_auth_model->delete_user($primary_key)) {
			return true;
		} else {
			return false;
		}
	}

	function edit_user_callback($post_array, $primary_key = null) {

		$username = $post_array['first_name'] . ' ' . $post_array['last_name'];
		$email = $post_array['email'];
		$groups = $post_array['groups'];
		$data = array(
					'username' => $username,
					'email' => $email,
					'phone' => $post_array['phone'],
					'first_name' => $post_array['first_name'],
					'last_name' => $post_array['last_name']
				);

		if ($this->ion_auth_model->update($primary_key, $data)) {
			return true;
		}else{
			return false;
		}
	}

	function create_user_callback($post_array, $primary_key = null) {

		$username = $post_array['first_name'] . ' ' . $post_array['last_name'];
		$password = $post_array['password'];
		$email = $post_array['email'];
		$data = array(
					'phone' => $post_array['phone'],
					'first_name' => $post_array['first_name'],
					'last_name' => $post_array['last_name']
				);

		$this->ion_auth_model->register($username, $password, $email, $data);

		return $this->db->insert_id();
	}

	//Crud Table Start Here
	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$output = $crud->render();
			$this->output_grocery($output);

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

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();
		
			$this->output_grocery($output);
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
		
			$this->output_grocery($output);
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
		
			$this->output_grocery($output);
	}

	public function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription','productName','productVendor','MSRP');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();
		
			$this->output_grocery($output);
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

		$output = $crud->render();
		
		$this->output_grocery($output);
	}
}
 