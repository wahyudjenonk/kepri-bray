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
			//query datamaster
			case "provinsi":
				$sql = "
					SELECT *
					FROM cl_provinsi
				";
			break;
			case "kabupaten":
				$sql = "
					SELECT *
					FROM cl_kabupaten_kota
				";
			break;
			case "jenis_perusahaan":
				$sql = "
					SELECT *
					FROM cl_jenis_perusahaan
				";
			break;
			case "jenis_bahanbakar":
				$sql = "
					SELECT *
					FROM cl_jenis_bahan_bakar
				";
			break;
			case "klasifikasi_pbbkb":
				$sql = "
					SELECT *
					FROM cl_klasifikasi_pbbkb
				";
			break;
			case "klasifikasi_pbbkb_pertamina":
				$sql = "
					SELECT A.*, B.NmBB
					FROM cl_klasifikasi_pbbkb_pertamina A
					LEFT JOIN cl_jenis_bahan_bakar B ON A.KdBB = B.KdBB
				";
			break;
			case "profil_wajib_pungut":
				$sql = "
					SELECT A.*, B.NmKabKot
					FROM tbl_wajib_pungut_pertamina_wil A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
				";
			break;
			case "profil_wajib_pajak":
				$sql = "
					SELECT A.*, B.NmKabKot, C.NmJenCP, D.NmKlas
					FROM tbl_wajib_pajak_pertamina_daerah A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
					LEFT JOIN cl_jenis_perusahaan C ON A.KdJenCP = C.KdJenCP
					LEFT JOIN cl_klasifikasi_pbbkb D ON A.KdKlas = D.KdKlas
				";
			break;
			case "bank":
				$sql = "
					SELECT *
					FROM cl_bank
				";
			break;
			//end query datamaster
		}
		return $this->get_json($sql);
	}
	
	function get_json($sql="", $table=""){
		$page = (integer) (($this->input->post('page')) ? $this->input->post('page') : "1");
		$limit = (integer) (($this->input->post('rows')) ? $this->input->post('rows') : "10");
		 
		$count = $this->db->query($sql)->num_rows();
		
		if( $count >0 ) { $total_pages = ceil($count/$limit); } else { $total_pages = 0; } 
		if ($page > $total_pages) $page=$total_pages; 
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		if($start<0) $start=0;
		  
		$sql = $sql . " LIMIT $start,$limit";
	
		$data=$this->db->query($sql)->result_array();  
				
		if($data){
		   $responce = new stdClass();
		   $responce->rows= $data;
		   $responce->total =$count;
		   return json_encode($responce);
		}else{ 
		   $responce = new stdClass();
		   $responce->rows = 0;
		   $responce->total = 0;
		   return json_encode($responce);
		} 
	}
	
}