<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lookbook extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('Model');
		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->session->set_userdata('search',$search);
			redirect('catalogue');
		}
		date_default_timezone_set('Asia/Jakarta');

		$data['checkout']=$this->db->get_where('checkout')->result_array();
		$data['order']=$this->db->get_where('orderan')->result_array();
		$waktuNow=date('Y-m-d H:i:s');

		foreach ($data['checkout'] as $ck) {
			if($waktuNow>=$ck['deadline'] && $ck['is_upload']==0){
				foreach($data['order']as$or){
					$idcheckout=$ck['id_checkout'];
					if ($idcheckout == $or['id_checkout']) {
						$item=$or['jumlah'];
						$idproduk=$or['id_produk'];
						$size=$or['size'];

						$selectStok="SELECT * FROM sizestok WHERE id_produk = $idproduk AND size = '$size'";
						$data['sizestok']=$this->db->query($selectStok)->row_array();

						$stok=$data['sizestok']['stok'];
						$kurangStok=$stok+$item;
						
						$this->db->set('stok',$kurangStok);
						$this->db->where('id_produk',$idproduk);
						$this->db->where('size',$size);
						$this->db->update('sizestok');
					}
				}
			    $this->Model->hapusPembelian($ck['id_checkout']);
			    $this->Model->hapusOrderan($ck['id_checkout']);
			}
		}
	}

	public function index(){
		$data['title']='Lookbook ';
		$data['active']='LOOKBOOK';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['header']=$this->db->get_where('header',['tempat'=>'Lookbook'])->row_array();
		$data['lookbook']=$this->db->get('lookbook')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('lookbook/index',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id){
		$data['title']='Lookbook ';
		$data['active']='LOOKBOOK';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
		$data['produk_lookbook']=$this->db->get_where('produk_lookbook',['id_lookbook'=>$id])->result_array();
		$data['jumlah_produk']=$this->Model->hitungProdukLookbook($id);
		$data['sizestok']=$this->db->get('sizestok')->result_array();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$this->load->view('templates/header',$data);
		$this->load->view('lookbook/detail',$data);
		$this->load->view('templates/footer');
	}
}