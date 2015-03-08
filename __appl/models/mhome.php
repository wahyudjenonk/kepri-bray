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
	
	function crud_na($table,$data,$sts_crud){//$sts_crud --> STATUS NYEE INSERT, UPDATE, DELETE
		$this->db->trans_begin();
		switch ($table){
			case "cl_bank":
				//if(isset($data['KdBank'])){
					$id=$data['KdBank'];unset($data['KdBank']);
				//}
				$field_id="KdBank";
			break;
			case "cl_jabatan_user":
				$id=$data['KdJabatan'];	unset($data['KdJabatan']);
				$field_id="KdJabatan";
			break;
			case "cl_jenis_bahan_bakar":
				$id=$data['KdBB'];unset($data['KdBB']);
				$field_id="KdBB";
			break;
			case "cl_jenis_perusahaan":
				$id=$data['KdJenCP'];unset($data['KdJenCP']);
				$field_id="KdJenCP";
			break;
			case "cl_kabupaten_kota":
				$id=$data['KdKabKot'];unset($data['KdKabKot']);
				$field_id="KdKabKot";
			break;
			case "cl_klasifikasi_pbbkb":
				$id=$data['KdKlas'];unset($data['KdKlas']);
				$field_id="KdKlas";
			break;
			case "cl_klasifikasi_pbbkb_pertamina":
				$id=$data['KdKlasSec'];unset($data['KdKlasSec']);
				$field_id="KdKlasSec";
			break;
			case "cl_level_user":
				$id=$data['KdLevel'];unset($data['KdLevel']);
				$field_id="KdLevel";
			break;
			case "cl_provinsi":
				$id=$data['KdProv'];unset($data['KdProv']);
				$field_id="KdProv";
			break;
			case "cl_tahun_pajak":
				$id=$data['ThnPajak'];unset($data['ThnPajak']);
				$field_id="ThnPajak";
			break;
			case "cl_tingkat_daerah_pengguna":
				$id=$data['KdTk'];unset($data['KdTk']);
				$field_id="KdTk";
			break;
			case "target_pajak":
				$id=$data['ThnPajak'];unset($data['ThnPajak']);
				$field_id="ThnPajak";
			break;
			case "tbl_lembaga_pengguna_owner":
				$id=$data['KdDinas'];unset($data['KdDinas']);
				$field_id="KdDinas";
			break;
			case "tbl_pembayaran_pungutan_bank":
				$id=$data['RecNo3'];unset($data['RecNo3']);
				$field_id="RecNo3";
			break;
			case "tbl_punggut_pbbkb_pertamina":
				$id=$data['RecNo2'];unset($data['RecNo2']);
				$field_id="RecNo2";
			break;
			case "tbl_pungutan_pbbkb":
				$id=$data['RecNo'];unset($data['RecNo']);
				$field_id="RecNo";
			break;
			case "tbl_user":
				$id=$data['KdUser'];unset($data['KdUser']);
				$pass=$data['Password'];
				unset($data['Password']);
				$data['Password']=$this->encrypt->encode($pass);
				$field_id="KdUser";
			break;
			case "tbl_wajib_pajak_pertamina_daerah":
				$id=$data['KdWP'];unset($data['KdWP']);
				$field_id="KdWP";
			break;
			case "tbl_wajib_pungut_pertamina_wil":
				$id=$data['KdCP'];unset($data['KdCP']);
				$field_id="KdCP";
			break;
		}
		switch ($sts_crud){
			case "add":
				$this->db->insert($table,$data);
			break;
			case "edit":
				$this->db->where($field_id,$id);
				$this->db->update($table,$data);
			break;
			case "delete":
				$this->db->where($field_id,$id);
				$this->db->delete($table,$data);
			break;
		}
		
		if($this->db->trans_status() == false){
			$this->db->trans_rollback();
			return 0;
		} else{
			return $this->db->trans_commit();
		}
		
	}
	
}