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

		//==============================================================
		// modified by wawan
		//==============================================================
		function get_image_for_volunteer($username)
		{
		    // $this->db->order_by('id', 'RANDOM');
		    // $this->db->limit(1);
		    // $query = $this->db->get($a);

		    $sql = '
		    	SELECT img.image_id, img.image_name, img.width, img.height, usr.userin,
		    		COUNT(DISTINCT dcr.image_id) AS cnt_lbl
		    	FROM images img
		    	LEFT JOIN dots_coordinate dcr 
		    		ON img.image_id = dcr.image_id
		    	LEFT JOIN (
		    		SELECT DISTINCT image_id, userin 
		    		FROM dots_coordinate
		    		WHERE userin = \''.$username.'\'
		    	) usr
		    		ON img.image_id = usr.image_id
		    	GROUP BY img.image_id, img.image_name, usr.userin
		    	HAVING usr.userin IS NULL AND COUNT(DISTINCT dcr.image_id) < 3 
		    	ORDER BY cnt_lbl
		    	LIMIT 5
		    	';
		    $query = $this->db->query($sql);
		    $res = $query->result();
		    $cnt = count($res);

		    $idx = rand(0,$cnt-1); 

		    if($cnt>0){
		    	return $res[$idx];
		    } else {
		    	return NULL;
		    }


		    return $query->result();
		}

		function get_image_for_admin($username)
		{
		    // $this->db->order_by('id', 'RANDOM');
		    // $this->db->limit(1);
		    // $query = $this->db->get($a);

		    $sql = "
		    	SELECT vln.userin, COUNT(adm.userin) AS cnt
		    	FROM images img
		    	INNER JOIN (
		    		SELECT DISTINCT image_id, userin 
		    		FROM dots_coordinate dcr
		    		INNER JOIN users usr 	
		    			ON dcr.userin = usr.username
		    		WHERE usr.role = 'volunteer'
		    	) vln
		    		ON img.image_id = vln.image_id
		    	LEFT JOIN (
		    		SELECT DISTINCT image_id, userin 
		    		FROM dots_coordinate dcr
		    		INNER JOIN users usr 	
		    			ON dcr.userin = usr.username
		    		WHERE usr.role = 'admin'
		    	) adm
		    		ON img.image_id = adm.image_id
		    	GROUP BY vln.userin
		    	HAVING COUNT(adm.userin) < 2
		    	ORDER BY vln.userin
		    	";
		    $query = $this->db->query($sql);
		    $res = $query->result();
		    $cnt = count($res);
		    if($cnt>0){
			    $idx = rand(0,$cnt-1); 
			    $userin = $res[$idx]->userin;
		    	$sql = "
			    	SELECT DISTINCT img.image_id, img.image_name
			    	FROM images img
			    	INNER JOIN dots_coordinate dcr1
			    		ON img.image_id = dcr1.image_id AND dcr1.userin = '$userin'
			    	LEFT JOIN (
			    		SELECT DISTINCT image_id, userin 
			    		FROM dots_coordinate dcr
			    		INNER JOIN users usr 	
			    			ON dcr.userin = usr.username
			    		WHERE usr.role = 'admin'
			    	) adm
			    		ON img.image_id = adm.image_id
			    	WHERE adm.userin IS NULL
			    	";

			    $query = $this->db->query($sql);
			    $res = $query->result();
			    $cnt = count($res);
		    	$idx = rand(0,$cnt-1); 

			    if($cnt>0){
			    	$img = $res[$idx];
			    } else {
			    	$img = NULL;
			    }		    
		    } else {
		    	$img = NULL;
		    }		   	    

		    return $img;
		}

		function get_all_dotscount_image_name($username){
			// $username='staff';
			$sql = "
				SELECT image_id, image_name FROM images WHERE image_id IN (SELECT DISTINCT image_id FROM dots_count WHERE username ='$username')
				ORDER BY image_id
			";
			$query = $this->db->query($sql);
			return $query->result();
		}		

		function get_all_dist_image_name($username){
			// $username='staff';
			$sql = "
				SELECT ddt.image_id, img.image_name, AVG(ddt.distance) AS distance 
				FROM dots_distance ddt
				INNER JOIN images img 
					ON img.image_id = ddt.image_id
				INNER JOIN users usr
					ON ddt.username2 = usr.username AND usr.role='volunteer'
				WHERE ddt.username1 ='$username' 
				GROUP BY ddt.image_id, img.image_name 
				ORDER BY AVG(distance) DESC 
				LIMIT 5
			";
			$query = $this->db->query($sql);
			return $query->result();
		}		

		function get_all_dotscount_gt_image_name($username){
			$sql = "
				SELECT DISTINCT img.image_id, img.image_name FROM images img 
				INNER JOIN dots_count dct2 ON img.image_id = dct2.image_id 
				INNER JOIN users usr ON dct2.username = usr.username AND usr.role = 'admin'
				INNER JOIN dots_count dct1 ON img.image_id = dct1.image_id AND dct1.username = '$username'
				LIMIT 2
			";
			$query = $this->db->query($sql);
			return $query->result();
		}		

		function get_all_dist_gt_image_name($username){
			$sql = "
				SELECT DISTINCT img.image_id, img.image_name FROM images img 
				INNER JOIN dots_distance ddt ON img.image_id = ddt.image_id AND ddt.username1 = '$username'
				INNER JOIN users usr ON ddt.username2 = usr.username AND usr.role = 'admin'
				LIMIT 2
			";
			// print_r($sql);
			// die();
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

		function get_other_dist_data($username, $images){
			$length = count($images);
			for ($i=0; $i < $length; $i++) { 
				$image_id = $images[$i]->image_id;
				$sql = "
					SELECT dct.username1, dct.username2, dct.image_id, AVG(dct.distance) AS distance
					FROM dots_distance dct
					INNER JOIN users usr 
						ON dct.username2 = usr.username
					WHERE dct.username1 = '$username'
					AND usr.role = 'volunteer'
					AND dct.image_id = '$image_id'
					GROUP BY dct.username1, dct.username2, dct.image_id
					ORDER BY dct.username2
					LIMIT 2
				";
				$query = $this->db->query($sql);
				$result = $query->result();

				$usr1_dists[$i] = $result[0];
				$usr2_dists[$i] = $result[1];
			}
			return array($usr1_dists, $usr2_dists);
		}

		function get_all_dots_count_data($username, $images){
			$list_images = $images[0]->image_id;
			
			$length = count($images);
			for ($i=1; $i < $length; $i++) { 
				$list_images.=', '.$images[$i]->image_id;
			}
			$sql = "
				SELECT username, image_id, dots_count
				FROM dots_count 
				WHERE username = '$username'
				AND image_id in (".$list_images.")
				ORDER BY image_id
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_other_dots_count_data($usr0_counts){
			$length = count($usr0_counts);
			for ($i=0; $i < $length; $i++) { 
				$username = $usr0_counts[$i]->username;
				$image_id = $usr0_counts[$i]->image_id;
				$sql = "
					SELECT *
					FROM dots_count dct
					INNER JOIN users usr 
						ON dct.username = usr.username
					WHERE dct.username <> '$username'
					AND usr.role = 'volunteer'
					AND dct.image_id = '$image_id'
					ORDER BY dct.username
					LIMIT 2
				";
				$query = $this->db->query($sql);
				$result = $query->result();

				$usr1_counts[$i] = $result[0];
				$usr2_counts[$i] = $result[1];
			}
			return array($usr1_counts, $usr2_counts);
		}			

		function get_all_dots_count_gt_data($username, $images){
			$list_images = $images[0]->image_id;
			
			$length = count($images);
			for ($i=1; $i < $length; $i++) { 
				$list_images.=', '.$images[$i]->image_id;
			}
			$sql = "
				SELECT dct1.username, dct2.username AS username_admin, dct1.image_id, img.image_name,
					dct1.dots_count AS dots_count_vln, dct2.dots_count AS dots_count_adm
				FROM dots_count dct1
				INNER JOIN images img ON dct1.image_id = img.image_id
				INNER JOIN dots_count dct2 ON dct1.image_id = dct2.image_id 
					AND dct1.username <> dct2.username
				INNER JOIN users usr ON dct2.username = usr.username AND usr.role = 'admin'
				WHERE dct1.username = '$username'
				AND dct1.image_id in (".$list_images.")
				ORDER BY ABS(dct1.dots_count - dct2.dots_count) DESC
			";
			$query = $this->db->query($sql);
			return $query->result();
		}		

		function get_all_dist_gt_data($username, $images){
			$list_images = $images[0]->image_id;
			
			$length = count($images);
			for ($i=1; $i < $length; $i++) { 
				$list_images.=', '.$images[$i]->image_id;
			}
			$sql = "
				SELECT ddt.username1, ddt.username2, ddt.image_id, img.image_name,
					AVG(ddt.distance) AS distance
				FROM dots_distance ddt
				INNER JOIN images img ON ddt.image_id = img.image_id
				INNER JOIN users usr ON ddt.username2 = usr.username AND usr.role = 'admin'
				WHERE ddt.username1 = '$username'
				AND ddt.image_id in (".$list_images.")
				GROUP BY ddt.username1, ddt.username2, ddt.image_id, img.image_name
				ORDER BY AVG(ddt.distance) DESC
			";
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		function get_all_dots_coordinate(){
			$sql = "
				SELECT * FROM dots_coordinate
			";
			$query = $this->db->query($sql);
			return $query->result();

		}

		function drop_user_dots_distance(){
			$sql = "
				TRUNCATE TABLE dots_distance
			";
			$query = $this->db->query($sql);
			if($query)
				return true;
			return false;
		}

		function insert_user_dots_distance($username1,$username2,$image_id,$coordinate_id1,$coordinate_id2,$distance){

			$sql = "
				INSERT INTO dots_distance VALUES('$username1','$username2','$image_id','$coordinate_id1','$coordinate_id2','$distance')
			";
			$query = $this->db->query($sql);
			if($query)
				return true;
			return false;
		}

		function drop_user_dots_count(){
			$sql = "
				TRUNCATE TABLE dots_count
			";
			$query = $this->db->query($sql);
			if($query)
				return true;
			return false;
		}

		function insert_user_dots_count(){

			$sql = "
				INSERT INTO dots_count
				SELECT userin as username, image_id, count(*) as dots_count from dots_coordinate 
				GROUP BY userin, image_id
			";
			$query = $this->db->query($sql);
			if($query)
				return true;
			return false;
		}
	}
?>
