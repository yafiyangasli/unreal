<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('Model');
		date_default_timezone_set('Asia/Jakarta');
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
		date_default_timezone_set('Asia/Jakarta');

		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}

		$data['title']='Profile ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer');
		
	}

	public function edit(){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}

		$data['title']='Edit Profile ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'trim');
		if($data['user']['username']!=$this->input->post('username')){
			$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',[
			'is_unique' => 'This username has already registered!']);
		}
		if($data['user']['email']!=$this->input->post('email')){
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'This email has already registered!']
		);}
		if($data['user']['telephone']!=$this->input->post('phone')){
			$this->form_validation->set_rules('phone', 'Contact Number', 'required|trim|numeric|min_length[6]',['min_length'=>'Please enter the correct number phone']);
		}

		if($this->form_validation->run()==false){
			$this->load->view('templates/header',$data);
			$this->load->view('user/edit',$data);
			$this->load->view('templates/footer');
		}else{
			$data=[
				'name'=>$this->input->post('name'),
				'username'=>htmlspecialchars($this->input->post('username',true)),
				'email'=>htmlspecialchars($this->input->post('email',true)),
				'telephone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address')
			];

			$this->db->where('username',$this->session->userdata('username'));
			$this->db->update('user',$data);
			$this->session->set_flashdata('message','<div class="alert alert-light" role="alert">Your address has been updated!</div>');
			$this->session->unset_userdata('username');
			$this->session->set_userdata('username',$this->input->post('username'));
			redirect('user');
		}
	}

	public function favorites(){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}
		$data['title']='My Favorites ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='Saved Items';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['liked']=$this->db->get_where('liked_items',['username'=>$this->session->userdata('username')])->result_array();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('user/favorites',$data);
		$this->load->view('templates/footer');
	}

	public function get_stok($idproduk,$size){
		$stok=$this->db->get_where('sizestok',['id_produk'=>$idproduk,'size'=>$size])->result_array();
		echo json_encode($stok);
	}
	public function get_stok2($idproduk,$size){
		$stok=$this->db->get_where('sizestok',['id_produk'=>$idproduk,'size'=>$size])->result_array();
		echo json_encode($stok);
	}

	public function addfav($id){
		if($this->session->userdata('username')==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please login first!</div>');
			redirect('auth');
		}else{

			$data=[
				'username'=>$this->session->userdata('username'),
				'id_produk'=>$id
			];

			$result=$this->db->get_where('liked_items',$data);

			if($result->num_rows()<1){
				$this->db->insert('liked_items',$data);
			}else{
				$this->db->delete('liked_items',$data);
			}
			redirect('catalogue/detailProduk/'.$id);	
		}
	}

	public function deletefav($id){
		$this->db->where('id_produk',$id);
		$this->db->delete('liked_items');
		redirect('user/favorites');
	}

	public function addToCart($id){
		if($this->session->userdata('username')==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}else{
			$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

			$username=$this->session->userdata('username');
			$id_produk=$id;
			$jumlah=$this->input->post('jumlah');
			$size=$this->input->post('size');
			$harga=$data['produk']['harga'];
			$berat=$data['produk']['berat'];

			if ($jumlah == 0 && $size == NULL) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, input size and quantity!</div>');
				redirect('catalogue/detailProduk/'.$id);
			} elseif ($jumlah == 0) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">The size is currently empty.</div>');
				redirect('catalogue/detailProduk/'.$id);
			}

			$data['cartuser']=$this->db->get_where('cart',[
				'username'=>$username,
				'id_produk'=>$id_produk,
				'size'=>$size
			])->row_array();

			$produk=$this->db->get_where('produk',['id'=>$id_produk])->row_array();

			if($id_produk==$data['cartuser']['id_produk'] && $size==$data['cartuser']['size']){
				$jumlahBaru= $data['cartuser']['jumlah'] + $jumlah;

				$dataBaru=[
					'jumlah'=>$jumlahBaru
				];

				$this->db->where('id_cart',$data['cartuser']['id_cart']);
				$this->db->update('cart',$dataBaru);
				redirect('user/cart');

			}else{
				
			$data=[
				'username'=>$username,
				'id_produk'=>$id_produk,
				'jumlah'=>$jumlah,
				'size'=>$size,
				'harga'=>$harga,
				'berat'=>$berat
			];
			$this->db->insert('cart',$data);
			redirect('user/cart');
		}
		}
	}

	public function cart(){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}
		$data['title']='My Cart ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='Cart';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['cart']=$this->db->get_where('cart',['username'=>$this->session->userdata('username')])->result_array();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('user/cart',$data);
		$this->load->view('templates/footer');
	}

	public function removeCart($id){
		$this->db->where('id_cart',$id);
		$this->db->delete('cart');
		redirect('user/cart');
	}

	public function updateCart($id){

		$jumlah=$this->input->post('jumlah');

		$data['cart']=$this->db->get_where('cart',['id_cart'=>$id])->row_array();

		$jumlahBaru=[
			'jumlah'=>$jumlah
		];

		$this->db->where('id_cart',$id);
		$this->db->update('cart',$jumlahBaru);
		redirect('user/cart');

	}

	public function updateCartStokKurang($id,$stokbaru){
		$data['cart']=$this->db->get_where('cart',['id_cart'=>$id])->row_array();

		$jumlahBaru=[
			'jumlah'=>$stokbaru
		];

		$this->db->where('id_cart',$id);
		$this->db->update('cart',$jumlahBaru);
		redirect('user/cart');
	}

	public function checkout(){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}
	
		$data['title']='Checkout ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='Cart';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['cart']=$this->db->get_where('cart',['username'=>$this->session->userdata('username')])->result_array();
		$data['sizestok']=$this->db->get('sizestok')->result_array();

		foreach ($data['cart'] as $ct) {
			$id_produk=$ct['id_produk'];
			$id_cart=$ct['id_cart'];
			$stokkosong=0;
			$stokakhir=0;
			foreach ($data['sizestok'] as $ss) {
				if($ss['id_produk'] == $ct['id_produk'] && $ss['size'] == $ct['size']){
					$stokakhir = $ss['stok'];
				}
			}
			if($stokakhir == 0){
				$this->db->where('id_cart',$id_cart);
				$this->db->delete('cart');
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Empty stock items</div>');
				redirect('user/cart');
			}
		}

		$this->load->library('rajaongkir');
		if ($data['cart']==NULL) {
			redirect('user/cart');
		}

		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('provinsi','Province','required|trim');
		$this->form_validation->set_rules('city','City','required|trim');

		if($this->form_validation->run()==false){	
			$this->load->view('templates/header',$data);
			$this->load->view('user/checkout',$data);
			$this->load->view('templates/footer');
		}else{

			$totalPesan=0;
	        $totalCheckout=0;
	        $jumlahPesan=0;
	          foreach($data['cart'] as $ct){
	          $hargaAwal= $ct['harga'];
	          $jumlahPesan= $ct['jumlah'];
	          $totalPesan = $hargaAwal * $jumlahPesan;
	          $totalCheckout = $totalCheckout + $totalPesan;
	          }

	        $ongkir=$this->input->post('ongkir');

	        $ongkir_str = preg_replace("/[^0-9]/", "", $ongkir);
			$ongkir_int = (int) $ongkir_str;
	        $totalCost=$totalCheckout+$ongkir_int;

			$username=$this->session->userdata('username');
			$name=$this->input->post('name');
			$address=$this->input->post('address');
			$province=$this->input->post('provinsi');
			$city=$this->input->post('city');
			$waktuNow=date('Y-m-d H:i:s');
        	$deadline=date('Y-m-d H:i:s', strtotime('+24 hours') );

			$dataOrder=[
        	'username'=>$username,
        	'nama'=>$name,
        	'address'=>$address,
        	'provinsi'=>$province,
        	'kota'=>$city,
        	'ongkir'=>$ongkir_int,
        	'total'=>$totalCost,
        	'waktu'=>$waktuNow,
        	'deadline'=>$deadline,
        	'is_upload'=>0
        ];

        $this->db->insert('checkout',$dataOrder);

        $data['checkout']=$this->db->get_where('checkout',['username'=>$username, 'deadline'=>$deadline])->row_array();

        $id_checkout=$data['checkout']['id_checkout'];
		$waktu=$data['checkout']['waktu'];

		foreach ($data['cart'] as $ct) {
			if($ct['username']==$data['checkout']['username']){
				$username=$this->session->userdata('username');
				$id_produk=$ct['id_produk'];
				$harga=$ct['harga'];
				$jumlah=$ct['jumlah'];
				$size=$ct['size'];
				$waktu=$data['checkout']['waktu'];

				$dataPushCart = [
					'id_checkout'=>$id_checkout,
					'username'=>$username,
					'id_produk'=>$id_produk,
					'jumlah'=>$jumlah,
					'size'=>$size,
					'harga'=>$harga,
					'waktu'=>$waktu
				];

				$this->db->insert('orderan',$dataPushCart);

				$this->db->where('username',$username);
				$this->db->delete('cart');

				$selectStok="SELECT * FROM sizestok WHERE id_produk = $id_produk AND size = '$size'";
				$data['sizestok']=$this->db->query($selectStok)->row_array();

				$stok=$data['sizestok']['stok'];
				$kurangStok=$stok-$jumlah;
				
				$this->db->set('stok',$kurangStok);
				$this->db->where('id_produk',$id_produk);
				$this->db->where('size',$size);
				$this->db->update('sizestok');
			}
		}
		$this->session->set_flashdata('message','<div class="alert alert-light" role="alert">Please confirm your transaction!</div>');
		redirect('user/order');
		}
	}

	public function getProvince(){
		$this->load->library('rajaongkir');
		$provinces = $this->rajaongkir->province();
		$this->output->set_content_type('application/json')->set_output($provinces);
	}

	public function getKota($id_provinsi){
		$this->load->library('rajaongkir');
		$kota = $this->rajaongkir->city($id_provinsi);
		$this->output->set_content_type('application/json')->set_output($kota);
	}

	public function get_ongkir($asal,$tujuan,$berat,$kurir){
		$ongkir = $this->rajaongkir->cost($asal,$tujuan,$berat,$kurir);
		$this->output->set_content_type('application/json')->set_output($ongkir);
	}

	public function order(){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}
		$data['title']='My Order ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$this->db->order_by('waktu','DESC');
		$data['checkout']=$this->db->get_where('checkout',['username'=>$this->session->userdata('username')])->result_array();
		$data['order']=$this->db->get_where('orderan',['username'=>$this->session->userdata('username')])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('user/order',$data);
		$this->load->view('templates/footer');
	}

	public function transaction_form($id){
		if ($this->session->userdata('username')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
			redirect('auth');
		}
		$data['title']='Confirm Transaction ';
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['checkout']=$this->db->get_where('checkout',['id_checkout'=>$id])->row_array();
		$data['order']=$this->db->get_where('orderan',['id_checkout'=>$id])->result_array();
		$waktuNow=date('Y-m-d H:i:s');

		if($waktuNow>=$data['checkout']['deadline']){
		    $this->Model->hapusPembelian($data['checkout']['id_checkout']);
		    $this->Model->hapusOrderan($data['orderan']['id_checkout']);
		    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Your transaction has been canceled, please confirm your transaction before the deadline!</div>');
		    redirect('user/order');
		}

		$this->form_validation->set_rules('namaAkun', 'Account Name', 'required|trim');
		$this->form_validation->set_rules('nomorAkun', 'Account Number', 'required|trim');
		$this->form_validation->set_rules('namaBank', 'Bank Transfer From', 'required|trim');
		$this->form_validation->set_rules('transferdate', 'Transfer Date', 'required|trim');

		if($this->form_validation->run()==false){
			$this->load->view('templates/header',$data);
			$this->load->view('user/transaction_form',$data);
			$this->load->view('templates/footer');
		}else{
			$tanggalTrans=$this->input->post('transferdate');
			$nama_image = $_FILES['image']['name'];
			$upload_image = str_replace(" ", "_", $nama_image);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
			$config['max_size']		='200048';
			$config['upload_path']	='./assets/img/buktitrans/';
			
			if($upload_image==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Transfer Receipt!</div>');
				redirect('user/transaction_form/'.$id);
			}
			$this->load->library('upload',$config);

			if (!$this->upload->do_upload('image')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

			$data=[
				'id_checkout'=>$id,
				'username'=>$this->session->userdata('username'),
				'nama_akun'=>htmlspecialchars($this->input->post('namaAkun',true)),
				'nomor_akun'=>htmlspecialchars($this->input->post('nomorAkun',true)),
				'bank'=>htmlspecialchars($this->input->post('namaBank',true)),
				'total'=>$data['checkout']['total'],
				'tanggal_trans'=>$tanggalTrans,
				'bukti_trans'=>$upload_image
			];

			$this->db->insert('bukti',$data);
			$queryOrder="UPDATE `checkout` SET `is_upload` = '1' WHERE `checkout`.`id_checkout` = $id";
			$this->db->query($queryOrder);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your transaction has been received, please wait untill our team confirm your transaction.</div>');
			redirect('user/order');
		}
	}
}
