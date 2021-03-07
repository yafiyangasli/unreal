<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('pagination');
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

	public function tes($id){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/detail/tes',$data);
		$this->load->view('templates/footer');
	}

	public function index(){
		if($this->session->userdata('search')==NULL){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProduk();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/index';
		$config['total_rows']=$this->Model->hitungProduk();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->Model->getProduk($config['per_page'],$data['start']);

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/index',$data);
		$this->load->view('templates/footer');
	}else{
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProduk();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		if ($this->session->userdata('search')!=NULL) {
			$keyword=$this->session->userdata('search');
			$this->db->like('nama_produk',$keyword);
			$data['produk']=$this->db->get('produk')->result_array();
		}

		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/index',$data);
		$this->load->view('templates/footer');
		$this->session->unset_userdata('search');
	}
	}

	public function likedproduct(){
		
		if($this->session->userdata('username')==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please login first!</div>');
		}else{
			$product_id=$this->input->post('likedId');

			$data=[
				'username'=>$this->session->userdata('username'),
				'id_produk'=>$product_id
			];

			$result=$this->db->get_where('liked_items',$data);

			if($result->num_rows()<1){
				$this->db->insert('liked_items',$data);
			}else{
				$this->db->delete('liked_items',$data);
			}
			
		}
	}

	public function detailProduk($id){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['dproduk']=$this->db->get_where('produk',['id'=>$id])->row_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['sizestok']=$this->db->get_where('sizestok',['id_produk'=>$id])->result_array();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username'),'id_produk'=>$id])->row_array();
			}

		$this->load->view('catalogue/detail/index',$data);

	}

	public function gambar(){
		$this->load->view('catalogue/detail/gambar');
	}

	public function teslagi($id){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['dproduk']=$this->db->get_where('produk',['id'=>$id])->row_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['sizestok']=$this->db->get_where('sizestok',['id_produk'=>$id])->result_array();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username'),'id_produk'=>$id])->row_array();
			}
		
		$this->load->view('catalogue/detail/teslagi',$data);
	}

	public function get_stok($idproduk,$size){
		$stok=$this->db->get_where('sizestok',['id_produk'=>$idproduk,'size'=>$size])->result_array();
		echo json_encode($stok);
	}

	public function clothes(){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['id_jenis']='clothes';
		$data['jenis']='Clothes';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProdukMerk($data['jenis']);
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/clothes';
		$config['total_rows']=$this->Model->hitungProdukMerk($data['jenis']);
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->db->get_where('produk',['jenis'=>$data['jenis']],9,$data['start'])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/clothes',$data);
		$this->load->view('templates/footer');
	}

	public function pants(){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['id_jenis']='pants';
		$data['jenis']='Pants';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProdukMerk($data['jenis']);
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/pants';
		$config['total_rows']=$this->Model->hitungProdukMerk($data['jenis']);
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->db->get_where('produk',['jenis'=>$data['jenis']],9,$data['start'])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/pants',$data);
		$this->load->view('templates/footer');
	}

	public function floapers(){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['id_jenis']='floapers';
		$data['jenis']='Floapers';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProdukMerk($data['jenis']);
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/floapers';
		$config['total_rows']=$this->Model->hitungProdukMerk($data['jenis']);
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->db->get_where('produk',['jenis'=>$data['jenis']],9,$data['start'])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/floapers',$data);
		$this->load->view('templates/footer');
	}

	public function shoes(){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['id_jenis']='shoes';
		$data['jenis']='Shoes';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProdukMerk($data['jenis']);
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/shoes';
		$config['total_rows']=$this->Model->hitungProdukMerk($data['jenis']);
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->db->get_where('produk',['jenis'=>$data['jenis']],9,$data['start'])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/shoes',$data);
		$this->load->view('templates/footer');
	}

	public function filter(){

		$min=$this->session->userdata('min');
		$max=$this->session->userdata('max');

		$data['min']=$min;
		$data['max']=$max;

		$query = "SELECT * FROM produk WHERE harga BETWEEN $min AND $max";

		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->db->query($query)->num_rows();
		$data['sizestok']=$this->db->get('sizestok')->result_array();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/filter/index';
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$start=$this->uri->segment(4);
		if($start==NULL){
			$start=0;
		}
		$queryTampil= "SELECT * FROM produk WHERE harga BETWEEN $min AND $max ORDER BY harga ASC LIMIT $start, 9";
		$data['produk']=$this->db->query($queryTampil)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/filter/index',$data);
		$this->load->view('templates/footer');
	}

	public function filterBaru(){

		if($this->session->userdata('min') && $this->session->userdata('max')!=NULL){
			$this->session->unset_userdata('min');
			$this->session->unset_userdata('max');

			$min=$this->input->post('min');
			$max=$this->input->post('max');

			if($min==NULL&&$max==NULL){
				redirect('catalogue');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}

		}else{
			$min=$this->input->post('min');
			$max=$this->input->post('max');
			if($min==NULL&&$max==NULL){
				redirect('catalogue');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/filter');
			}
		}
	}

	public function clothes_filter(){

		$min=$this->session->userdata('min');
		$max=$this->session->userdata('max');

		$data['min']=$min;
		$data['max']=$max;

		$data['id_jenis']='clothes';
		$data['jenis']='Clothes';

		$query = "SELECT * FROM produk WHERE jenis='Clothes' && harga BETWEEN $min AND $max";

		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->db->query($query)->num_rows();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/clothes_filter/index';
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$start=$this->uri->segment(4);
		if($start==NULL){
			$start=0;
		}
		$queryTampil= "SELECT * FROM produk WHERE jenis='Clothes' && harga BETWEEN $min AND $max ORDER BY harga ASC LIMIT $start, 9";
		$data['produk']=$this->db->query($queryTampil)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/clothes_filter/index',$data);
		$this->load->view('templates/footer');
	}

	public function clothes_filterBaru(){

		if($this->session->userdata('min') && $this->session->userdata('max')!=NULL){
			$this->session->unset_userdata('min');
			$this->session->unset_userdata('max');

			$min=$this->input->post('min');
			$max=$this->input->post('max');

			if($min==NULL&&$max==NULL){
				redirect('catalogue/clothes');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}

		}else{
			$min=$this->input->post('min');
			$max=$this->input->post('max');
			if($min==NULL&&$max==NULL){
				redirect('catalogue/clothes');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/clothes_filter');
			}
		}
	}

	public function pants_filter(){

		$min=$this->session->userdata('min');
		$max=$this->session->userdata('max');

		$data['min']=$min;
		$data['max']=$max;

		$data['id_jenis']='pants';
		$data['jenis']='Pants';

		$query = "SELECT * FROM produk WHERE jenis='Pants' && harga BETWEEN $min AND $max";

		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->db->query($query)->num_rows();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/pants_filter/index';
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$start=$this->uri->segment(4);
		if($start==NULL){
			$start=0;
		}
		$queryTampil= "SELECT * FROM produk WHERE jenis='Pants' && harga BETWEEN $min AND $max ORDER BY harga ASC LIMIT $start, 9";
		$data['produk']=$this->db->query($queryTampil)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/pants_filter/index',$data);
		$this->load->view('templates/footer');
	}

	public function pants_filterBaru(){

		if($this->session->userdata('min') && $this->session->userdata('max')!=NULL){
			$this->session->unset_userdata('min');
			$this->session->unset_userdata('max');

			$min=$this->input->post('min');
			$max=$this->input->post('max');

			if($min==NULL&&$max==NULL){
				redirect('catalogue/pants');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}

		}else{
			$min=$this->input->post('min');
			$max=$this->input->post('max');
			if($min==NULL&&$max==NULL){
				redirect('catalogue/pants');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/pants_filter');
			}
		}
	}

	public function floapers_filter(){

		$min=$this->session->userdata('min');
		$max=$this->session->userdata('max');

		$data['min']=$min;
		$data['max']=$max;

		$data['id_jenis']='floapers';
		$data['jenis']='Floapers';

		$query = "SELECT * FROM produk WHERE jenis='Floapers' && harga BETWEEN $min AND $max";

		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->db->query($query)->num_rows();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/floapers_filter/index';
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$start=$this->uri->segment(4);
		if($start==NULL){
			$start=0;
		}
		$queryTampil= "SELECT * FROM produk WHERE jenis='Floapers' && harga BETWEEN $min AND $max ORDER BY harga ASC LIMIT $start, 9";
		$data['produk']=$this->db->query($queryTampil)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/floapers_filter/index',$data);
		$this->load->view('templates/footer');
	}

	public function floapers_filterBaru(){

		if($this->session->userdata('min') && $this->session->userdata('max')!=NULL){
			$this->session->unset_userdata('min');
			$this->session->unset_userdata('max');

			$min=$this->input->post('min');
			$max=$this->input->post('max');

			if($min==NULL&&$max==NULL){
				redirect('catalogue/floapers');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}

		}else{
			$min=$this->input->post('min');
			$max=$this->input->post('max');
			if($min==NULL&&$max==NULL){
				redirect('catalogue/floapers');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/floapers_filter');
			}
		}
	}

	public function shoes_filter(){

		$min=$this->session->userdata('min');
		$max=$this->session->userdata('max');

		$data['min']=$min;
		$data['max']=$max;

		$data['id_jenis']='shoes';
		$data['jenis']='Shoes';

		$query = "SELECT * FROM produk WHERE jenis='Shoes' && harga BETWEEN $min AND $max";

		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->db->query($query)->num_rows();
		if($this->session->userdata('username')!=NULL){
			$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		}

		$config['base_url']= 'http://localhost/unreal/catalogue/shoes_filter/index';
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=9;

		$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-secondary');

		$this->pagination->initialize($config);


		$start=$this->uri->segment(4);
		if($start==NULL){
			$start=0;
		}
		$queryTampil= "SELECT * FROM produk WHERE jenis='Shoes' && harga BETWEEN $min AND $max ORDER BY harga ASC LIMIT $start, 9";
		$data['produk']=$this->db->query($queryTampil)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/shoes_filter/index',$data);
		$this->load->view('templates/footer');
	}

	public function shoes_filterBaru(){

		if($this->session->userdata('min') && $this->session->userdata('max')!=NULL){
			$this->session->unset_userdata('min');
			$this->session->unset_userdata('max');

			$min=$this->input->post('min');
			$max=$this->input->post('max');

			if($min==NULL&&$max==NULL){
				redirect('catalogue/shoes');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}

		}else{
			$min=$this->input->post('min');
			$max=$this->input->post('max');
			if($min==NULL&&$max==NULL){
				redirect('catalogue/shoes');
			}elseif ($min==NULL&&$max!=NULL) {
				$data=[
				'min'=>1,
				'max'=>$max
			];
			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}elseif ($min!=NULL&&$max==NULL) {
				$data=[
				'min'=>$min,
				'max'=>450000
			];
			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}else{
				$data=[
				'min'=>$min,
				'max'=>$max
			];

			$this->session->set_userdata($data);
			redirect('catalogue/shoes_filter');
			}
		}
	}

	public function catalogueSearch(){
		$data['title']='Catalogue ';
		$data['active']='CATALOGUE';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['jenis_produk']=$this->db->get('jenis_produk')->result_array();
		$data['jumlah_produk']=$this->Model->hitungProduk();

		if ($this->session->userdata('search')!=NULL) {
			$keyword=$this->session->userdata('search');
			$this->db->like('nama_produk',$keyword);
			$data['produk']=$this->db->get('produk')->result_array();
		}

		if($this->input->post('search')){
			$data['produk']=$this->Model->cariDataBarang();
		}

		$this->load->view('templates/header',$data);
		$this->load->view('catalogue/index',$data);
		$this->load->view('templates/footer');
	}
}
