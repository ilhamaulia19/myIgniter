<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {
 
    function __construct()
    {
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('form_validation');

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
			$output = (object)array('data' => '' , 'output' => '' , 'js_files' => null , 'css_files' => null);
			
			$data['judul'] = 'Dashboard';

			$template = 'admin_template';
			$view = 'grocery';
			$this->output_grocery($view, $output, $data, $template);
		}
	}

	//OUTPUT DATA
	function data_output($data_add)
	{
		$data['settings']                = $this->crud_model->select('settings','*','','1')->row();
		$whereGroups['user_id'] = $this->ion_auth->user()->row()->id;
		$groups = $this->crud_model->select('users_groups','*',$whereGroups);
		$i = 0;
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

		$data['header_menu'] = $this->crud_model->select('view_header_menu','*',$whereAkses,'','order ASC','id_header_menu');
		$data['menu']        = $this->crud_model->select('view_menu','*',$whereMenu,'','order ASC','id_menu');
		$data['menu_lvlOne'] = $this->crud_model->select('view_menu','*',$whereLvlOne,'','order ASC','id_menu');
		$data['menu_lvlTwo'] = $this->crud_model->select('view_menu','*',$whereLvlTwo,'','order ASC','id_menu');
		$data['title']       = $data['settings']->judul;
		foreach ($data_add as $key => $value) {
			$data[$key] = $value;
		}

		return $data;
	}

    //OUTPUT MANUAL
    function output_view($view, $data_add = null, $template)
	{
		$data         = $this->data_output($data_add);
		$data['page'] = $this->load->view($view, $data, TRUE);
		$this->load->view('template/'.$template, $data);
	}

	//OUTPUT GROCERY CRUD
    function output_grocery($view, $output = null, $data_add = null, $template)
    {
		$data         = $this->data_output($data_add);
		$data['page'] = $this->load->view($view, $output, TRUE);
		$this->load->view('template/'.$template, $data);
    }

    //USERS MANAGEMENT
    public function users()
    {
    	$crud = new grocery_CRUD();

    	$crud->set_table('users');
    	$crud->set_subject('Users');
    	$crud->columns('username','email','active');
    	if ($this->uri->segment(3) !== 'read')
		{
	    	$crud->add_fields('username','first_name', 'last_name', 'email', 'phone', 'password', 'password_confirm');
			$crud->edit_fields('username','first_name', 'last_name', 'email', 'phone', 'last_login','old_password','new_password');
		}else{
			$crud->set_read_fields('username','first_name', 'last_name', 'email', 'phone','last_login');
		}
		
		//VALIDATION
		$crud->required_fields('username','first_name', 'last_name', 'email', 'phone', 'password', 'password_confirm');
		$crud->set_rules('email', 'E-mail', 'required|valid_email');
		$crud->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
		$crud->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
   		$crud->set_rules('new_password', 'New password', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

		//FIELD TYPES
		$crud->change_field_type('last_login', 'readonly');
		$crud->change_field_type('password', 'password');
		$crud->change_field_type('password_confirm', 'password');
		$crud->change_field_type('old_password', 'password');
		$crud->change_field_type('new_password', 'password');

		//CALLBACKS
		$crud->callback_insert(array($this, 'create_user_callback'));
		$crud->callback_update(array($this, 'edit_user_callback'));
		$crud->callback_field('last_login',array($this,'last_login_callback'));
		$crud->callback_column('active',array($this,'active_callback'));

		//VIEW
		$output = $crud->render();
		$data['judul'] = 'Users';
		$data['crumb'] = array( 'Users' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
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
		$data['judul'] = 'Users groups';
		$data['crumb'] = array( 'Users groups' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	public function groups() {
		$crud = new grocery_CRUD();

		$crud->set_table('groups');
		$crud->set_subject('Groups');

		//VIEW
		$output = $crud->render();
		$data['judul'] = 'Groups';
		$data['crumb'] = array( 'Groups' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
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

		$username = $post_array['username'];
		$email    = $post_array['email'];
		$old 	  = $post_array['old_password'];
		$new 	  = $post_array['new_password'];
		$data     = array(
					'username'   => $username,
					'email'      => $email,
					'phone'      => $post_array['phone'],
					'first_name' => $post_array['first_name'],
					'last_name'  => $post_array['last_name']
				);
		
		if ($old === '') {
			$change = $this->ion_auth_model->update($primary_key, $data);
		}else{
			$change = $this->ion_auth_model->update($primary_key, $data) && $this->ion_auth->change_password($email, $old, $new);
		}

		if ($change) {
			return true;
		}else{
			return false;
		}
	}

	function create_user_callback($post_array, $primary_key = null) {

		$username = $post_array['username'];
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

	//CRUD SETTINGS HERE
	public function settings()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('settings');
		$crud->set_field_upload('logo','assets/img/logo');
		$crud->columns('logo','judul','nama_perusahaan','alamat');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_export();

		$output = $crud->render();
		$data['judul'] = "Settings";
		$data['crumb'] = array( 'Settings' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	public function header_menu()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('header_menu');
		$crud->set_subject('Header menu');
		$crud->display_as('id_header_menu','Order');
		$crud->set_relation_n_n('Akses', 'groups_header', 'groups', 'id_header_menu', 'id_groups', 'name');
		$crud->add_action('Menu', 'fa fa-list', '', '',array($this,'link_menu'));
		$crud->order_by('order','ASC');
		$crud->unset_read();

		$output = $crud->render();
		$data['judul'] = "Header menu";
		$data['crumb'] = array( 'Header menu' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	function link_menu($primary_key, $row)
	{
	    return site_url('crud/menu').'/'.$primary_key;
	}

	public function menu($id_header_menu)
	{
		$crud = new grocery_CRUD();

		$crud->set_table('menu');
		$where['id_header_menu'] = $id_header_menu;
		$header = $this->crud_model->select('header_menu','*',$where)->row();
		$crud->set_subject('Menu '.$header->header);
		$crud->where('level_one','0');
		$crud->where('level_two','0');
		$crud->where('id_header_menu',$id_header_menu);
		$crud->change_field_type('id_header_menu','invisible');

		$crud->order_by('order','ASC');
		$crud->set_relation_n_n('Akses', 'groups_menu', 'groups', 'id_menu', 'id_groups', 'name');
		$crud->unset_columns('level_one','level_two','icon','menu_id','id_header_menu');
		$crud->unset_read();
		$crud->unset_fields('level_one','level_two');
		$crud->add_action('Sub menu', 'fa fa-list', '', '',array($this,'link_sub_menu'));
	    $crud->callback_before_insert(array($this,'call_header_menu'));

		$output = $crud->render();
		$data['script'] = "$('#menu-menu').addClass('active')";
		$output->data = $data;
		$data['judul'] = "Menu";
		$data['crumb'] = array( 'Header menu' => 'crud/header_menu',
								'Menu' => ''
							  );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	function call_header_menu($post_array) 
	{
		$post_array['id_header_menu'] = $this->uri->segment(3);
		return $post_array;
	}   

	function link_sub_menu($primary_key, $row)
	{
	    return site_url('crud/sub_menu').'/'.$row->id_header_menu.'/'.$primary_key;
	}

	public function sub_menu($id_header_menu, $level_one)
	{
		$crud = new grocery_CRUD();

		$crud->set_table('menu');
		$where['id_header_menu'] = $id_header_menu;
		$header = $this->crud_model->select('header_menu','*',$where)->row();
		$crud->set_subject('Menu '.$header->header);
		$crud->where('level_one', $level_one);
		$crud->where('level_two','0');
		$crud->change_field_type('id_header_menu','invisible');
		$crud->change_field_type('level_one','invisible');

		$crud->order_by('order','ASC');
		$crud->set_relation_n_n('Akses', 'groups_menu', 'groups', 'id_menu', 'id_groups', 'name');
		$crud->unset_columns('level_one','level_two','icon','menu_id','id_header_menu');
		$crud->unset_read();
		$crud->unset_fields('level_two');
		$crud->add_action('Sub menu 2', 'fa fa-list', '', '',array($this,'link_sub_menu_2'));
	    $crud->callback_before_insert(array($this,'call_sub_menu'));

		$output = $crud->render();
		$data['script'] = "$('#menu-menu').addClass('active')";
		$output->data = $data;
		$data['judul'] = "Sub menu";
		$data['crumb'] = array( 
						'Header menu' => 'crud/header_menu',
						'Menu' => 'crud/menu/'.$id_header_menu,
						'Sub menu' => ''
					  );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	function call_sub_menu($post_array) 
	{
		$post_array['id_header_menu'] = $this->uri->segment(3);
		$post_array['level_one'] = $this->uri->segment(4);
		return $post_array;
	}  

	function link_sub_menu_2($primary_key, $row)
	{
	    return site_url('crud/sub_menu_2').'/'.$row->id_header_menu.'/'.$row->level_one.'/'.$primary_key;
	}

	public function sub_menu_2($id_header_menu, $level_one, $level_two)
	{
		$crud = new grocery_CRUD();

		$crud->set_table('menu');
		$where['id_header_menu'] = $id_header_menu;
		$header = $this->crud_model->select('header_menu','*',$where)->row();
		$crud->set_subject('Menu '.$header->header);
		$crud->where('level_one', $level_one);
		$crud->where('level_two', $level_two);
		$crud->change_field_type('id_header_menu','invisible');
		$crud->change_field_type('level_one','invisible');
		$crud->change_field_type('level_two','invisible');

		$crud->order_by('order','ASC');
		$crud->set_relation_n_n('Akses', 'groups_menu', 'groups', 'id_menu', 'id_groups', 'name');
		$crud->unset_columns('level_one','level_two','icon','menu_id','id_header_menu');
		$crud->unset_read();
	    $crud->callback_before_insert(array($this,'call_sub_menu_2'));

		$output = $crud->render();
		$data['script'] = "$('#menu-menu').addClass('active')";
		$output->data = $data;
		$data['judul'] = "Sub menu 2";
		$data['crumb'] = array( 
						'Header menu' => 'crud/header_menu',
						'Menu' => 'crud/menu/'.$id_header_menu, 
						'Sub menu' => 'crud/sub_menu/'.$id_header_menu.'/'.$level_one,
						'Sub menu 2' => ''
					  );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}

	function call_sub_menu_2($post_array) 
	{
		$post_array['id_header_menu'] = $this->uri->segment(3);
		$post_array['level_one'] = $this->uri->segment(4);
		$post_array['level_two'] = $this->uri->segment(5);
		return $post_array;
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
			$this->output_grocery($view, $output, $data, $template);

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
		$this->output_grocery($view, $output, $data, $template);
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
		$this->output_grocery($view, $output, $data, $template);
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
		$this->output_grocery($view, $output, $data, $template);
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
		$this->output_grocery($view, $output, $data, $template);
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
		
		$data['judul'] = 'Films';
		$data['crumb'] = array( 'Films' => '' );

		$template = 'admin_template';
		$view = 'grocery';
		$this->output_grocery($view, $output, $data, $template);
	}
}
 