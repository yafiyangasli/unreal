<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_model{

public function hitungProduk(){
		return $this->db->get('produk')->num_rows();
	}

public function hitungProdukLookbook($id){
		return $this->db->get_where('produk_lookbook',['id_lookbook'=>$id])->num_rows();
	}

public function getProduk($limit,$start){
		return $this->db->get('produk',$limit,$start)->result_array();
	}

public function hitungProdukMerk($jenis){
		return $this->db->get_where('produk',['jenis'=>$jenis])->num_rows();
	}

public function hapusProduk($id){
	$this->db->where('id',$id);
	$this->db->delete('produk');
	}

	public function hapusProdukSize($id){
	$this->db->where('id_produk',$id);
	$this->db->delete('sizestok');
	}

public function hapus_lookbook($id){
	$this->db->where('id_lookbook',$id);
	$this->db->delete('lookbook');
	}

public function hapus_produk_lookbook($id){
	$this->db->where('id_lookbook',$id);
	$this->db->delete('produk_lookbook');
	}

public function getDataProdukById($id){
		return $this->db->get_where('produk',['id'=>$id])->row_array();
	}

public function addToNewProduct($id){
		$this->db->set('is_new', 1);
		$this->db->where('id', $id);
		$this->db->update('produk');
	}

public function deleteFromNewProduct($id){
		$this->db->set('is_new', 0);
		$this->db->where('id', $id);
		$this->db->update('produk');
	}

public function hapusPembelian($id){
		$this->db->where('id_checkout',$id);
		$this->db->delete('checkout');
	}

public function hapusOrderan($id){
	$this->db->where('id_checkout',$id);
	$this->db->delete('orderan');
}
public function getDataTrans($id){
	return $this->db->get_where('bukti',['id_bukti'=>$id])->row_array();
}

public function cariDataBarang(){
	$keyword=$this->session->userdata('search');
	$this->db->like('nama_produk',$keyword);
	return $this->db->get('produk')->result_array();
}


}