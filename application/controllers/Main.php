<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();		
		$this->load->model('db_connect');
		//$this->load->model('main_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
 
	}
	public function index()
	{
		// echo 'test';
		// die();
		redirect(base_url().'main/login');
		//$this->load->view("login_view",$data);
	}
	public function login()
	{
		$data['title'] = 'Login';
		$this->load->view("login_view",$data);
	}
	public function main()
	{
		$data['title'] = 'Main Menu';
		$this->load->view("main_view",$data);
	}
	public function main_admin()
	{
		$data['title'] = 'Main Menu';
		$this->load->view("main_admin_view",$data);
	}
	public function user_stat()
	{
		$data['title'] = 'User Statistics';
		$this->load->model('main_model');
    	$data['image_name']=$this->main_model->get_all_image_name();
    	$data['all_username']=$this->main_model->get_all_username();
		$this->load->view("user_stat_view",$data);
		
	}
	public function image_stat()
	{
		$data['title'] = 'Image Statistics';
		$this->load->view("image_stat_view",$data);
	}
	public function register()
	{
		$data['title'] = 'Register Menu';
		$this->load->view("register_view",$data);
	}
	public function display_image()
	{
		redirect(base_url().'main/displayImage');
	}
	public function register_data(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$this->load->model('main_model');
		$this->main_model->register($username,$password,$role);	
		redirect(base_url().'main/login');
	}
	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run()){
			//true
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('main_model');
			$user = $this->main_model->can_login($username,$password);
			// print_r($user[0]->role);
			// die();
			
			if($user){
					$session_data=array(
						'username' => $username
					);
					$this->session->set_userdata($session_data);
					if($user[0]->role=='staff'){
						redirect(base_url().'main/main');
					} 
					else if($user[0]->role=='admin'){
						redirect(base_url().'main/main_admin');
					}
			}
			else{
				$this->session->set_flashdata('error','Invalid username and password');
				redirect(base_url().'main/login');
			}
		}
		else{
			//false
			$this->login();
		}	
	}
	function logout(){
		$this->session->unset_userdata('username');
		redirect(base_url().'main/login');
	}
	public function upload_image(){
		$this->load->view('upload_image_view', array('error' => ' ' ));
	}
	public function do_upload(){
        $config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name'] = FALSE; //buat crypted nama foto
        $now = new DateTime("Asia/Jakarta");
        
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('userfile')){
               $error = array('error' => $this->upload->display_errors());
               $this->load->view('upload_image_view', $error);
        }
        else{
            $data = array('upload_data' =>$this->upload->data()); //insert ke folder images
            $data_upload =  array('image_name' => $this->upload->data("file_name"), //insert ke DB
				          'dateup' => $now->format('Y-m-d H:i:s')   
            ); 
            $this->load->view('upload_success', $data);
            $this->load->model('main_model');
            $this->main_model->File_upload($data_upload); //insert ke DB
        }
    }
    public function displayImage(){
    	$this->load->model('main_model');
    	$a['data']=$this->main_model->get_data("images");
    	$this->load->view('display_image_view',$a);
    }
    public function view_marking($page = 'marking')
    {
    	if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->model('main_model');
    	$a['data']=$this->main_model->get_random_image("images");
        $this->load->view($page, $a);
    }
    public function insert_dot(){
		$image_id = $this->input->post('image_id');
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$userin = $this->input->post('userin');
		// $userin = $_SESSION['username'];
		// $userin = $this->session->username;
 
		$data = array(
			'image_id' => $image_id,
			'x' => $x,
			'y' => $y,
			'userin' => $userin
			);
		$this->db_connect->set('datein', 'NOW()', FALSE);
		$this->db_connect->insert('dots_coordinate',$data);
		// redirect('marking/view');
	}

	public function sync_count(){
		// insert into dots_count
		// select userin as username, image_id, count(*) as dots_count from dots_coordinate 
		// group by userin, image_id
	}

	public function sync_distance(){
		// insert code here
	}

	public function show_user_stats($username){
		// insert code here		
	}

	public function show_image_stats($image_id){
		// insert code here		
	}
    

}