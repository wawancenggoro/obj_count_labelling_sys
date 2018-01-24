<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marking extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('db_connect');
		$this->load->helper('url');
		$this->load->library('session');
 
	}

    public function view($page = 'marking')
    {
    	if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view($page, $data);
    }

    public function insert(){
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
}