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
			if($this->main_model->can_login($username,$password)){
					$session_data=array(
						'username' => $username
					);
					$this->session->set_userdata($session_data);
					redirect(base_url().'main/main');
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
               
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('userfile')){
               $error = array('error' => $this->upload->display_errors());
               $this->load->view('upload_image_view', $error);
        }
        else{
            $data = array('upload_data' =>$this->upload->data()); //insert ke folder images
            $data_upload =  array('image_name' => $this->upload->data("file_name"), //insert ke DB
				          'path' => $this->upload->data("full_path")        
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

    
}