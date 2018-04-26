<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CheckImage extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('db_connect');
		$this->load->model('check_image_model');
		$this->load->helper('url');
		$this->load->library('session');
 
	}
    
    //========================================================================
    // added by wawan
    //========================================================================
    public function view_check_image($image_id, $user0, $user1, $user2=NULL)
    {
    	$page = 'check_image_view';
    	if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        // $this->load->model('main_model');
        $a['user0']=$user0;
    	$a['dots0']=$this->check_image_model->get_dots($image_id, $user0);

        $a['user1']=$user1;
        $a['dots1']=$this->check_image_model->get_dots($image_id, $user1);

        if (isset($user2)){
            $a['user2']=$user2;
            $a['dots2']=$this->check_image_model->get_dots($image_id, $user2);            
        }

    	$a['image_info']=$this->check_image_model->get_image_info($image_id);

        $this->load->view($page, $a);
    }
    //========================================================================
}