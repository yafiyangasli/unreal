<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
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
		$data['produk']=$this->db->get_where('produk',['is_new'=>1])->result_array();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		foreach ($data['produk'] as $produk) {
			$id_produk=$produk['id'];
			$stokkosong=0;
			$stokakhir=0;
			foreach ($data['sizestok'] as $ss) {
				if($ss['id_produk'] == $produk['id']){
					$stokawal = $ss['stok'];
					$stokakhir = $stokakhir + $stokawal;
				}
			}
			if($stokakhir == 0){
				$this->Model->deleteFromNewProduct($id_produk);
			}
		}
	}

	public function index(){
		$data['title']='';
		$data['active']='NEW PRODUCT';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get_where('produk',['is_new'=>1])->result_array();
		$data['header']=$this->db->get_where('header',['tempat'=>'Home'])->row_array();
		

		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->session->set_userdata('search',$search);
			redirect('catalogue');
		}

		$this->load->view('templates/header',$data);
		$this->load->view('home/index',$data);
		$this->load->view('templates/footer');
	}

	public function tes(){
		$data['title']='';
		$data['active']='NEW PRODUCT';
		$data['nav']=$this->db->get('navbar')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('home/tes',$data);
		$this->load->view('templates/footer');
	}

	public function newsletter(){
		$newsletter=$this->input->post('newsletter');

		$data['newsletter']=$this->db->get_where('newsletter',['email'=>$newsletter])->row_array();

		$this->db->where('email',$newsletter);
		$this->db->delete('newsletter');

		$data=['email'=>$newsletter];

		$this->db->insert('newsletter',$data);
		$this->session->set_userdata('newsletter',$data);
		redirect('home');
	}

	public function maintenance(){
		$data['title']='';

		$this->load->view('home/maintenance',$data);
	}
}