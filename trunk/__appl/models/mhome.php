<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class mhome extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->auth = unserialize(base64_decode($this->session->userdata('sipbbg-k3pr1')));
	}
	
	function getdata($type="", $p1="", $p2=""){
		switch($type){
			case "data_login":
				$sql = "
					SELECT *
					FROM tbl_user
					WHERE UserLogin = '".$p1."'
				";
				return $this->db->query($sql)->row_array();
			break;
		}
	}
}