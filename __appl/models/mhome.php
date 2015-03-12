<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class mhome extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->auth = unserialize(base64_decode($this->session->userdata('sipbbg-k3pr1')));
	}
	
	function getdata($type="", $p1="", $p2=""){
		$where = " WHERE 1=1 ";
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
					SELECT *, KdProv as id
					FROM cl_provinsi
					$where 
				";
				if($p1=='edit'){
					$sql .=" AND KdProv=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "kabupaten":
				$sql = "
					SELECT A.*, A.KdKabKot as id, B.NmProvinsi
					FROM cl_kabupaten_kota A
					LEFT JOIN cl_provinsi B ON A.KdProv = B.KdProv
					$where
				";
				
				if($p1=='edit'){
					$sql .=" AND KdKabKot=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "jenis_perusahaan":
				$sql = "
					SELECT *, KdJenCP as id
					FROM cl_jenis_perusahaan
					$where 
				";
				if($p1=='edit'){
					$sql .=" AND KdJenCP=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "jenis_bahanbakar":
				$sql = "
					SELECT *, KdBB as id
					FROM cl_jenis_bahan_bakar
					$where 
				";
				if($p1=='edit'){
					$sql .=" AND KdBB=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "klasifikasi_pbbkb":
				$sql = "
					SELECT *, KdKlas as id
					FROM cl_klasifikasi_pbbkb
					$where
				";
				if($p1=='edit'){
					$sql .=" AND KdKlas=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "klasifikasi_pbbkb_pertamina":
				$sql = "
					SELECT A.*, B.NmBB, KdKlasSec as id
					FROM cl_klasifikasi_pbbkb_pertamina A
					LEFT JOIN cl_jenis_bahan_bakar B ON A.KdBB = B.KdBB
					$where
				";
				if($p1=='edit'){
					$sql .=" AND A.KdKlasSec=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "profil_wajib_pungut":
				$sql = "
					SELECT A.*, B.NmKabKot, A.KdCP as id
					FROM tbl_wajib_pungut_pertamina_wil A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
					$where
				";
				if($p1=='edit'){
					$sql .=" AND A.KdCP=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "profil_wajib_pajak":
				$sql = "
					SELECT A.*, B.NmKabKot, C.NmJenCP, A.KdWP as id
					FROM tbl_wajib_pajak_pertamina_daerah A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
					LEFT JOIN cl_jenis_perusahaan C ON A.KdJenCP = C.KdJenCP
					$where
				";
				if($p1=='edit'){
					$sql .=" AND A.KdWP=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "bank":
				$sql = "
					SELECT A.*, KdBank as id, B.NmKabKot
					FROM cl_bank A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
					$where
				";
				if($p1=='edit'){
					$sql .=" AND A.KdBank=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			//end query datamaster
			
			//query setting
			case "tahun_pajak":
				$sql = "
					SELECT *
					FROM cl_tahun_pajak
				";
			break;
			case "target_pajak":
				$sql = "
					SELECT *
					FROM target_pajak
				";
			break;
			case "tingkat_daerah":
				$sql = "
					SELECT *
					FROM cl_tingkat_daerah_pengguna
				";
			break;
			case "jabatan":
				$sql = "
					SELECT *
					FROM cl_jabatan_user
				";
			break;
			case "jabatan":
				$sql = "
					SELECT *
					FROM cl_jabatan_user
				";
			break;
			case "user_level":
				$sql = "
					SELECT *
					FROM cl_level_user
				";
			break;
			case "user_manajemen":
				$sql = "
					SELECT A.*, B.UserLevel, C.Jabatan
					FROM tbl_user A
					LEFT JOIN cl_level_user B ON A.KdLevel = B.KdLevel
					LEFT JOIN cl_jabatan_user C ON A.KdJabatan = C.KdJabatan
				";
			break;
			//end query setting
			
			//modul pungutan_pajak
			case "pbbkb":
				$sql = "
					SELECT A.*,A.RecNo as id, B.NmCP, C.NmWP, D.NmBB, E.NmKlas,E.Persentasi
					FROM tbl_pungutan_pbbkb A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP = B.KdCP
					LEFT JOIN tbl_wajib_pajak_pertamina_daerah C ON A.KdWP = C.KdWP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB = D.KdBB
					LEFT JOIN cl_klasifikasi_pbbkb E ON A.KdKlas = E.KdKlas
				";
				
				if($p1=='edit'){
					$sql .=" WHERE A.RecNo=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
				
				
			break;
			case "pbbkb_pertamina":
				$sql = "
					SELECT A.*,A.RecNo2 as id, B.NmCP, D.NmBB, E.NmKlas
					FROM tbl_punggut_pbbkb_pertamina A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP2 = B.KdCP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB2 = D.KdBB
					LEFT JOIN cl_klasifikasi_pbbkb E ON A.KdKlas2 = E.KdKlas
					WHERE flag_data = 'P'
				";
				if($p1=='edit'){
					$sql .=" AND A.RecNo2=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "pbbkb_pertamina_sektor":
				$sql = "
					SELECT A.*,A.RecNo2 as id, B.NmCP, D.NmBB, E.NmKlass,E.Persentasi
					FROM tbl_punggut_pbbkb_pertamina A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP2 = B.KdCP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB2 = D.KdBB
					LEFT JOIN cl_klasifikasi_pbbkb_pertamina E ON A.KdKlas2 = E.KdKlasSec
					WHERE flag_data = 'S'
				";
				if($p1=='edit'){
					$sql .=" AND A.RecNo2=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "pbbkb_bank":
				$sql = "
					SELECT A.*, B.NmCP,A.RecNo3 as id, D.NmBank
					FROM tbl_pembayaran_pungutan_bank A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP3 = B.KdCP
					LEFT JOIN cl_bank D ON A.KdBank = D.KdBank
				";
				if($p1=='edit'){
					$sql .=" WHERE A.RecNo3=".$this->input->post('id');
					//echo $sql;
					return $this->db->query($sql)->row();
				}
			break;
			//end modul pungutan pajak
			
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
	// GOYZ CROTZZZ
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
				if($sts_crud=='delete'){
					$id=$this->input->post('id');
					unset($data['id']);
				}else{
					$id=$data['RecNo3'];unset($data['RecNo3']);
					unset($data['NmCP']);
					unset($data['NmBank']);
					$data['TglInput3']=date('Y-m-d');
				}
				$field_id="RecNo3";
			break;
			case "tbl_punggut_pbbkb_pertamina":
				if($sts_crud=='delete'){
					$id=$this->input->post('id');
					unset($data['id']);
				}else{
					$id=$data['RecNo2'];unset($data['RecNo2']);
					if(isset($data['NmBB'])){unset($data['NmBB']);}
					unset($data['NmCP']);
					$data['TglInput2']=date('Y-m-d');
				}
				
				$field_id="RecNo2";
			break;
			case "tbl_pungutan_pbbkb":
				if($sts_crud=='delete'){
					$id=$this->input->post('id');
					unset($data['id']);
				}else{
					$id=$data['RecNo'];unset($data['RecNo']);unset($data['NmCP']);unset($data['NmWP']);
					$data['TglInput']=date('Y-m-d');
				}
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
	function get_combo($p1,$p2="",$p3=""){
		switch($p1){
			case "tbl_wajib_pungut_pertamina_wil":
				$sql="SELECT KdCP as id,NmCP as txt FROM tbl_wajib_pungut_pertamina_wil ";
			break;
			case "tbl_wajib_pajak_pertamina_daerah":
				$sql="SELECT KdWP as id,NmWP as txt,KdKlasifikas,B.NmKlas,B.Persentasi from tbl_wajib_pajak_pertamina_daerah A
					LEFT JOIN cl_klasifikasi_pbbkb B ON A.KdKlasifikas=B.KdKlas ORDER BY NmWP ASC";
			break;
			case "cl_klasifikasi_pbbkb_pertamina":
				$sql="SELECT A.KdKlasSec as id,A.NmKlass as txt,A.Persentasi FROM cl_klasifikasi_pbbkb_pertamina A 
				LEFT JOIN cl_jenis_bahan_bakar B ON A.KdBB=B.KdBB ORDER BY A.NmKlass ASC";
			break;
			
			case "cl_jenis_bahan_bakar":
				$sql="SELECT KdBB as id,NmBB as txt FROM cl_jenis_bahan_bakar ";
			break;
			case "cl_bank":
				$sql="SELECT KdBank as id,NmBank as txt FROM cl_bank ORDER BY NmBank";
			break;
			
			case 'cl_provinsi':
				$sql = "
					SELECT KdProv as id, NmProvinsi as txt
					FROM cl_provinsi
					ORDER BY NmProvinsi
				";
			break;
			case 'cl_kabupaten_kota':
				$sql = "
					SELECT KdKabKot as id, NmKabKot as txt
					FROM cl_kabupaten_kota
					ORDER BY NmKabKot
				";
			break;
			case 'cl_jenis_bahan_bakar':
				$sql = "
					SELECT KdBB as id, NmBB as txt
					FROM cl_jenis_bahan_bakar
					ORDER BY NmBB
				";
			break;
			case 'cl_jenis_perusahaan':
				$sql = "
					SELECT KdJenCP as id, NmJenCP as txt
					FROM cl_jenis_perusahaan
					ORDER BY NmJenCP
				";
			break;
			
		}
		return $this->db->query($sql)->result_array();
	}
	// END GOYZ CROTZZZ
	
}