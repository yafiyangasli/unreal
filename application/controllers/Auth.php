<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('form_validation');
		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->session->set_userdata('search',$search);
			redirect('catalogue');
		}
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
	}

	public function index()
	{
		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$this->form_validation->set_rules('id','Username or Email','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');

		if($this->form_validation->run()==false){
		$data['title']='Login ';

		$this->load->view('templates/header',$data);
		$this->load->view('auth/index',$data);
		$this->load->view('templates/footer');
		}else{
			
			$this->login();
		}
	}

	public function login(){
		$id=$this->input->post('id');
		$password=$this->input->post('password');

		$user=$this->db->get_where('user',['username'=>$id])->row_array();
		$email=$this->db->get_where('user',['email'=>$id])->row_array();
		if($user){
			//kalo user active
			if($user['is_active']==1){
				if(password_verify($password, $user['password'])){
					$data=[
						'username'=>$user['username'],
						'nama'=>$user['nama'],
						'role_id'=>$user['role_id']
					];
					$this->session->set_userdata($data);
					if($user['role_id']==1){
						redirect('admin');
					}else{
					redirect('home');
				}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account has not been activated. Please activated first!</div>');
			redirect('auth');
			}
		}if($email){
			//kalo user active
			if($email['is_active']==1){
				if(password_verify($password, $email['password'])){
					$data=[
						'username'=>$email['username'],
						'nama'=>$email['nama'],
						'role_id'=>$email['role_id']
					];
					$this->session->set_userdata($data);
					if($email['role_id']==1){
						redirect('admin');
					}else{
					redirect('home');
				}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account has not been activated. Please activated first!</div>');
			redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username or Email is not registered!</div>');
			redirect('auth');
		}
	}


	public function logout(){
		$this->session->unset_userdata('username');

		redirect('home');
	}

	public function register(){
		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',[
			'is_unique' => 'This username has already registered!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'This email has already registered!']
		);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]',[
			'min_length'=>'Password to short'
		]);

		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',['matches'=>'Password dont match']);
		$this->form_validation->set_rules('telephone', 'Contact Number', 'required|trim|numeric|min_length[6]',['min_length'=>'Please enter the correct number phone']);
		$this->form_validation->set_rules('terms', 'Terms & Condition', 'required',['required'=>'Please accept our terms and conditions & privacy policy!']);


		if($this->form_validation->run()==false){
		$data['title']='Registration ';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/register');
		$this->load->view('templates/footer');
		}else{
			if ($this->input->post('address')==NULL) {
				$data=[
				'username'=>htmlspecialchars($this->input->post('username',true)),
				'email'=>htmlspecialchars($this->input->post('email',true)),
				'password'=>password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'telephone'=>$this->input->post('telephone'),
				'address'=>"",
				'role_id'=>2,
				'is_active'=>1
			];
			}else{
				$data=[
					'username'=>htmlspecialchars($this->input->post('username',true)),
					'email'=>htmlspecialchars($this->input->post('email',true)),
					'password'=>password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'telephone'=>$this->input->post('telephone'),
					'address'=>$this->input->post('address'),
					'role_id'=>2,
					'is_active'=>1
				];
			}
			$this->db->insert('user',$data);
			$this->session->set_userdata($data);
			$this->session->set_flashdata('message','<div class="alert alert-light" role="alert">Your registration was successful</div>');
			redirect('user');			
		}	
	}

	public function errors(){
		$this->load->view('auth/error');
	}

	private function sendEmail($token,$type){

		$email=$this->input->post('email');

		$response = false;
	    $mail = new PHPMailer();
	                   
	            
	        // SMTP configuration
	    $mail->isSMTP(); 
	    $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
	    $mail->SMTPAuth = true;
	    $mail->Username = 'admin@unrealclubs.com'; // user email
	    $mail->Password = 'Jakarta123'; // password email
	    $mail->SMTPSecure = 'ssl';
	    $mail->Port     = 587;

		$mail->From = "noreply@unrealclubs.com"; //email pengirim
		$mail->FromName = "Admin No Reply UNREAL"; //nama pengirim

		// Add a recipient
        $mail->addAddress($email); //email tujuan pengiriman email

		if($type == 'verify'){
			// Email subject
        	$mail->Subject = 'Account Verification'; //subject email
        	// Set email format to HTML
	        $mail->isHTML(true);
	            
	        // Email body content
	        $mailContent = 'Click this link to verify your account : <a href="'.base_url().'auth/verify?email='.$this->input->post('email').'&token='.urlencode($token).'">Activate</a>'; // isi email
	        $mail->Body = $mailContent;

	        if(!$mail->send()){
            	echo 'Message could not be sent.';
            	echo 'Mailer Error: ' . $mail->ErrorInfo;
        		die;
        	}else{
            	echo 'Message has been sent';
        		die;
        	}
		}else if($type == 'forgot'){
			// Email subject
        	$mail->Subject = 'Reset Password'; //subject email
        	// Set email format to HTML
	        $mail->isHTML(true);
	            
	        // Email body content
	        $mailContent = 'Click this link to reset your password : <a href="'.base_url().'auth/resetpassword?email='.$this->input->post('email').'&token='.urlencode($token).'">Reset password</a>'; // isi email
	        $mail->Body = $mailContent;

	        if(!$mail->send()){
            	echo 'Message could not be sent.';
            	echo 'Mailer Error: ' . $mail->ErrorInfo;
        		die;
        	}else{
            	echo 'Message has been sent';
        		die;
        	}
		}
	}

	public function forgotpassword(){

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['title']='Forgot Password ';
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if($this->form_validation->run()==false){
		$this->load->view('templates/header',$data);
		$this->load->view('auth/forgotpassword', $data);
		$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email');

			$user=$this->db->get_where('user',['email'=>$email, 'is_active'=>1])->row_array();

			if($user){
				$token= base64_encode(random_bytes(32));
				$user_token= [
					'email'=>$email,
					'token'=>$token,
					'date_created'=>time()
				];

				$this->db->insert('user_token',$user_token);

				$this->sendEmail($token,'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-light" role="alert">Please check your email to reset your password!</div>');
				redirect('auth/forgotpassword');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user= $this->db->get_where('user', ['email'=>$email])->row_array();

		if($user){
			$user_token=$this->db->get_where('user_token',['token'=>$token])->row_array();
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
				redirect('auth/forgotpassword');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
				redirect('auth/forgotpassword');
		}
	}

	public function changePassword(){

		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}

		$this->form_validation->set_rules('password1','Password','required|trim|min_length[8]');
		$this->form_validation->set_rules('password2','Repeat Password','required|trim|matches[password1]');

		if($this->form_validation->run()==false){

		$data['active']='LOGIN';
		$data['nav']=$this->db->get('navbar')->result_array();
		$data['title']='Forgot Password ';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/changepassword');
		$this->load->view('templates/footer');
		}else{
			$password=password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email=$this->session->userdata('reset_email');

			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->db->delete('user_token', ['email'=>$email]);

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message','<div class="alert alert-light" role="alert">Password has been changed! Please login.</div>');
				redirect('auth');
		}
	}
}