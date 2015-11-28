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
					WHERE nama_user = '".$p1."'
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
					SELECT *, ThnPajak as id
					FROM cl_tahun_pajak
					$where
				";
				if($p1=='edit'){
					$sql .=" AND ThnPajak=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "target_pajak":
				$sql = "
					SELECT *, ThnPajak as id
					FROM target_pajak
					$where
				";
				if($p1=='edit'){
					$sql .=" AND ThnPajak=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "tingkat_daerah":
				$sql = "
					SELECT *, KdTk as id
					FROM cl_tingkat_daerah_pengguna
					$where
				";
				if($p1=='edit'){
					$sql .=" AND KdTk=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "jabatan":
				$sql = "
					SELECT *, KdJabatan as id
					FROM cl_jabatan_user
					$where
				";
				if($p1=='edit'){
					$sql .=" AND KdJabatan=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "owner":
				$sql = "
					SELECT A.*, B.NmKabKot, A.KdDinas as id, C.KetTk
					FROM tbl_lembaga_pengguna_owner A
					LEFT JOIN cl_kabupaten_kota B ON A.KdKabKot = B.KdKabKot
					LEFT JOIN cl_tingkat_daerah_pengguna C ON A.KdTk = C.KdTk
					
				";
				if($p1=='edit'){
					$sql .=" AND A.KdDinas=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "denda":
				$sql = "
					SELECT *
					FROM tbl_denda
					$where
				";
				if($p1=='edit'){
					$sql .=" AND id=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;			
			case "user_level":
				$sql = "
					SELECT *, KdLevel as id
					FROM cl_level_user
					$where
				";
				if($p1=='edit'){
					$sql .=" AND KdLevel=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			case "user_manajemen":
				$sql = "
					SELECT A.*, B.UserLevel, C.Jabatan, A.KdUser as id
					FROM tbl_user A
					LEFT JOIN cl_level_user B ON A.KdLevel = B.KdLevel
					LEFT JOIN cl_jabatan_user C ON A.KdJabatan = C.KdJabatan
					$where
				";
				if($p1=='edit'){
					$sql .=" AND KdUser=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			//end query setting
			
			//modul pungutan_pajak
			case "pbbkb":
				$sql = "
					SELECT A.*,A.RecNo as id, B.NmCP, C.NmWP, D.NmBB
					FROM tbl_pungutan_pbbkb A
					LEFT JOIN tbl_wajib_pungut_non_pertamina B ON A.KdCP = B.KdCP
					LEFT JOIN tbl_wajib_pajak_non_pertamina C ON A.KdWP = C.KdWP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB = D.KdBB
				
				";
				
				if($p1=='edit'){
					$sql .=" WHERE A.RecNo=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
				
				
			break;
			case "denda_pbbkb":
				$sql = "
					SELECT A.*
					FROM tbl_denda A ";
				
				
				if($p1=='edit'){
					$sql .=" WHERE A.id=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
				if($p1=='get'){
					return $this->db->query($sql)->row_array();
				}
				
				
			break;
			/*case "pbbkb_pertamina":
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
			break;*/
			case "tbl_punggut_pbbkb_pertamina_wil_klas_sektor":
			case "pbbkb_pertamina":
				$sql = "
					SELECT A.*,A.RecNo2 as id, B.NmCP,C.NmWP, D.NmBB
					FROM tbl_punggut_pbbkb_pertamina_wil_klas_sektor A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP2 = B.KdCP
					LEFT JOIN tbl_wajib_pajak_pertamina_daerah C ON A.KdWP2=C.KdWP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB2 = D.KdBB
					WHERE flag_data = 'P'
				";
				if($p1=='edit'){
					$sql .=" AND A.RecNo2=".$this->input->post('id');
					return $this->db->query($sql)->row();
				}
			break;
			/*case "pbbkb_pertamina_sektor":
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
			break;*/
			case "pbbkb_pertamina_sektor":
			case "tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi":
				$sql = "
					SELECT A.*,A.RecNo4 as id, B.NmCP, D.NmBB, E.NmKlass,E.Persentasi
					FROM tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi A
					LEFT JOIN tbl_wajib_pungut_pertamina_wil B ON A.KdCP4 = B.KdCP
					LEFT JOIN cl_jenis_bahan_bakar D ON A.KdBB4 = D.KdBB
					LEFT JOIN cl_klasifikasi_pbbkb_pertamina E ON A.KdKlasSec4 = E.KdKlasSec
				";
				if($p1=='edit'){
					$sql .=" AND A.RecNo4=".$this->input->post('id');
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
			
			//Modul Report
			case "wajib_pajak":
				$sql = "
					SELECT KdWP, NmWP
					FROM tbl_wajib_pajak_pertamina_daerah
				";
				return $this->db->query($sql)->result_array();
			break;
			case "kabupaten_report":
				$sql = "
					SELECT KdKabKot, NmKabKot
					FROM cl_kabupaten_kota
				";
				return $this->db->query($sql)->result_array();
			break;
			case "jenis_bb_report":
				$sql = "
					SELECT KdBB, NmBB
					FROM cl_jenis_bahan_bakar
				";
				return $this->db->query($sql)->result_array();
			break;
			//End Modul Report
			
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
				$id=$data['ThnPajak'];
				$field_id="ThnPajak";
			break;
			case "cl_tingkat_daerah_pengguna":
				$id=$data['KdTk'];unset($data['KdTk']);
				$field_id="KdTk";
			break;
			case "target_pajak":
				$id=$data['ThnPajak']; //unset($data['ThnPajak']);
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
			case "tbl_punggut_pbbkb_pertamina_wil_klas_sektor":
			case "tbl_punggut_pbbkb_pertamina":
				if($sts_crud=='delete'){
					$id=$this->input->post('id');
					unset($data['id']);
				}else{
					$id=$data['RecNo2'];unset($data['RecNo2']);
					if(isset($data['NmBB'])){unset($data['NmBB']);}
					unset($data['NmWP']);
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
			case "tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi":
				if($sts_crud=='delete'){
					$id=$this->input->post('id');
					unset($data['id']);
				}else{
					$id=$data['RecNo4'];unset($data['RecNo4']);
					$data['TglInput4']=date('Y-m-d');
				}
				$field_id="RecNo4";
			break;
			case "tbl_user":
				$this->load->library('encrypt');
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
			case "tbl_denda":
				$id=$data['id'];
				$field_id="id";
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
			case "tbl_wajib_pungut_non_pertamina":
				$sql="SELECT KdCP as id,NmCP as txt FROM tbl_wajib_pungut_non_pertamina ";
			break;
			case "cl_jenis_pungutan":
				$sql="SELECT id,jenis_pungutan as txt FROM cl_jenis_pungutan ";
			break;
			/*case "cl_klasifikasi_pbbkb_pertamina":
				$sql="SELECT * FROM cl_klasifikasi_pbbkb_pertamina ";
			break;*/
			case "tbl_wajib_pajak_non_pertamina":
				$sql="SELECT KdWP as id,NmWP as txt FROM tbl_wajib_pajak_non_pertamina ";
			break;
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
			
			case "cl_klasifikasi_pbbkb":
				$sql="SELECT KdKlas as id,NmKlas as txt FROM cl_klasifikasi_pbbkb ";
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
			case 'cl_tahun_pajak':
				$sqlceker = "
					SELECT ThnPajak
					FROM target_pajak
					GROUP BY ThnPajak
				";
				$queryceker = $this->db->query($sqlceker)->result_array();
				$array = array();
				foreach($queryceker as $k => $v){
					$array[] = $v['ThnPajak'];
				}
				
				$sql = "
					SELECT ThnPajak as id, ThnPajak as txt
					FROM cl_tahun_pajak
					WHERE ThnPajak NOT IN ('".join("','",$array)."')
					ORDER BY ThnPajak
				";
			break;
			case 'cl_level_user':
				$sql = "
					SELECT KdLevel as id, UserLevel as txt
					FROM cl_level_user
					ORDER BY UserLevel
				";
			break;
			case 'cl_jabatan_user':
				$sql = "
					SELECT KdJabatan as id, Jabatan as txt
					FROM cl_jabatan_user
					ORDER BY Jabatan
				";
			break;
			case 'cl_tingkat_daerah_pengguna':
				$sql = "
					SELECT KdTk as id, KetTk as txt
					FROM cl_tingkat_daerah_pengguna
					ORDER BY KetTk
				";
			break;
		}
		return $this->db->query($sql)->result_array();
	}
	
	function get_dashboard_data($p1){
		$data =array();
		
		switch ($p1){
			case "realisasi":
				$tahun_skr=date('Y');
				$tahun_blm=$tahun_skr-1;
				for($i=1;$i<=12;$i++){
					$bulan=$this->konversi_bulan($i);
					$qry_skr=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_skr)->row('pajak');
					$qry_blm=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_blm)->row('pajak');	
					$data[$i]=array();
					//$data[$i][$tahun_skr]=(isset($qry_skr) ? number_format($qry_skr,2) : '-');
					//$data[$i][$tahun_blm]=(isset($qry_blm) ? number_format($qry_blm,2) : '-');
					$data[$i]['data'] = array(
						'bulan' => $bulan, 
						$tahun_skr => (isset($qry_skr) ? number_format($qry_skr,0) : '-'),
						$tahun_blm => (isset($qry_blm) ? number_format($qry_blm,0) : '-')
					);
				}
			break;
			case "apbd":
			case "apbdp":
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
				
				if($bulan && $tahun){
					$tahun_skr = $tahun;
					$bulan_skr = $bulan;
				}else{
					$tahun_skr=date('Y');
					$bulan_skr=date('m');
				}
				
				$sql="SELECT A.*,B.pajak as pajak_blm,C.pajak as pajak_skr,B.pajak+c.pajak as total,
						((B.pajak+c.pajak)/A.TargetTaxAPBD)*100 as real_apbd,((B.pajak+c.pajak)/A.TargetTaxAPBDP)*100 as real_apbdp
						FROM target_pajak A 
						LEFT JOIN (
							SELECT A.TaxThn as tahun,SUM(A.Tax)as pajak,B.TargetTaxAPBD,B.TargetTaxAPBDP 
							FROM tbl_pungutan_pbbkb A 
							LEFT JOIN target_pajak B ON A.TaxThn=B.ThnPajak
							WHERE A.TaxBulan < ".$bulan_skr." AND A.TaxThn=".$tahun_skr."
							GROUP BY A.TaxThn,B.TargetTaxAPBD,B.TargetTaxAPBDP
						)AS B ON A.ThnPajak=B.tahun
						LEFT JOIN (
							SELECT A.TaxThn as tahun,SUM(A.Tax)as pajak,B.TargetTaxAPBD,B.TargetTaxAPBDP 
							FROM tbl_pungutan_pbbkb A 
							LEFT JOIN target_pajak B ON A.TaxThn=B.ThnPajak
							WHERE A.TaxBulan = ".$bulan_skr." AND A.TaxThn=".$tahun_skr."
							GROUP BY A.TaxThn,B.TargetTaxAPBD,B.TargetTaxAPBDP
						)AS C ON A.ThnPajak=C.tahun WHERE A.ThnPajak=".$tahun_skr;
			
				$qry=$this->db->query($sql)->row();
				if(isset($qry->pajak_blm)){$pajak_blm=$qry->pajak_blm;}else{$pajak_blm=0;}
				if(isset($qry->pajak_skr)){$pajak_skr=$qry->pajak_skr;}else{$pajak_skr=0;}
				if(isset($qry->TargetTaxAPBD)){$apbd=$qry->TargetTaxAPBD;}else{$apbd=0;}
				if(isset($qry->TargetTaxAPBDP)){$apbdp=$qry->TargetTaxAPBDP;}else{$apbdp=0;}
				
				$total=$pajak_blm+$pajak_skr;
				if($apbd != 0){
					$real_apbd = (($pajak_blm+$pajak_skr)/$apbd)*100;
				}else{
					$real_apbd = 0;
				}
				
				if($apbdp != 0){
					$real_apbdp = (($pajak_blm+$pajak_skr)/$apbdp)*100;
				}else{
					$real_apbdp = 0;
				}
				
				$bulan=$this->konversi_bulan($bulan_skr);
				$data=array(
					'target_apbd'=>(isset($qry->TargetTaxAPBD) ? number_format($qry->TargetTaxAPBD,2) : '-'),
					'target_apbdp'=>(isset($qry->TargetTaxAPBDP) ? number_format($qry->TargetTaxAPBDP,2) : '-'),
					'pajak_blm'=>(isset($qry->pajak_blm) ? number_format($qry->pajak_blm,2) : '-'),
					'pajak_skr'=>(isset($qry->pajak_skr) ? number_format($qry->pajak_skr,2) : '-'),
					'total'=>number_format($total,2),
					'real_apbd'=>number_format($real_apbd,2),
					'real_apbdp'=>number_format($real_apbdp,2),
				);
				
				/*for($i=1;$i<=12;$i++){
					$bulan=$this->konversi_bulan($i);
					$qry_skr=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_skr)->row('pajak');
					$qry_blm=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_blm)->row('pajak');	
					$data[$i]=array();
					//$data[$i][$tahun_skr]=(isset($qry_skr) ? number_format($qry_skr,2) : '-');
					//$data[$i][$tahun_blm]=(isset($qry_blm) ? number_format($qry_blm,2) : '-');
					$data[$i]['data']=array('bulan'=>$bulan,'thn_skr'=>(isset($qry_skr) ? number_format($qry_skr,2) : '-'),'thn_blm'=>(isset($qry_blm) ? number_format($qry_blm,2) : '-'));
				}*/
			break;
			case 'chart_line':
				$tahun_skr=date('Y');
				$tahun_blm=$tahun_skr-1;
				$data = array();
				$data['tahun_sekarang'] = $tahun_skr;
				$data['tahun_kemaren'] = $tahun_blm;
				$data['tahun_ini'] = array();
				$data['tahun_wingi'] = array();
				for($i=1;$i<=12;$i++){
					$bulan=$this->konversi_bulan($i);
					$qry_skr=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_skr)->row('pajak');
					$qry_blm=$this->db->query("SELECT SUM(tax)as pajak FROM tbl_pungutan_pbbkb WHERE TaxBulan=".$i." AND TaxThn=".$tahun_blm)->row('pajak');	
					
					$data['tahun_ini'][$i] = (isset($qry_skr) ? (float)$qry_skr : 0);
					$data['tahun_wingi'][$i] = (isset($qry_blm) ? number_format($qry_blm,0) : 0);
					
					//$data[$i]=array();	
					//$data[$i][$tahun_skr]=(isset($qry_skr) ? number_format($qry_skr,0) : 0);
					//$data[$i][$tahun_blm]=(isset($qry_blm) ? number_format($qry_blm,0) : 0);
					//$data[$i]['data']=array('bulan'=>$bulan,'thn_skr'=>(isset($qry_skr) ? number_format($qry_skr,0) : 0),'thn_blm'=>(isset($qry_blm) ? number_format($qry_blm,2) : 0));
				}
			break;
		}
		//print_r($data);exit;
		return $data;
	}
	
	function konversi_bulan($bln){
		switch($bln){
			case 1:$bulan='Januari';break;
			case 2:$bulan='Februari';break;
			case 3:$bulan='Maret';break;
			case 4:$bulan='April';break;
			case 5:$bulan='Mei';break;
			case 6:$bulan='Juni';break;
			case 7:$bulan='Juli';break;
			case 8:$bulan='Agustus';break;
			case 9:$bulan='September';break;
			case 10:$bulan='Oktober';break;
			case 11:$bulan='November';break;
			case 12:$bulan='Desember';break;
		}
		return $bulan;
	}
	function report_data($p1, $p2=""){
		switch($p1){
			case "skpd":
				$array = array();
				foreach($p2 as $k => $v){
					$array[$v['KdWP']]['id_perusahaan'] = $v['KdWP'];
					$array[$v['KdWP']]['nama_perusahaan'] = $v['NmWP'];
					$array[$v['KdWP']]['detail_skpd'] = array();
					$tot = null;
					for($i=1;$i<=12;$i++){
						$sql_skpd = "
							SELECT sum(Tax) as Tax
							FROM tbl_pungutan_pbbkb
							WHERE TaxBulan = '".$i."'
							AND KdWP = '".$v['KdWP']."' AND TaxThn = '".date('Y')."'
						";
						$query_skpd = $this->db->query($sql_skpd)->row_array();
						
						$pajak_beneran = ( isset($query_skpd['Tax']) ? $query_skpd['Tax'] : null );
						$pajak_format = ( isset($query_skpd['Tax']) ? "Rp.".number_format($query_skpd['Tax'],0,",",".") : null );
						$array[$v['KdWP']]['detail_skpd'][$i] = array();
						$array[$v['KdWP']]['detail_skpd'][$i]['nilai_format'] = $pajak_format;
						$array[$v['KdWP']]['detail_skpd'][$i]['nilai_beneran'] = $pajak_beneran;
						$tot += $pajak_beneran;
					}
					$array[$v['KdWP']]['total_skpd_format'] = ( isset($tot) ? "Rp.".number_format($tot,0,",",".") : null );
					$array[$v['KdWP']]['total_skpd_beneran'] = ( isset($tot) ? $tot : null );
				}
				/*
				echo "<pre>";
				print_r($array);
				exit;
				//*/
				//return $array;
			break;
			case "rekon":
				$data=array();
				$sql="SELECT * FROM tbl_wajib_pungut_pertamina_wil ";
				$cp=$this->db->query($sql)->result_array();
				$data['jml_data']=count($cp);
				
				foreach($cp as $v){
					$data[$v['KdCP']]=array();
					$data[$v['KdCP']]['nama_cp']=$v['NmCP'];
					$data[$v['KdCP']]['bulan']=array();
					$tot=0;
					for($i=1;$i<=12;$i++){
						$bulan=$this->konversi_bulan($i);
						$sql_data="SELECT sum(A.Tax3)as pajak 
								   FROM tbl_pembayaran_pungutan_bank A
								   WHERE A.TaxBulan3=".$i." 
								   AND A.TaxThn3=".date('Y')." 
								   AND A.KdCP3=".$v['KdCP'];
						$data_real=$this->db->query($sql_data)->row('pajak');
						$data[$v['KdCP']]['bulan'][$i]=(isset($data_real) ? $data_real : 0);
						$tot=$data[$v['KdCP']]['bulan'][$i]+$tot;
						//$data[$i][$bulan]=100;
					}
					$data[$v['KdCP']]['total']=$tot;
					
				}
				
				/*for($i=1;$i<=12;$i++){
					$bulan=$this->konversi_bulan($i);
					$data[$i]=array();
					$data[$i][$bulan]=100;
				}*/
				//echo "<pre>";print_r($data);
				//print_r($data);exit;
			break;
			case "bb":
				$array = array();
				foreach($p2 as $k => $v){
					$array[$v['KdBB']]['id_bahanbakar'] = $v['KdBB'];
					$array[$v['KdBB']]['nama_bahanbakar'] = $v['NmBB'];
					$array[$v['KdBB']]['detail_bb'] = array();
					$tot_pajak = null;
					$tot_kuantitas = null;
					for($i=1;$i<=12;$i++){
						$sql_bb = "
							SELECT sum(Tax) as pajak, sum(QtyBB) as kuantitas
							FROM tbl_pungutan_pbbkb
							WHERE TaxBulan = '".$i."'
							AND KdBB = '".$v['KdBB']."' AND TaxThn = '".date('Y')."'
						";
						$query_bb = $this->db->query($sql_bb)->row_array();
						$pajak_beneran = ( isset($query_bb['pajak']) ? $query_bb['pajak'] : null );
						$pajak_format = ( isset($query_bb['pajak']) ? "Rp.".number_format($query_bb['pajak'],0,",",".") : null );
						
						$kuantitas_beneran = ( isset($query_bb['kuantitas']) ? $query_bb['kuantitas'] : null );
						$kuantitas_format = ( isset($query_bb['kuantitas']) ? number_format($query_bb['kuantitas'],0,",",".") : null );
						
						$array[$v['KdBB']]['detail_bb'][$i] = array();
						$array[$v['KdBB']]['detail_bb'][$i]['nilai_format_pajak'] = $pajak_format;
						$array[$v['KdBB']]['detail_bb'][$i]['nilai_beneran_pajak'] = $pajak_beneran;
						$array[$v['KdBB']]['detail_bb'][$i]['nilai_format_kuantitas'] = $kuantitas_format;
						$array[$v['KdBB']]['detail_bb'][$i]['nilai_beneran_kuantitas'] = $kuantitas_beneran;
						
						$tot_pajak += $pajak_beneran;
						$tot_kuantitas += $kuantitas_beneran;
					}
					$array[$v['KdBB']]['total_pajak_format'] = ( isset($tot_pajak) ? "Rp.".number_format($tot_pajak,0,",",".") : null );
					$array[$v['KdBB']]['total_pajak_beneran'] = ( isset($tot_pajak) ? $tot_pajak : null );
					$array[$v['KdBB']]['total_kuantitas_format'] = ( isset($tot_kuantitas) ? number_format($tot_kuantitas,0,",",".") : null );
					$array[$v['KdBB']]['total_kuantitas_beneran'] = ( isset($tot_kuantitas) ? $tot_kuantitas : null );
				}
				
				/*
				echo "<pre>";
				print_r($array);
				exit;
				//*/
				
			break;
			
		}
		if(isset($data)){
			return $data;
		}else{
			return $array;
		}
	}
	
	// END GOYZ CROTZZZ
	
}