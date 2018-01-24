<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Db_connect extends CI_Model{

	function insert($table, $data){
		$this->db->insert($table,$data);
	}

	function set($a, $b, $c){
		$this->db->set($a, $b, $c);
	}

	function login($username){
		$this->db->select("*"); 
  		$this->db->from('users');
  		$this->db->where('username', $username);
  		$query = $this->db->get();

		return $query->result();
	}

	function check_login($username, $password){
		$this->db->select("*"); 
  		$this->db->from('users');
  		$this->db->where('username', $username);
  		$this->db->where('password_hash', $password);
  		$query = $this->db->get();

		return $query;

	}
}