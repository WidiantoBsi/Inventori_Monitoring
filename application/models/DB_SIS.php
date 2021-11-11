<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

class DB_SIS extends CI_Model{

	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	function get_data($table){
		return $this->db->get($table);
	}

	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($table,$data,$where){
		$this->db->update($table,$data,$where);
	}

	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function deleteAll($table){
		$this->db->where_in('Id_Soal', $table);
		$this->db->delete('tbl_jawaban');
		$this->db->delete('banksoal');
	}

	function kosongkan_data($table){
		return $this->db->truncate($table);
	}

	function KodeBrg($length){
		$str        = date('ymd');//Y-m-d
		$characters = '0123456789';
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function IdPesanan($length){
		$str        = "";//Y-m-d
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function get_Iddv($length){
		$str        = date("Ymd");//Y-m-d
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function IdUser($length){
		$str        = date("Ymd");//Y-m-d
		$characters = '0123456789';
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function AddPassword($length){
		$str        = date("Ymd");//Y-m-d
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function KodeTerima($length){
		$str        = '';//Y-m-d
		$characters = date("Ymd");
		$max        = strlen($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function Hitung(){
		$this->db->select_sum('Item');
		$query = $this->db->get('db_terima');
		return $query->row()->Item;
	}

}