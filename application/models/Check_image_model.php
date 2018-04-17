<?php
	class Check_image_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->library('Upload');
		}

		function get_dots($image_id, $username)
		{
		    // $this->db->order_by('id', 'RANDOM');
		    // $this->db->limit(1);
		    // $query = $this->db->get($a);

		    $sql = '
		    	SELECT dcr.x, dcr.y
		    	FROM dots_coordinate dcr
		    	WHERE dcr.image_id = \''.$image_id.'\'
		    	AND dcr.userin = \''.$username.'\'
		    	';
		    $query = $this->db->query($sql);


		    return $query->result();
		}		

		function get_image_info($image_id)
		{
		    // $this->db->order_by('id', 'RANDOM');
		    // $this->db->limit(1);
		    // $query = $this->db->get($a);

		    $sql = '
		    	SELECT img.image_id, img.image_name
		    	FROM images img
		    	WHERE img.image_id = \''.$image_id.'\'
		    	LIMIT 1
		    	';
		    $query = $this->db->query($sql);


		    return $query->result();
		}		
	}

?>