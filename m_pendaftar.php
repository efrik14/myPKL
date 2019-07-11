<?php

class m_pendaftar extends CI_Model{
	public function getallpendaftar()
	{
		return $this->db->get('pengaju')->result_array();
		
	}

	public function getpendaftarById($id){
		
		$this->db->select('*');
		$this->db->from('pengaju');
		$this->db->join('peserta', 'pengaju.id_pengaju = peserta.id_pengaju');
		$this->db->join('kategori', 'pengaju.id_kategori = kategori.id_kategori');
		$this->db->join('unit_usaha', 'pengaju.id_unit = unit_usaha.id_unit');
		$this->db->join('master_divisi', 'unit_usaha.id_unit = master_divisi.id_unit');
		$this->db->where('pengaju.id_pengaju', $id); 
		return $this->db->get()->result_array();
	}

	public function getpesertaById($id){
		$this->db->select('*');
		$this->db->from('peserta');
		$this->db->where('id_pengaju' , $id);
		return $this->db->get()->result_array();
	}

	public function status_terima($id){
		$this->db->set('status' , '1');
		$this->db->where('id_pengaju' , $id);
		$this->db->update('pengaju');
	}

	public function status_tolak($id){
		$this->db->set('status' , '2');
		$this->db->where('id_pengaju' , $id);
		$this->db->update('pengaju');
	}



}
