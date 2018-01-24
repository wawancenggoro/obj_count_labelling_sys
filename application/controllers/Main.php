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
		$this->load->helper('url');
		$this->load->library('session');
 
	}

	public function index()
	{
		$this->load->view('main');
	}

	public function login()
	{
		// $data['posts'] = $this->db_connect->login('wcenggoro');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->db_connect->check_login($username, $password)->num_rows();
		if($cek > 0){
	 
			$data_session = array(
				'username' => $username,
				'status' => "login"
				);
	 
			$this->session->set_userdata($data_session);
	 
			redirect("main/index");
		}else{
			echo "Incorrect username or password";
		}
		// $this->load->view('main',$data);
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}