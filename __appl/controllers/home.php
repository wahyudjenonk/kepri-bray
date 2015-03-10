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
			break;
			case "form":
				$editstatus = $this->input->post('editstatus');
				if($editstatus=='edit'){
					$data_edit=$this->mhome->getdata($p1,'edit');
					$this->smarty->assign('data_edit', $data_edit);
				}
				$this->smarty->assign('editstatus', $editstatus);
				$template = $type."/".$p1."/form.html";
				//echo "kontel Tenyom";exit;
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
	
	function get_combo($p1=""){
		$opt="<option value=''>-- Pilih --</option>";
		$data=$this->mhome->get_combo($p1);
		$id=$this->input->post('v');
		foreach($data as $v){
			$sts="";
			if($id){
				if($id==$v['id']){
					$sts ="selected";
				}
			}
			
			$opt .="<option value='".$v['id']."' ".$sts.">".$v['txt']."</option>";
		}
		echo $opt;
		
	}
	function get_autocomplete($p1){
		$data=$this->mhome->get_combo($p1);
		foreach($data as $row)
		{
			$arr['query'] = $p1;
			$arr['suggestions'][] = array(
				'value'	=>$row["txt"],
				'data'	=>$row["id"]
			);
		}
		echo json_encode($arr);
		
	}
	//END GOYZ CROTZ
	
	
	//end fungsi front_end
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */