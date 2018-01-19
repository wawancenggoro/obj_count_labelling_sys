<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Db_connect extends CI_Model{

	function insert($table, $data){
		$this->db->insert($table,$data);
	}

	function set($a, $b, $c){
		$this->db->set($a, $b, $c);
	}
}