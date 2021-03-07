<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

	public function __construct(){
		parent::__construct();
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
		$data['title']='Help ';
		$data['active']='HELP';
		$data['nav']=$this->db->get('navbar')->result_array();

		$this->form_validation->set_rules('nama', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Category', 'required');
		$this->form_validation->set_rules('pesan', 'Message', 'required');


		if($this->form_validation->run()==false){
			$this->load->view('templates/header',$data);
			$this->load->view('help/index',$data);
			$this->load->view('templates/footer');
			$this->session->unset_userdata('message');
		}else{
			$waktuNow=date('Y-m-d H:i:s');
			$data=[
				'nama'=>$this->input->post('nama'),
				'email'=>$this->input->post('email'),
				'subject'=>$this->input->post('subject'),
				'kategori'=>$this->input->post('kategori'),
				'pesan'=>$this->input->post('pesan'),
				'waktu'=>$waktuNow
			];

			$this->db->insert('help',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your message has been sent!</div>');
			redirect('help');
		}
	}

}