<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		
	}

	// Dashboard Admin
	function index(){
		$data['hasil']=$this->DB_SIS->get_data('db_barang')->result();
		$data['Item']=$this->DB_SIS->get_data('db_terima')->result();
		$data['total']=$this->DB_SIS->Hitung();
		$this->load->view('Header');
		$this->load->view('Dashboard',$data);
		$this->load->view('Footer');
	}

	// Db Barang
	function Produk(){
		$data['ID'] = $this->DB_SIS->KodeBrg('5');
		$data['hasil']=$this->DB_SIS->get_data('db_barang')->result();
		$this->load->view('Header');
		$this->load->view('PgAdmin/Produk',$data);
		$this->load->view('Footer');
	}

	function AddBarang(){
		$ID = $this->input->post('ID');
		$Nama = $this->input->post('Barang');
		$Item = $this->input->post('Item');
		$Tgl = $this->input->post('date');
		$Status = "N";

		$data = array(
			'Id_Barang' => $ID,
			'Barang' => $Nama,
			'Item' => $Item,
			'Tanggal' => $Tgl,
			'Status' => $Status
		);
		$this->DB_SIS->insert_data($data,'db_barang');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'Produk');
	}

	function EditBrg(){
		$ID = $this->input->post('ID');
		$Nama = $this->input->post('Barang');
		$Item = $this->input->post('Item');
		$Tgl = $this->input->post('Tgl');
		$Status = "N";

		$where = array('Id_Barang' => $ID);
		$data = array(
			'Id_Barang' => $ID,
			'Barang' => $Nama,
			'Item' => $Item,
			'Tanggal' => $Tgl,
			'Status' => $Status
		);
		$this->DB_SIS->update_data('db_barang',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'Produk');
	}

	function HapusBrg(){
		$id = $this->input->post('Id');
		$where = array('Id_Barang' => $id);
		$this->DB_SIS->delete_data($where,'db_barang');
		$this->session->set_flashdata('alert','Hapus');
		redirect('Produk');
	}
	// End Db Barang

	// Data Pesanan
	function Pesanan(){
		$data['ID'] = $this->DB_SIS->IdPesanan('7');
		$data['Pesanan']=$this->DB_SIS->get_data('db_pesanan')->result();//Data Pesanan 
		$data['Detail']=$this->DB_SIS->get_data('db_detail')->result();//Data Pesanan Devisi
		$data['devisi']=$this->DB_SIS->get_data('db_devisi')->result();//Data Devisi
		$this->load->view('Header');
		$this->load->view('PgAdmin/Pesanan',$data);
		$this->load->view('Footer');
	}

	function AddPesen(){
		$ID = $this->input->post('ID');
		$IDBrg = $this->input->post('Brg');
		$Nama = $this->input->post('Devisi');
		$ItemPsn = $this->input->post('item');
		$Tgl = $this->input->post('date');
		$Ket = $this->input->post('Keterangan');

		$where = array('Tanggal' => $Tgl);
		$DB = $this->DB_SIS->edit_data($where,'db_pesanan');
		$cek = $DB->num_rows();
		if ($cek == 1) {
			$this->session->set_flashdata('alert','Gagal');
			redirect(base_url().'Pesanan');
		}

		$data = array(
			'Id_Pesanan' => $ID,
			'Id_Barang' => $IDBrg,
			'Id_Devisi' => $Nama,
			'Item' => $ItemPsn,
			'Tanggal' => $Tgl,
			'Keterangan' => $Ket
		);

		$this->DB_SIS->insert_data($data,'db_pesanan');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'Pesanan');
	}

	function EditPesen(){
		$ID = $this->input->post('ID');
		$Nama = $this->input->post('Devisi');
		$Item = $this->input->post('item');
		$Tgl = $this->input->post('date');
		$Ket = $this->input->post('Keterangan');

		$where = array('Id_Pesanan' => $ID);
		$data = array(
			'Id_Pesanan' => $ID,
			'Id_Devisi' => $Nama,
			'Item' => $Item,
			'Tanggal' => $Tgl,
			'Keterangan' => $Ket
		);
		$this->DB_SIS->update_data('db_pesanan',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'Pesanan');
	}

	function HapusPesen(){
		$id = $this->input->post('Id');
		$where = array('Id_Pesanan' => $id);
		$this->DB_SIS->delete_data($where,'db_pesanan');
		$this->session->set_flashdata('alert','Hapus');
		redirect('Pesanan');
	}

	function KirimDev(){
		$ID = $this->input->post('IdPesan'); //Id Pesanan
		$IDBrg = $this->input->post('Brg');
		$Nama = $this->input->post('Devisi');
		$ItemPsn = $this->input->post('item');
		$Tgl = $this->input->post('date');
		$Ket = $this->input->post('Keterangan');

		$where = array('Id_Pesanan' => $ID);
		$DB = $this->DB_SIS->edit_data($where,'db_pesanan');
		$cek = $DB->num_rows();
		if ($cek == 1) {
			$this->session->set_flashdata('alert','Gagal');
			redirect(base_url().'Pesanan');
		}

		$data = array(
			'Id_Pesanan' => $ID,
			'Id_Barang' => $IDBrg,
			'Id_Devisi' => $Nama,
			'Item' => $ItemPsn,
			'Tanggal' => $Tgl,
			'Keterangan' => $Ket
		);

		$this->DB_SIS->insert_data($data,'db_pesanan');

		$where = array('Tanggal' => $Tgl);
		$this->DB_SIS->delete_data($where,'db_detail');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'Pesanan');
	}
	//end pesanan
	//DB Devisi
	function Devisi(){
		$data['IDdev']=$this->DB_SIS->get_Iddv('6');
		$data['Devisi']=$this->DB_SIS->get_data('db_devisi')->result();
		$this->load->view('Header');
		$this->load->view('PgAdmin/Devisi',$data);
		$this->load->view('Footer');
	}

	function AddDevisi(){
		$ID = $this->input->post('ID');
		$Devisi = $this->input->post('Dev');

		$data = array(
			'Id_Devisi' => $ID,
			'NamaDevisi' => $Devisi
		);
		$this->DB_SIS->insert_data($data,'db_devisi');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'Devisi');
	}

	function EditDevisi(){
		$ID = $this->input->post('ID');
		$Devisi = $this->input->post('Devisi');

		$where = array('Id_Devisi' => $ID);
		$data = array(
			'Id_Devisi' => $ID,
			'NamaDevisi' => $Devisi
		);
		$this->DB_SIS->update_data('db_devisi',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'Devisi');
	}

	function HapusDevisi(){
		$id = $this->input->post('Id');
		$where = array('Id_Devisi' => $id);
		$this->DB_SIS->delete_data($where,'db_devisi');
		$this->session->set_flashdata('alert','Hapus');
		redirect('Devisi');
	}
	//End Devisi
	//Db Pengguna
	function Pengguna(){
		$data['ID'] = $this->DB_SIS->IdUser('6');
		$data['User']=$this->DB_SIS->get_data('db_adm')->result();
		$data['Dev']=$this->DB_SIS->get_data('db_devisi')->result();
		$this->load->view('Header');
		$this->load->view('PgAdmin/User',$data);
		$this->load->view('Footer');
	}

	function AddPengguna(){
		$ID = $this->input->post('ID');
		$User = $this->input->post('Pengguna');
		$Email = $this->input->post('Email');
		$Devisi = $this->input->post('Dev');
		$Password = $this->DB_SIS->AddPassword('8');
		if ($Devisi == 'Y') {
			$Status = 'Y';
		}else{
			$Status = 'N';
		}

		$data = array(
			'Id_Adm' => $ID,
			'Nama' => $User,
			'Email' => $Email,
			'Id_Devisi' => $Devisi,
			'Password' => $Password,
			'Status' => $Status
		);
		$this->DB_SIS->insert_data($data,'db_adm');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'Pengguna');
	}

	function EditUser(){
		$ID = $this->input->post('ID');
		$User = $this->input->post('Pengguna');
		$Email = $this->input->post('Email');
		$Devisi = $this->input->post('Dev');

		$where = array('Id_Adm' => $ID);
		$data = array(
			'Nama' => $User,
			'Email' => $Email,
			'Id_Devisi' => $Devisi
		);
		$this->DB_SIS->update_data('db_adm',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'Pengguna');
	}

	function EditPengguna(){
		$ID = $this->input->post('Id');
		$Password = $this->input->post('Password');
		$where = array('Id_Adm' => $ID);
		$data = array(
			'Password' => $Password
		);
		$this->DB_SIS->update_data('db_adm',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'Pengguna');
	}

	function HapusUser(){
		$id = $this->input->post('Id');
		$where = array('Id_Adm' => $id);
		$this->DB_SIS->delete_data($where,'db_adm');
		$this->session->set_flashdata('alert','Hapus');
		redirect('Pengguna');
	}

}