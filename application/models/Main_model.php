<?php
	class Main_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->library('Upload');
		}

		function can_login($username,$password){
			$this->db->where('username',$username);
			$this->db->where('password_hash',md5($password));
			$query = $this->db->get('users');

			if($query->num_rows()>0){
				return true;
			}
			else{
				return false;
			}
		}

		function register(){
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$role = $this->input->post('role');
			$data = array(
				'username'=>$username,
				'password_hash'=>$password,
				'role'=>$role
			);
			$this->db->insert('users',$data);
		}

		function File_upload($data){
			$this->db->insert('images',$data);
		}
		
		function get_data($a){
			$this->load->database("");
			$r=$this->db->get($a);
			return $r->result();

		}
			
	}

?>