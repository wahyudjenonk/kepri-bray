<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->auth = unserialize(base64_decode($this->session->userdata('sipbbg-k3pr1')));
		$this->host	= $this->config->item('base_url');
		$host = $this->host;
		
		$this->smarty->assign('host',$this->host);
		$this->smarty->assign('auth', $this->auth);
		
		$this->load->model('mhome'); 
		$this->load->helper('db_helper');
	}

	
	public function index(){
		if($this->auth){
			$this->smarty->display('index.html');
		}else{
			$this->smarty->display('login.html');
		}
	}
	
	//fungsi Login
	function login(){
		$this->load->library('encrypt');
		
		$user = $this->db->escape_str($this->input->post('userid'));
		$pass = $this->db->escape_str($this->input->post('pass'));
		//$pass = $this->input->post('pass');
		
		//echo $user.' -> '.$pass;exit;
		//echo $this->encrypt->encode($pass);
		//exit;
				
		$data = $this->mhome->getdata("data_login", trim($user)); 
		//echo $this->encrypt->decode($data["Password"]);exit;
		// bypass password di bawah ini
		if($data){// && $pass == $this->encrypt->decode($data["Password"])){
			$this->session->set_userdata('sipbbg-k3pr1', base64_encode(serialize($data)));	
			header("Location: " . $this->host);
		}else{
			header("Location: " . $this->host);
		}
	}
	
	function logout(){
		$this->session->unset_userdata('sipbbg-k3pr1', 'limit');
		$this->session->sess_destroy();
		header("Location: " . $this->host);
	}
	//End Fungsi Login
	
	//fungsi front_end
	function getdata($type){
		echo $this->mhome->getdata($type);
	}
	
	function getdisplay($type="", $p1="", $p2=""){
		switch($p2){
			case "main":
				$template = $type."/".$p1."/main.html";
				switch($p1){
					case "realisasi":
					case "apbd":
					case "apbdp":
						$data  = $this->mhome->get_dashboard_data($p1);
						
						/*
						echo "<pre>";
						print_r($data);
						//exit;*/
						
						if($p1 == 'realisasi'){
							$bulan = arraydate('bulan_singkat');
							$this->smarty->assign('bulan', $bulan);
						}else{
							$tanda = $this->input->post('tanda');
							if(!$tanda){
								$this->smarty->assign('bulan', $this->get_combo('bulan','','return') );
								$this->smarty->assign('tahun', $this->get_combo('tahun','','return') );
								$this->smarty->assign('tahun_s', date('Y') );
							}else{
								$this->smarty->assign('tahun_s', $this->input->post('tahun') );
							}
							
							$this->smarty->assign('tanda', $tanda);
						}
						
						$this->smarty->assign('data', $data);
					break;
					case "chart_line":
						$data=$this->mhome->get_dashboard_data($p1);
						echo json_encode($data);
						exit;
					break;
					case "skpd":
						$data_perusahaan = $this->mhome->getdata('wajib_pajak');
						$bulan_na=array();
						for($i=1;$i<=12;$i++){
							$bulan=$this->mhome->konversi_bulan($i);
							$bulan_na[$i]=$bulan;
						}	
						$data = $this->mhome->report_data($p1, $data_perusahaan);
						
						$this->smarty->assign('bulan', $bulan_na);
						$this->smarty->assign("jml_perusahaan", count($data_perusahaan));
						$this->smarty->assign("data_perusahaan", $data_perusahaan);
						$this->smarty->assign("data", $data);
					break;
					case "rekon":
						$data=$this->mhome->report_data($p1);
						$bulan_na=array();
						for($i=1;$i<=12;$i++){
							$bulan=$this->mhome->konversi_bulan($i);
							$bulan_na[$i]=$bulan;
						}	
						$this->smarty->assign('data', $data);
						$this->smarty->assign('bulan', $bulan_na);
					break;
					case "dkwn":
						$data_perusahaan = $this->mhome->getdata('wajib_pajak');
						$data_kabupaten = $this->mhome->getdata('kabupaten_report');
						
						$this->smarty->assign("jml_kabupaten", count($data_kabupaten));
						$this->smarty->assign("data_kabupaten", $data_kabupaten);
						$this->smarty->assign("data_perusahaan", $data_perusahaan);
					break;
					case "pertamina":
						$data_kabupaten = $this->mhome->getdata('kabupaten_report');
						$this->smarty->assign("data_kabupaten", $data_kabupaten);
					break;
					case "bb":
						$bulan_na=array();
						for($i=1;$i<=12;$i++){
							$bulan_sekarang = $this->mhome->konversi_bulan($i);
							if($i == 1){
								$bulan_kemarin = $this->mhome->konversi_bulan(12);
							}else{
								$bulan_kemarin = $this->mhome->konversi_bulan($i-1);
							}
							$bulan_na[$i] = array();
							$bulan_na[$i]['bulan_sekarang'] = $bulan_sekarang;
							$bulan_na[$i]['bulan_kemarin'] = $bulan_kemarin;
						}
						$data_jenis_bahanbakar = $this->mhome->getdata('jenis_bb_report');
						$data = $this->mhome->report_data($p1, $data_jenis_bahanbakar);
						
						$this->smarty->assign("data_jenis_bahanbakar", $data_jenis_bahanbakar);
						$this->smarty->assign("data", $data);
						$this->smarty->assign('bulan', $bulan_na);
					break;
					case 'bb_kabkota':
						$data_perusahaan = $this->mhome->getdata('wajib_pajak');
						$data_kabupaten = $this->mhome->getdata('kabupaten_report');
						$data_jenis_bahanbakar = $this->mhome->getdata('jenis_bb_report');
						
						$this->smarty->assign("data_kabupaten", $data_kabupaten);
						$this->smarty->assign("data_perusahaan", $data_perusahaan);
						$this->smarty->assign("data_jenis_bahanbakar", $data_jenis_bahanbakar);
						$this->smarty->assign("jml_jns_bahanbakar", count($data_jenis_bahanbakar));
					break;
				}
			break;
			case "form":
				$editstatus = $this->input->post('editstatus');
				if($editstatus=='edit'){
					$data_edit=$this->mhome->getdata($p1,'edit');
					//print_r($data_edit);
					$this->smarty->assign('data_edit', $data_edit);
				}
				$this->smarty->assign('editstatus', $editstatus);
				$template = $type."/".$p1."/form.html";
				
				if($p1 == 'kabupaten'){
					$combo = $this->get_combo('cl_provinsi', ($editstatus == 'add' ? '' : $data_edit->KdProv), 'return' );
					$this->smarty->assign('combo_provinsi', $combo);
				}
				if($p1 == 'klasifikasi_pbbkb_pertamina'){
					$combo = $this->get_combo('cl_jenis_bahan_bakar', ($editstatus == 'add' ? '' : $data_edit->KdBB), 'return' );
					$this->smarty->assign('combo_bahanbakar', $combo);
				}
				if($p1 == 'profil_wajib_pungut' || $p1 == 'profil_wajib_pajak' || $p1 == 'bank' || $p1 == 'owner'){
					$combo = $this->get_combo('cl_kabupaten_kota', ($editstatus == 'add' ? '' : $data_edit->KdKabKot), 'return' );
					if($p1 == 'profil_wajib_pajak'){
						$combo2 = $this->get_combo('cl_jenis_perusahaan', ($editstatus == 'add' ? '' : $data_edit->KdJenCP), 'return' );
						$combo3 = $this->get_combo('cl_klasifikasi_pbbkb', ($editstatus == 'add' ? '' : $data_edit->KdKlasifikas), 'return' );
						
						$this->smarty->assign('combo_jenper', $combo2);
						$this->smarty->assign('combo_klas', $combo3);
					}
					if($p1 == 'owner'){
						$combo2 = $this->get_combo('cl_tingkat_daerah_pengguna', ($editstatus == 'add' ? '' : $data_edit->KdTk), 'return' );
						$this->smarty->assign('combo_tdpengguna', $combo2);
					}
					
					$this->smarty->assign('combo_kab', $combo);
				}
				if($p1 == 'target_pajak'){
					$combo = $this->get_combo('cl_tahun_pajak', ($editstatus == 'add' ? '' : $data_edit->ThnPajak), 'return' );
					$this->smarty->assign('combo_tahun', $combo);
				}
				if($p1 == 'user_manajemen'){
					$combo = $this->get_combo('cl_level_user', ($editstatus == 'add' ? '' : $data_edit->KdLevel), 'return' );
					$combo2 = $this->get_combo('cl_jabatan_user', ($editstatus == 'add' ? '' : $data_edit->KdJabatan), 'return' );
					
					$this->smarty->assign('combo_level', $combo);
					$this->smarty->assign('combo_jabatan', $combo2);
					
					if($editstatus == 'edit'){
						$this->load->library('encrypt');
						$password = $this->encrypt->decode($data_edit->Password);
						$this->smarty->assign('password', $password);
					}
				}
				
			break;
		}
				
		$this->smarty->assign('type', $type);
		$this->smarty->assign('modul', $p1);
		$this->smarty->display($template);
	}
	// GOYZ CROTZ
	function crud_na($table,$sts_crud){
		$data=array();
		foreach($_POST as $k=>$v) $data[$k] = $this->input->post($k);//$this->db->escape_str($this->input->post($k));
		//print_r($_POST);exit;
		echo $this->mhome->crud_na($table,$data,$sts_crud);
	}
	
	function get_combo($p1="", $p2="", $p3=""){
		$opt="<option value=''>-- Pilih --</option>";
		
		switch($p1){
			case "bulan" :
				$data = arraydate('bulan');
			break;
			case "tahun" :
				$data = arraydate('tahun');
			break;
			default:
				$data = $this->mhome->get_combo($p1);
			break;
		}
		
		$id=$this->input->post('v');
		foreach($data as $v){
			$sts="";
			if($id){
				if($id==$v['id']){
					$sts ="selected";
				}
			}else{
				if($p2==$v['id']){
					$sts ="selected";
				}
			}
			
			$opt .="<option value='".$v['id']."' ".$sts.">".$v['txt']."</option>";
		}
		
		if($p3 == 'return'){
			return $opt;
		}else{
			echo $opt;
		}
		
	}
	function get_autocomplete($p1){
		$data=$this->mhome->get_combo($p1);
		//print_r($data);
		foreach($data as $row)
		{
			$arr['query'] = $p1;
			switch($p1){
				case "tbl_wajib_pajak_pertamina_daerah":
					$arr['suggestions'][] = array(
						'value'	=>$row["txt"],
						'data'	=>$row["id"],
						'data2'=>$row["NmKlas"],
						'data3'=>$row["Persentasi"],
						'data4'=>$row["KdKlasifikas"]
					);
				break;
				case "cl_klasifikasi_pbbkb_pertamina":
					$arr['suggestions'][] = array(
						'value'	=>$row["txt"],
						'data'	=>$row["id"],
						'data2'	=>$row["Persentasi"]
						//'data3'	=>$row["Persentasi"],
					);
				break;
				default: $arr['suggestions'][] = array('value'=>$row["txt"],'data'=>$row["id"]);
				
			}
		}
		echo json_encode($arr);
		
	}
	//END GOYZ CROTZ
	
	function tester(){
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
		//print_r($array);
		//('".join("','",$arraypelanggan)."')
		//echo join("','",$array);
	}
	
	
	//end fungsi front_end
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */