<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdmDevisi extends CI_Controller {
	function __construct(){
		parent::__construct();
		
	}

	function index(){
		$Devisi = $this->session->userdata('id'); //Id devisi
		$whereDev = array('Id_Devisi' => $Devisi);
		$DB = $this->DB_SIS->edit_data($whereDev,'db_pesanan')->result();
		foreach ($DB as $b) {
			$IDDev = $b->Id_Pesanan;
		}
		$where = array('Id_Devisi' => $Devisi);
		$data['pesanan']= $this->DB_SIS->edit_data($where,'db_detail')->num_rows();
		$data['pengiriman']=$this->DB_SIS->edit_data($where,'db_pesanan')->num_rows();
		$data['diterima']=$this->DB_SIS->edit_data($where,'db_terima')->num_rows();
		$data['hasil']=$this->DB_SIS->get_data('db_barang')->result();
		$data['Item']=$this->DB_SIS->get_data('db_terima')->result();
		$data['total']=$this->DB_SIS->Hitung();
		$this->load->view('PgDevisi/Header');
		$this->load->view('PgDevisi/Dashboard',$data);
		$this->load->view('PgDevisi/Footer');
	}

	function Terima(){ // data Terima
		$Devisi = $this->session->userdata('id'); //Id devisi
		$whereDev = array('Id_Devisi' => $Devisi);
		$DB = $this->DB_SIS->edit_data($whereDev,'db_pesanan')->result();
		foreach ($DB as $b) {
			$IDDev = $b->Id_Pesanan;
		}
		$where = array('Id_Devisi' => $Devisi);
		// $whereID = array('Id_Pesanan' => $IDDev); // ngabil data terima
		$data['devisi'] = $this->DB_SIS->edit_data($where,'db_pesanan')->result();
		$data['terima']=$this->DB_SIS->edit_data($where,'db_terima')->result();
		$data['DEV']=$this->DB_SIS->get_data('db_devisi')->result();
		$data['Kode'] = $this->DB_SIS->KodeTerima('8');
		$this->load->view('PgDevisi/Header');
		$this->load->view('PgDevisi/Terima',$data);
		$this->load->view('PgDevisi/Footer');
	}

	function AddTerima(){
		$ID = $this->input->post('ID'); //Id Barang
		$Item = $this->input->post('item'); // Item
		$Tgl = $this->input->post('date');
		$IdDev = $this->input->post('DEV');
		$TerimaId = $ID.$Tgl;

		$whereTtl = array('Id_Barang' => $ID);
		$D = $this->DB_SIS->edit_data($whereTtl,'db_barang')->result();
		foreach ($D as $bc) {
			$ItmBrg = $bc->Item;
		}
		
		$Total = $ItmBrg - $Item;
		$Hasil = array('Item' => $Total);

		$data = array(
			'ID' => $TerimaId,
			'Id_Barang' => $ID,
			'Item' => $Item,
			'Id_Devisi' => $IdDev,
			'Tanggal' => $Tgl
		);

		$this->DB_SIS->update_data('db_barang',$Hasil,$whereTtl);

		// $id = $this->input->post('Id');
		$where = array('Tanggal' => $Tgl);
		$this->DB_SIS->delete_data($where,'db_pesanan');

		$this->DB_SIS->insert_data($data,'db_terima');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'TerimaProduk');
	}

	function Pesanan(){ //Pesanan Barang
		
		$Devisi = $this->session->userdata('id');
		$where2 = array('Id_Devisi' => $Devisi);
		$DB = $this->DB_SIS->edit_data($where2,'db_adm')->result();
		foreach ($DB as $b) {
			$Id = $b->Id_Devisi;
		}

		$where = array('Id_Devisi' => $Id);
		$data['Pesanan']=$this->DB_SIS->edit_data($where,'db_detail')->result();
		$data['Barang']=$this->DB_SIS->get_data('db_barang')->result();
		$data['devisi']=$this->DB_SIS->get_data('db_devisi')->result();
		$this->load->view('PgDevisi/Header');
		$this->load->view('PgDevisi/Pesanan',$data);
		$this->load->view('PgDevisi/Footer');
	}

	// Menu Pesannan
	function PsnDevisi(){
		$Barang = $this->input->post('Brg'); //IDBarang
		$Id = $this->input->post('IdDev'); // IdDevisi
		$Item = $this->input->post('item'); // Item
		$Tgl = $this->input->post('date');

		$CekBrg = $this->DB_SIS->get_data('db_detail')->result();
		foreach ($CekBrg as $rw){
			$IdCek = $rw->Id_barang;
		}
		if ($IdCek==$Barang) {
			$this->session->set_flashdata('alert2','Berhasil');
			redirect(base_url().'PesananDevisi');
		}
		$data = array(
			'Id_Devisi' => $Id,
			'Id_barang' => $Barang,
			'Item' => $Item,
			'Tanggal' => $Tgl
		);
		$this->DB_SIS->insert_data($data,'db_detail');
		$this->session->set_flashdata('alert','Berhasil');
		redirect(base_url().'PesananDevisi');
	}

	function EditPesen(){
		$Barang = $this->input->post('ID'); //IDBarang
		$Id = $this->input->post('Devisi'); // IdDevisi
		$Item = $this->input->post('item'); // Item
		$Tgl = $this->input->post('date');

		$where = array('Id_Barang' => $Barang);
		$data = array(
			'Id_Devisi' => $Id,
			'Id_barang' => $Barang,
			'Item' => $Item,
			'Tanggal' => $Tgl
		);
		$this->DB_SIS->update_data('db_detail',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'PesananDevisi');
	}

	function HapusPesen(){
		$id = $this->input->post('Id');
		$where = array('Id_barang' => $id);
		$this->DB_SIS->delete_data($where,'db_detail');
		$this->session->set_flashdata('alert','Hapus');
		redirect('PesananDevisi');
	}

	// Kirim Ke Devisi
	function AddKirim(){ //Input Ke pesanan
		$ID = $this->input->post('idPsn'); //IdPesanan
		$Barang = $this->input->post('ID'); //IDBarang
		$Id = $this->input->post('Devisi'); // IdDevisi
		$Item = $this->input->post('item'); // Item
		$Tgl = $this->input->post('date');

		$where = array('Id_Pesanan' => $ID);
		$data = array(
			'Id_Devisi' => $Id,
			'Id_barang' => $Barang,
			'Item' => $Item,
			'Tanggal' => $Tgl
		);
		$this->DB_SIS->update_data('db_pesanan',$data,$where);
		$this->session->set_flashdata('alert','Update');
		redirect(base_url().'TerimaProduk');
	}

}