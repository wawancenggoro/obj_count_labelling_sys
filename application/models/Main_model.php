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
				return $query->result();
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

		function get_random_image($username)
		{
		    // $this->db->order_by('id', 'RANDOM');
		    // $this->db->limit(1);
		    // $query = $this->db->get($a);

		    $sql = '
		    	SELECT img.image_id, img.image_name, usr.userin,
		    		COUNT(DISTINCT dcr.image_id) AS cnt_lbl
		    	FROM images img
		    	LEFT JOIN (
		    		SELECT DISTINCT image_id, userin 
		    		FROM dots_coordinate
		    		WHERE userin = \'$username\'
		    	) usr
		    		on img.image_id = usr.image_id
		    	LEFT JOIN dots_coordinate dcr 
		    		ON img.image_id = dcr.image_id
		    	GROUP BY img.image_id, img.image_name, usr.userin
		    	HAVING usr.userin IS NULL
		    	ORDER BY cnt_lbl
		    	LIMIT 1
		    	';
		    $query = $this->db->query($sql);


		    return $query->result();
		}

		function get_all_image_name(){
			$username='staff';
			$sql = "
				SELECT image_name FROM images where image_id in (SELECT DISTINCT image_id FROM dots_coordinate WHERE userin ='$username')
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_all_username(){
			$sql = '
				SELECT username FROM users
			';
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_all_dots_count_data($username){
			$sql = "
				SELECT * FROM dots_count where username = '$username'
			";
			$query = $this->db->query($sql);
			return $query->result();

		}
			
	}

?>