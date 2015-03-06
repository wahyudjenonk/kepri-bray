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
				$template = $type."/".$p1."/form.html";
				//echo "kontel Tenyom";exit;
			break;
		}
		$this->smarty->assign('type', $type);
		$this->smarty->assign('modul', $p1);
		$this->smarty->display($template);
	}
	//end fungsi front_end
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */