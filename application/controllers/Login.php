<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		
	}

	function index(){
		$this->load->view('LogIn');
	}

	function LogOut(){
		$session = array('id','username', 'email');
		$this->session->sess_destroy($session);
	    $this->load->view('LogIn');
	}

	function CekLogin(){
		$Id = $this->input->post('Id');
		$Password = $this->input->post('password');
		// $Password =  password_verify();
		$where = array('Password' => $Password, 'Id_Adm' => $Id);
		$db = $this->DB_SIS->edit_data($where,'db_adm')->result();
		$data = $this->DB_SIS->edit_data($where,'db_adm');
		$cek = $data->num_rows();
		if ($cek > 0) {
			foreach ($db as $row) {
				$Status = $row->Status;
				$Nama = $row->Nama;
				$Email = $row->Email;
				$ID = $row->Id_Devisi;
			}
			if ($Status == 'Y') { // Jika ID dan Password Benar
				$session = array('id' => $ID,'username' => $Nama, 'email' => $Email);
				$this->session->set_userdata($session);
				redirect(base_url().'Admin');
			}else{ // Jika Password salah
				$session = array('id' => $ID,'username' => $Nama, 'email' => $Email);
				$this->session->set_userdata($session);
				redirect(base_url().'Dashboard_Devisi');
			}	
		}else{ // Jika data tidak ada
			redirect(base_url().'Login');
		}
	}

}