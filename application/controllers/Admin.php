<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Admin extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('email');
		date_default_timezone_set('Asia/Jakarta');
		require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';

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

		is_logged_in();
	}

	public function index(){

		$data['title']='Unconfirmed list';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['bukti']=$this->db->get_where('bukti',['is_processed'=>0])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/admin/footer');
	}

	public function detailTrans($id){
		$data['title']='Transaction Detail';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['buktijumlah']=$this->db->get('bukti')->result_array();
		$data['bukti']=$this->Model->getDataTrans($id);
		$data['produk']=$this->db->get('produk')->result_array();
		$id_checkout=$data['bukti']['id_checkout'];
		$data['checkout']=$this->db->get_where('checkout',['id_checkout'=>$id_checkout])->row_array();
		$data['orderan']=$this->db->get_where('orderan',['id_checkout'=>$data['bukti']['id_checkout']])->result_array();

		$id_provinsi=$data['checkout']['provinsi'];
		$this->load->library('rajaongkir');
	
		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/detailtrans',$data);
		$this->load->view('templates/admin/footer');	
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

	public function confirmPayment($id){
		$data['konfirmasi']=$this->db->get_where('bukti',['id_bukti'=>$id])->row_array();
		$data['order']=$this->db->get_where('orderan',['id_checkout'=>$data['konfirmasi']['id_checkout']])->result_array();

		$id_checkout=$data['konfirmasi']['id_checkout'];
		
		$queryConfirm="UPDATE `bukti` SET `is_processed` = '1' WHERE `bukti`.`id_bukti` = $id";
		$queryConfirmCheckout="UPDATE `checkout` SET `is_upload` = '1' WHERE `checkout`.`id_checkout` = $id_checkout";
		$this->db->query($queryConfirm);
		$this->db->query($queryConfirmCheckout);
		
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Transaction has been confirmed!</div>');
		redirect('admin/unprocessedOrder');
	}

	public function cancelPayment($id){
		$data['konfirmasi']=$this->db->get_where('bukti',['id_bukti'=>$id])->row_array();
		$data['order']=$this->db->get_where('orderan',['id_checkout'=>$data['konfirmasi']['id_checkout']])->result_array();

		$id_checkout=$data['konfirmasi']['id_checkout'];

		$queryConfirm="UPDATE `bukti` SET `is_processed` = '2' WHERE `bukti`.`id_bukti` = $id";
		$queryConfirmCheckout="UPDATE `checkout` SET `is_upload` = '2' WHERE `checkout`.`id_checkout` = $id_checkout";
		$this->db->query($queryConfirm);
		$this->db->query($queryConfirmCheckout);
		
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Transaction has been canceled!</div>');
		redirect('admin/canceledOrder');
	}

	public function deletePayment($id){
		$data['konfirmasi']=$this->db->get_where('bukti',['id_bukti'=>$id])->row_array();
		$data['order']=$this->db->get_where('orderan',['id_checkout'=>$data['konfirmasi']['id_checkout']])->result_array();

		$id_checkout=$data['konfirmasi']['id_checkout'];

		$this->db->where('id_bukti',$id);
		$this->db->delete('bukti');

		$this->db->where('id_checkout',$id_checkout);
		$this->db->delete('checkout');

		foreach ($data['order'] as $order) {
			$id_orderan=$order['id_orderan'];
			$id_produk=$order['id_produk'];
			$size=$order['size'];
			$jumlah=$order['jumlah'];
			$selectStok="SELECT * FROM sizestok WHERE id_produk = $id_produk AND size = '$size'";
			$data['sizestok']=$this->db->query($selectStok)->row_array();

			$stok=$data['sizestok']['stok'];
			$kurangStok=$stok+$jumlah;
			
			$this->db->set('stok',$kurangStok);
			$this->db->where('id_produk',$id_produk);
			$this->db->where('size',$size);
			$this->db->update('sizestok');
			$this->db->where('id_orderan',$id_orderan);
			$this->db->delete('orderan');
		}
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Transaction has been deleted!</div>');
		redirect('admin/canceledOrder');
	}

	public function unprocessedOrder(){
		$data['title']='Unprocessed list';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$this->db->order_by('id_bukti','ASC');
		$data['bukti']=$this->db->get_where('bukti',['is_processed'=>1])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/transaction/unprocessed_order/index',$data);
		$this->load->view('templates/admin/footer');
	}

	public function canceledOrder(){
		$data['title']='Canceled order list';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['bukti']=$this->db->get_where('bukti',['is_processed'=>2])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/canceled',$data);
		$this->load->view('templates/admin/footer');
	}

	public function confirmProcessingOrder($id){
		$data['konfirmasi']=$this->db->get_where('bukti',['id_bukti'=>$id])->row_array();
		$data['order']=$this->db->get_where('orderan',['id_checkout'=>$data['konfirmasi']['id_checkout']])->result_array();
		if($this->input->post('resi')==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please input receipt number!</div>');
		redirect('admin/detailTrans/'.$id);
		}
		$resi=$this->input->post('resi');
		$queryConfirm="UPDATE `bukti` SET `is_processed` = '3' WHERE `bukti`.`id_bukti` = $id";
		$this->db->query($queryConfirm);
		$data['checkout']=$this->db->get_where('checkout',['id_checkout'=>$id])->row_array();

		$this->db->set('no_resi',$resi);
		$this->db->where('id_checkout',$data['konfirmasi']['id_checkout']);
		$this->db->update('checkout');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Order have been processed!</div>');
		redirect('admin/processedOrder');
	}

	public function processedOrder(){
		$data['title']='Processed list';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$this->db->order_by('id_bukti','DESC');
		$data['bukti']=$this->db->get_where('bukti',['is_processed'=>3])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/transaction/processed_order/index',$data);
		$this->load->view('templates/admin/footer');
	}

	public function newProduk(){
		$data['title']='Your New Product';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();

		$config['base_url']= 'http://localhost/unreal/admin/newProduk';
		$config['total_rows']=$this->db->get_where('produk',['is_new'=>1])->num_rows();
		$config['per_page']=5;

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

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		// $this->db->order_by('stok','ASC');
		$data['produk']=$this->db->get_where('produk',['is_new'=>1],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/newproduct',$data);
		$this->load->view('templates/admin/footer');
	}

	public function addNewProduk($id){
		$this->Model->addToNewProduct($id);
		redirect('admin/newProduk');
	}

	public function hapusFromNewProduk($id){
		$this->Model->deleteFromNewProduct($id);
		redirect('admin/newProduk');
	}

	public function manageproduct(){
		$data['title']='Manage Product';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['jenis']=$this->db->get('jenis_produk')->result_array();

		$config['base_url']= 'http://localhost/unreal/admin/manageproduct';
		$config['total_rows']=$this->Model->hitungProduk();
		$config['per_page']=5;

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

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link');

		$this->pagination->initialize($config);


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id','DESC');
		$data['produk']=$this->Model->getProduk($config['per_page'],$data['start']);

		$this->form_validation->set_rules('id_produk', 'ID Produk','is_unique|trim');
		$this->form_validation->set_rules('produk', 'Nama Produk','required|trim');
		$this->form_validation->set_rules('harga', 'Harga Produk','required|numeric');
		$this->form_validation->set_rules('berat', 'Berat Produk','required|numeric');
		$this->form_validation->set_rules('stokS', 'Stok Produk S','required|trim|numeric');
		$this->form_validation->set_rules('stokM', 'Stok Produk M','required|trim|numeric');
		$this->form_validation->set_rules('stokL', 'Stok Produk L','required|trim|numeric');
		$this->form_validation->set_rules('stokXL', 'Stok Produk XL','required|trim|numeric');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Produk','required|trim');

		if($this->form_validation->run()==false){
		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/manageproduct',$data);
		$this->load->view('templates/admin/footer');
		}else{
			$data['cekproduk']=$this->db->get_where('produk',['nama_produk'=>$this->input->post('produk')])->row_array();
			$data['ceksize']=$this->db->get_where('sizestok',['id_produk'=>$data['cekproduk']['id'],'size'=>$this->input->post('size')])->row_array();
			if ($data['cekproduk']!=NULL && $data['ceksize']==NULL) {
				$data2=[
				'id_produk'=>$data['cekproduk']['id'],
				'size'=>$this->input->post('size'),
				'stok'=>$this->input->post('stok')
			];
			$this->db->insert('sizestok',$data2);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New product has been added!</div>');
			redirect('admin/manageproduct');
			}elseif($data['cekproduk']!=NULL && $data['ceksize']!=NULL){
				$stoklama=$data['ceksize']['stok'];
				$stokbaru=$this->input->post('stok');
				$stoksekarang=$stoklama+$stokbaru;
				$data2=[
				'stok'=>$stoksekarang
			];
			$this->db->where('id_produk',$data['ceksize']['id_produk']);
			$this->db->update('sizestok',$data2);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New product has been added!</div>');
			redirect('admin/manageproduct');
			}else{

			$nama_image = $_FILES['image']['name'];
			$nama_image_larger = $_FILES['imagelarger']['name'];
			$upload_image = str_replace(" ", "_", $nama_image);
			$upload_image_larger = str_replace(" ", "_", $nama_image_larger);

			$nama_image2 = $_FILES['image2']['name'];
			$nama_image_larger2 = $_FILES['imagelarger2']['name'];
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image_larger2 = str_replace(" ", "_", $nama_image_larger2);

			$nama_image3 = $_FILES['image3']['name'];
			$nama_image_larger3 = $_FILES['imagelarger3']['name'];
			$upload_image3 = str_replace(" ", "_", $nama_image3);
			$upload_image_larger3 = str_replace(" ", "_", $nama_image_larger3);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/img/produk/';

			if($upload_image==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Product Photo!</div>');
				redirect('admin/product');
			}

			if($upload_image_larger==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload the Larger Product Photo!</div>');
				redirect('admin/product');
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

        	if (!$this->upload->do_upload('imagelarger')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image2')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('imagelarger2')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image3')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('imagelarger3')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

			$data = [
				'id' => $this->input->post('id_produk'),
				'nama_produk' => $this->input->post('produk'),
				'jenis' => "Clothes",
				'harga' => $this->input->post('harga'),
				'gambar' => $upload_image,
				'gambarlarger' => $upload_image_larger,
				'gambar2' => $upload_image2,
				'gambarlarger2' => $upload_image_larger2,
				'gambar3' => $upload_image3,
				'gambarlarger3' => $upload_image_larger3,
				'deskripsi' => $this->input->post('deskripsi'),
				'berat' => $this->input->post('berat'),
				'is_new'=>1
			];

			$this->db->insert('produk',$data);
			$data['produklagi']=$this->db->get_where('produk',['nama_produk'=>$this->input->post('produk')])->row_array();

			$dataS=[
				'id_produk'=>$data['produklagi']['id'],
				'size'=>'S',
				'stok'=>$this->input->post('stokS')
			];

			$this->db->insert('sizestok',$dataS);

			$dataM=[
				'id_produk'=>$data['produklagi']['id'],
				'size'=>'M',
				'stok'=>$this->input->post('stokM')
			];

			$this->db->insert('sizestok',$dataM);

			$dataL=[
				'id_produk'=>$data['produklagi']['id'],
				'size'=>'L',
				'stok'=>$this->input->post('stokL')
			];

			$this->db->insert('sizestok',$dataL);

			$dataXL=[
				'id_produk'=>$data['produklagi']['id'],
				'size'=>'XL',
				'stok'=>$this->input->post('stokXL')
			];

			$this->db->insert('sizestok',$dataXL);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New product has been added!</div>');
			redirect('admin/manageproduct');
		}
		}
	}

	public function hapusProduk($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();
		$old_image = $data['produk']['gambar'];
		$old_image_larger = $data['produk']['gambarlarger'];
		$old_image2 = $data['produk']['gambar2'];
		$old_image_larger2 = $data['produk']['gambarlarger2'];
		$old_image3 = $data['produk']['gambar3'];
		$old_image_larger3 = $data['produk']['gambarlarger3'];
		if($old_image != 'plain.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image);
		}if($old_image_larger != 'plainlarger.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image_larger);
		}
		if($old_image2 != 'plain.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image2);
		}if($old_image_larger2 != 'plainlarger.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image_larger2);
		}
		if($old_image3 != 'plain.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image3);
		}if($old_image_larger3 != 'plainlarger.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image_larger3);
		}
		$this->Model->hapusProduk($id);
		$this->Model->hapusProdukSize($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Successfully removed the product!</div>');
		redirect('admin/manageproduct');
	}

	public function get_stok($idproduk,$size){
		$stok=$this->db->get_where('sizestok',['id_produk'=>$idproduk,'size'=>$size])->result_array();
		echo json_encode($stok);
	}

	public function editGambar1($id){
		$data['title']='Edit Gambar 1';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->Model->getDataProdukById($id);

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/editgambar/gambar1',$data);
		$this->load->view('templates/admin/footer');
	}

	public function editGambar2($id){
		$data['title']='Edit Gambar 2';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->Model->getDataProdukById($id);

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/editgambar/gambar2',$data);
		$this->load->view('templates/admin/footer');
	}

	public function editGambar3($id){
		$data['title']='Edit Gambar 3';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->Model->getDataProdukById($id);

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/editgambar/gambar3',$data);
		$this->load->view('templates/admin/footer');
	}

	public function doEditGambar1($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

		$nama_image = $_FILES['image']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);
		$nama_image_larger = $_FILES['imagelarger']['name'];
		$upload_image_larger = str_replace(" ", "_", $nama_image_larger);

		$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
		$config['max_size']		='200048';
		$config['upload_path']	='./assets/img/produk/';

		if($upload_image==NULL && $upload_image_larger==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Product Image!</div>');
			redirect('admin/editGambar1/'.$id);
		}else if($upload_image != NULL && $upload_image_larger == NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
		}else if($upload_image == NULL && $upload_image_larger != NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('imagelarger')){
					$old_image = $data['produk']['gambarlarger'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambarlarger'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('imagelarger')){
					$old_image_larger = $data['produk']['gambarlarger'];
					if($old_image_larger != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image_larger);
				}
					$new_image_larger = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar' => $new_image,
					'gambarlarger'=>$new_image_larger
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}
	}

	public function doEditGambar2($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

		$nama_image = $_FILES['image']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);
		$nama_image_larger = $_FILES['imagelarger']['name'];
		$upload_image_larger = str_replace(" ", "_", $nama_image_larger);

		$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
		$config['max_size']		='200048';
		$config['upload_path']	='./assets/img/produk/';

		if($upload_image==NULL && $upload_image_larger==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Product Image!</div>');
			redirect('admin/editGambar2/'.$id);
		}else if($upload_image != NULL && $upload_image_larger == NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar2'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar2'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
		}else if($upload_image == NULL && $upload_image_larger != NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('imagelarger')){
					$old_image = $data['produk']['gambarlarger2'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambarlarger2'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar2'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('imagelarger')){
					$old_image_larger = $data['produk']['gambarlarger2'];
					if($old_image_larger != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image_larger);
				}
					$new_image_larger = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar2' => $new_image,
					'gambarlarger2'=>$new_image_larger
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}
	}

	public function doEditGambar3($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

		$nama_image = $_FILES['image']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);
		$nama_image_larger = $_FILES['imagelarger']['name'];
		$upload_image_larger = str_replace(" ", "_", $nama_image_larger);

		$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
		$config['max_size']		='200048';
		$config['upload_path']	='./assets/img/produk/';

		if($upload_image==NULL && $upload_image_larger==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Product Image!</div>');
			redirect('admin/editGambar3/'.$id);
		}else if($upload_image != NULL && $upload_image_larger == NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar3'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar3'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
		}else if($upload_image == NULL && $upload_image_larger != NULL){
			$this->load->library('upload',$config);

				if($this->upload->do_upload('imagelarger')){
					$old_image = $data['produk']['gambarlarger3'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambarlarger3'=>$new_image
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$old_image = $data['produk']['gambar3'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('imagelarger')){
					$old_image_larger = $data['produk']['gambarlarger3'];
					if($old_image_larger != 'plain.png'){
					unlink(FCPATH . 'assets/img/produk/'.$old_image_larger);
				}
					$new_image_larger = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar3' => $new_image,
					'gambarlarger3'=>$new_image_larger
				];
				$this->db->where('id',$id);
				$this->db->update('produk',$data);

				redirect('admin/detailProduk/'.$id);
			}
	}

	public function deleteGambar2($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

		$old_image2 = $data['produk']['gambar2'];
		$old_image_larger2 = $data['produk']['gambarlarger2'];
		
		if($old_image2 != 'plain.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image2);
		}if($old_image_larger2 != 'plainlarger.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image_larger2);
		}

		$data=[
			'gambar2'=>"",
			'gambarlarger2'=>""
		];

		$this->db->where('id',$id);
		$this->db->update('produk',$data);
		redirect('admin/detailProduk/'.$id);
	}

	public function deleteGambar3($id){
		$data['produk']=$this->db->get_where('produk',['id'=>$id])->row_array();

		$old_image3 = $data['produk']['gambar3'];
		$old_image_larger3 = $data['produk']['gambarlarger3'];

		if($old_image3 != 'plain.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image3);
		}if($old_image_larger3 != 'plainlarger.png'){
			unlink(FCPATH . 'assets/img/produk/'.$old_image_larger3);
		}

		$data=[
			'gambar3'=>"",
			'gambarlarger3'=>""
		];

		$this->db->where('id',$id);
		$this->db->update('produk',$data);
		redirect('admin/detailProduk/'.$id);
	}

	public function editProduk($id){
		$data['title']='Edit Product';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->Model->getDataProdukById($id);
		$data['jenis']=$this->db->get('jenis_produk')->result_array();
		$data['sizestokS']=$this->db->get_where('sizestok',['id_produk'=>$id , 'size' => 'S'])->row_array();
		$data['sizestokM']=$this->db->get_where('sizestok',['id_produk'=>$id , 'size' => 'M'])->row_array();
		$data['sizestokL']=$this->db->get_where('sizestok',['id_produk'=>$id , 'size' => 'L'])->row_array();
		$data['sizestokXL']=$this->db->get_where('sizestok',['id_produk'=>$id , 'size' => 'XL'])->row_array();

		$this->form_validation->set_rules('id_produk', 'ID Produk');
		$this->form_validation->set_rules('produk', 'Nama Produk','required|trim');
		$this->form_validation->set_rules('harga', 'Harga Produk','required|numeric');
		$this->form_validation->set_rules('berat', 'berat Produk','required|numeric');
		$this->form_validation->set_rules('stokS', 'Stok Produk S','required|trim|numeric');
		$this->form_validation->set_rules('stokM', 'Stok Produk M','required|trim|numeric');
		$this->form_validation->set_rules('stokL', 'Stok Produk L','required|trim|numeric');
		$this->form_validation->set_rules('stokXL', 'Stok Produk XL','required|trim|numeric');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Produk','required|trim');

		if($this->form_validation->run()==false){
		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/editproduct',$data);
		$this->load->view('templates/admin/footer');
		}else{

			$data = [
				'id' => $this->input->post('id_produk'),
				'nama_produk' => $this->input->post('produk'),
				'harga' => $this->input->post('harga'),
				'deskripsi' => $this->input->post('deskripsi'),
				'berat' => $this->input->post('berat')
			];
			$this->db->where('id',$id);
			$this->db->update('produk',$data);

			$data['ceksizeS']=$this->db->get_where('sizestok',['id_produk'=>$id,'size'=>'S'])->row_array();
			$data['ceksizeM']=$this->db->get_where('sizestok',['id_produk'=>$id,'size'=>'M'])->row_array();
			$data['ceksizeL']=$this->db->get_where('sizestok',['id_produk'=>$id,'size'=>'L'])->row_array();
			$data['ceksizeXL']=$this->db->get_where('sizestok',['id_produk'=>$id,'size'=>'XL'])->row_array();

			
			$idStokS=$data['ceksizeS']['id_produk'];
			$idStokM=$data['ceksizeM']['id_produk'];
			$idStokL=$data['ceksizeL']['id_produk'];
			$idStokXL=$data['ceksizeXL']['id_produk'];
			$stokS=$this->input->post('stokS');
			$stokM=$this->input->post('stokM');
			$stokL=$this->input->post('stokL');
			$stokXL=$this->input->post('stokXL');
				
			$dataS=[
				'stok'=>$stokS
			];

			$queryUpdateStockS = "UPDATE `sizestok` SET `stok` = $stokS WHERE `sizestok`.`id_produk` = $idStokS AND `sizestok`.`size` = 'S';";

			$this->db->query($queryUpdateStockS);

			$dataM=[
				'stok'=>$stokM
			];

			$queryUpdateStockM = "UPDATE `sizestok` SET `stok` = $stokM WHERE `sizestok`.`id_produk` = $idStokM AND `sizestok`.`size` = 'M';";

			$this->db->query($queryUpdateStockM);

			$dataL=[
				'stok'=>$stokL
			];

			$queryUpdateStockL = "UPDATE `sizestok` SET `stok` = $stokL WHERE `sizestok`.`id_produk` = $idStokL AND `sizestok`.`size` = 'L';";

			$this->db->query($queryUpdateStockL);

			$dataXL=[
				'stok'=>$stokXL
			];

			$queryUpdateStockXL = "UPDATE `sizestok` SET `stok` = $stokXL WHERE `sizestok`.`id_produk` = $idStokXL AND `sizestok`.`size` = 'XL';";

			$this->db->query($queryUpdateStockXL);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your product has been updated!</div>');
			redirect('admin/manageproduct');
		}
	}

	public function detailProduk($id){
		$data['title']='Product Detail';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->Model->getDataProdukById($id);
		$data['sizestok']=$this->db->get_where('sizestok',['id_produk'=>$id])->result_array();	

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/detailproduct',$data);
		$this->load->view('templates/admin/footer');
	}

	public function manageLookbook(){
		$data['title']='Manage Lookbook';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['lookbook']=$this->db->get('lookbook')->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/managelookbook',$data);
		$this->load->view('templates/admin/footer');
	}

	public function addLookbook(){
		

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['waktu']=date('d-m-Y');

		$this->form_validation->set_rules('lookbook_nama', 'Lookbook name','required|trim|is_unique[lookbook.nama]',[
			'is_unique' => 'This lookbook has already registered!']);
		$this->form_validation->set_rules('tanggal', 'Date','required|trim');

		if($this->form_validation->run()==false){
			$data['title']='Add Lookbook';
			$this->load->view('templates/admin/header',$data);
			$this->load->view('templates/admin/sidebar',$data);
			$this->load->view('templates/admin/topbar',$data);
			$this->load->view('admin/manageitems/addlookbook',$data);
			$this->load->view('templates/admin/footer');
		}else{
			$nama=$this->input->post('lookbook_nama');
			$tanggal=$this->input->post('tanggal');

			$nama_image1 = $_FILES['image1']['name'];
			$nama_image2 = $_FILES['image2']['name'];
			$nama_image3 = $_FILES['image3']['name'];

			$upload_image1 = str_replace(" ", "_", $nama_image1);
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image3 = str_replace(" ", "_", $nama_image3);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
			$config['max_size']		='200048';
			$config['upload_path']	='./assets/img/lookbook/';

			for($a=1;$a<4;$a++){
				if($upload_image1==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please upload all images!</div>');
				redirect('admin/addLookbook');
				}else{
					if($upload_image2==NULL){
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please upload all images!</div>');
					redirect('admin/addLookbook');
					}else{
						if($upload_image3==NULL){
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please upload all images!</div>');
						redirect('admin/addLookbook');
						}
					}
				}
			}
			$this->load->library('upload',$config);

			for($a=1;$a<4;$a++){
			if (!$this->upload->do_upload('image'.$a)) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}
        	}

			$data=[
				'nama'=>$nama,
				'date'=>$tanggal,
				'gambar1'=>$upload_image1,
				'gambar2'=>$upload_image2,
				'gambar3'=>$upload_image3
			];
			$this->db->insert('lookbook',$data);

			$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['nama'=>$nama])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbook');
		}
	}

	public function manageLookbookDetail($id){
		$data['title']='Detail Lookbook';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
		$data['produk_lookbook']=$this->db->get_where('produk_lookbook',['id_lookbook'=>$id])->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/managelookbookdetail',$data);
		$this->load->view('templates/admin/footer');
	}

	public function editLookbook($id){
		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['produk']=$this->db->get('produk')->result_array();
		$data['waktu']=date('d-m-Y');
		$data['lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
		$data['produk_lookbook']=$this->db->get_where('produk_lookbook',['id_lookbook'=>$id])->result_array();

		if($this->input->post('lookbook_nama')!=$data['lookbook']['nama']){
		$this->form_validation->set_rules('lookbook_nama', 'Lookbook name','required|trim|is_unique[lookbook.nama]',[
			'is_unique' => 'This lookbook has already registered!']);
		}
		$this->form_validation->set_rules('tanggal', 'Date','required|trim');

		if($this->form_validation->run()==false){
			$data['title']='Edit Lookbook';
			$this->load->view('templates/admin/header',$data);
			$this->load->view('templates/admin/sidebar',$data);
			$this->load->view('templates/admin/topbar',$data);
			$this->load->view('admin/manageitems/managelookbookedit',$data);
			$this->load->view('templates/admin/footer');
		}else{
			$nama=$this->input->post('lookbook_nama');
			$tanggal=$this->input->post('tanggal');
			$nama_image1 = $_FILES['image1']['name'];
			$nama_image2 = $_FILES['image2']['name'];
			$nama_image3 = $_FILES['image3']['name'];

			$upload_image1 = str_replace(" ", "_", $nama_image1);
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image3 = str_replace(" ", "_", $nama_image3);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
			$config['max_size']		='200048';
			$config['upload_path']	='./assets/img/lookbook/';

			//update gak upload
			if($upload_image1==NULL && $upload_image2==NULL && $upload_image3==NULL){
			$data=[
				'nama'=>$nama,
				'date'=>$tanggal
			];
			$this->db->where('id_lookbook',$id);
			$this->db->update('lookbook',$data);

			$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
			}
			//edit upload gambar 1 doang
			elseif($upload_image1!=NULL && $upload_image2==NULL && $upload_image3==NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image1')){
					$old_image = $data['lookbook']['gambar1'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image);
					$new_image1 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar1'=>$new_image1
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}
				//edit upload gambar 2 doang
				elseif($upload_image1==NULL && $upload_image2!=NULL && $upload_image3==NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image2')){
					$old_image = $data['lookbook']['gambar2'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image);
					$new_image2 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar2'=>$new_image2
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}
				//upload gambar 3 doang
				elseif($upload_image1==NULL && $upload_image2==NULL && $upload_image3!=NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image3')){
					$old_image = $data['lookbook']['gambar3'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image);
					$new_image3 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar3'=>$new_image3
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}
				//upload gambar 1 sama 2
				elseif($upload_image1!=NULL && $upload_image2!=NULL && $upload_image3==NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image1')){
					$old_image1 = $data['lookbook']['gambar1'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image1);
					$new_image1 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('image2')){
					$old_image2 = $data['lookbook']['gambar2'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image2);
					$new_image2 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar1'=>$new_image1,
					'gambar2'=>$new_image2
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}
				//upload gambar 1 sama 3
				elseif($upload_image1!=NULL && $upload_image2==NULL && $upload_image3!=NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image1')){
					$old_image1 = $data['lookbook']['gambar1'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image1);
					$new_image1 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('image3')){
					$old_image3 = $data['lookbook']['gambar3'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image3);
					$new_image3 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar1'=>$new_image1,
					'gambar3'=>$new_image3
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}
				//upload gambar 2 sama 3
				elseif($upload_image1==NULL && $upload_image2!=NULL && $upload_image3!=NULL){
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image2')){
					$old_image2 = $data['lookbook']['gambar2'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image2);
					$new_image2 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('image3')){
					$old_image3 = $data['lookbook']['gambar3'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image3);
					$new_image3 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar2'=>$new_image2,
					'gambar3'=>$new_image3
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('image1')){
					$old_image1 = $data['lookbook']['gambar1'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image1);
					$new_image1 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('image2')){
					$old_image2 = $data['lookbook']['gambar2'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image2);
					$new_image2 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				if($this->upload->do_upload('image3')){
					$old_image3 = $data['lookbook']['gambar3'];
					unlink(FCPATH . 'assets/img/lookbook/'.$old_image3);
					$new_image3 = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'nama'=>$nama,
					'date'=>$tanggal,
					'gambar1'=>$new_image1,
					'gambar2'=>$new_image2,
					'gambar3'=>$new_image3
				];
				$this->db->where('id_lookbook',$id);
				$this->db->update('lookbook',$data);

				$i=1;
			$data['produk']=$this->db->get('produk')->result_array();
			$idLama=$id;
			$this->db->where('id_lookbook',$idLama);
			$this->db->delete('produk_lookbook');
			foreach($data['produk'] as $pr){
			$data['getId_lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
				if($this->input->post('checkbox'.$i)!=NULL){
					$nama_produk=$this->input->post('checkbox'.$i);
					$id=$data['getId_lookbook']['id_lookbook'];

					$data=[
						'id_lookbook'=>$id,
						'nama_produk_lookbook'=>$nama_produk
					];
					$this->db->insert('produk_lookbook',$data);
				}
				$i++;
			}
			redirect('admin/manageLookbookDetail/'.$id);
				}

			
		}
	}

	public function deleteLookbook($id){
		$data['lookbook']=$this->db->get_where('lookbook',['id_lookbook'=>$id])->row_array();
		$old_image1 = $data['lookbook']['gambar1'];
		$old_image2 = $data['lookbook']['gambar2'];
		$old_image3 = $data['lookbook']['gambar3'];
		
		unlink(FCPATH . 'assets/img/lookbook/'.$old_image1);
		unlink(FCPATH . 'assets/img/lookbook/'.$old_image2);
		unlink(FCPATH . 'assets/img/lookbook/'.$old_image3);

		$this->Model->hapus_lookbook($id);
		$this->Model->hapus_produk_lookbook($id);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Successfully removed the lookbook!</div>');
		redirect('admin/manageLookbook');
	}

	public function manageHeader(){
		$data['title']='Manage Header';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['header']=$this->db->get('header')->result_array();

		$this->form_validation->set_rules('tempat', 'Header Place','required|trim');

		if($this->form_validation->run()==false){
			$this->load->view('templates/admin/header',$data);
			$this->load->view('templates/admin/sidebar',$data);
			$this->load->view('templates/admin/topbar',$data);
			$this->load->view('admin/manageitems/manageheader',$data);
			$this->load->view('templates/admin/footer');
		}else{
			$nama_image = $_FILES['image']['name'];
			$upload_image = str_replace(" ", "_", $nama_image);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
			$config['max_size']		='200048';
			$config['upload_path']	='./assets/img/header/';

			if($upload_image==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Header Image!</div>');
				redirect('admin/product');
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

			$data = [
				'tempat' => $this->input->post('tempat'),
				'gambar' => $upload_image
			];

			$this->db->insert('header',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New header has been added!</div>');
			redirect('admin/manageHeader');
		}
	}

	public function editHeader($tempat){
		$data['title']='Edit Header';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['header']=$this->db->get_where('header',['tempat'=>$tempat])->row_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/manageitems/editheader',$data);
		$this->load->view('templates/admin/footer');
	}

	public function doEditHeader($tempat){
		$data['header']=$this->db->get_where('header',['tempat'=>$tempat])->row_array();

		$nama_image = $_FILES['image']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);

		$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
		$config['max_size']		='200048';
		$config['upload_path']	='./assets/img/header/';

		if($upload_image==NULL){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Please upload Header Image!</div>');
			redirect('admin/editHeader/'.$tempat);
		}

		$this->load->library('upload',$config);

		if($this->upload->do_upload('image')){
			$old_image = $data['header']['gambar'];
			unlink(FCPATH . 'assets/img/header/'.$old_image);
			$new_image = $this->upload->data('file_name');
		}else{
			echo $this->upload->display_errors();
		}

		$data = [
			'gambar' => $new_image
		];

		$this->db->where('tempat',$tempat);
		$this->db->update('header',$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your header has been successfully edited!</div>');
		redirect('admin/manageHeader');
	}

	public function deleteHeader($tempat){
		$data['header']=$this->db->get_where('header',['tempat'=>$tempat])->row_array();
		$old_image = $data['header']['gambar'];
		unlink(FCPATH . 'assets/img/header/'.$old_image);
		$this->db->where('tempat',$tempat);
		$this->db->delete('header');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Successfully removed the header!</div>');
		redirect('admin/manageHeader');
	}

	// contact tab
	public function userHelp(){
		$data['title']='User Help';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['help']=$this->db->get('help')->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/contact/user_help/index',$data);
		$this->load->view('templates/admin/footer');
	}

	public function helpDetail($id){
		$data['title']='Message Detail';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['pesan']=$this->db->get_where('help',['id_help'=>$id])->row_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/contact/user_help/detail',$data);
		$this->load->view('templates/admin/footer');
	}

	public function replyHelp($id){
		$data['title']='Reply Message';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['pesan']=$this->db->get_where('help',['id_help'=>$id])->row_array();

		$this->form_validation->set_rules('subjek','Subject','trim|required');
		$this->form_validation->set_rules('pesan','Message','trim|required');

		if($this->form_validation->run()==false){
			$this->load->view('templates/admin/header',$data);
			$this->load->view('templates/admin/sidebar',$data);
			$this->load->view('templates/admin/topbar',$data);
			$this->load->view('admin/contact/user_help/reply',$data);
			$this->load->view('templates/admin/footer');
		}else{
			$this->sendReplyHelp();

			$this->db->where('id_help',$id);
			$this->db->delete('help');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Successfully send reply email!</div>');
			redirect('admin/userHelp');
		}
	}

	public function sendReplyHelp(){

		$email=$this->input->post('email');
        $subject=$this->input->post('subjek');
        $message=$this->input->post('pesan');

		$response = false;
        $mail = new PHPMailer();
                   
            
        // SMTP configuration
        $mail->isSMTP(); 
        $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'takiyagenji0721@gmail.com'; // user email
        $mail->Password = 'genjic00l'; // password email
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 587;
            
        $mail->From = "takiyagenji0721@gmail.com"; //email pengirim
		$mail->FromName = "MABAAR"; //nama pengirim
            
        // Add a recipient
        $mail->addAddress($email); //email tujuan pengiriman email
            
        // Email subject
        $mail->Subject = $subject; //subject email
            
        // Set email format to HTML
        $mail->isHTML(true);
            
        // Email body content
        $mailContent = '<p>'.$message.'</p>'; // isi email
        $mail->Body = $mailContent;


            
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        	die;
        }else{
            echo 'Message has been sent';
        	die;
        }
	}

	//newsletter
	public function adminNewsletter(){
		$data['title']='Newsletter';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['newsletter']=$this->db->get('newsletter')->result_array();

		$this->load->view('templates/admin/header',$data);
		$this->load->view('templates/admin/sidebar',$data);
		$this->load->view('templates/admin/topbar',$data);
		$this->load->view('admin/contact/newsletter/index',$data);
		$this->load->view('templates/admin/footer');
	}

	public function deleteEmailNewsletter($id){
		$this->db->where('id_newsletter',$id);
		$this->db->delete('newsletter');

		redirect('admin/adminNewsletter');
	}
	
	public function newNewsletter(){
		$data['title']='New Newsletter';

		$data['user']=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		$data['newsletter']=$this->db->get('newsletter')->result_array();

		$this->form_validation->set_rules('subjek','Subject','trim|required');

		if($this->form_validation->run()==false){
			$this->load->view('templates/admin/header',$data);
			$this->load->view('templates/admin/sidebar',$data);
			$this->load->view('templates/admin/topbar',$data);
			$this->load->view('admin/contact/newsletter/newnewsletter',$data);
			$this->load->view('templates/admin/footer');
		}else{
			foreach ($data['newsletter'] as $nl) {
				$email = $nl['email'];
				$this->sendNewsletter($email);
			}

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Successfully send newsletter!</div>');
		redirect('admin/adminNewsletter');
		}
	}

	private function sendNewsletter($email){
		
		$subject=$this->input->post('subjek');
		$nama_image = $_FILES['image']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);

		$configimg['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG';
		$configimg['max_size']		='200048';
		$configimg['upload_path']	='./assets/img/newsletter/';

		$this->load->library('upload',$configimg);

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

		$response = false;
        $mail = new PHPMailer();

        // SMTP configuration
        // SMTP configuration

        $mail->isSMTP(); 
        $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'takiyagenji0721@gmail.com'; // user email
        $mail->Password = 'genjic00l'; // password email
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 587;

		$mail->From = "takiyagenji0721@gmail.com"; //email pengirim
		$mail->FromName = "MABAAR"; //nama pengirim
		$mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mailContent = '<a href="http://localhost/unreal/lookbook"><img src="'.base_url().'assets/img/newsletter/'.$upload_image.'"></img></a>';
		$mail->Body = $mailContent;

		$mail->send();
	}
	//end of newsletter

	//end of contact tab
}