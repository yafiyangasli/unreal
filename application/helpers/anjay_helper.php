<?php

function rupiah($angka){
	
	$hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
	return $hasil_rupiah;

}

function check_jenis($id_jenis){
	$ci=get_instance();

	$ci->db->where('id_jenis',$id_jenis);
	$result=$ci->db->get('jenis');

	if($result->num_rows()>0){
		return "checked='checked'";
	}
}


function checked_access($id_lookbook,$nama_produk_lookbook){
		$ci=get_instance();

		$result=$ci->db->get_where('produk_lookbook',[
			'id_lookbook'=>$id_lookbook,
			'nama_produk_lookbook'=>$nama_produk_lookbook
		]);

		if($result->num_rows()>0){
			return "checked='checked'";
		}
	}

function is_logged_in(){
	$ci=get_instance();
	if(!$ci->session->userdata('username')){
		$ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please, login first.</div>');
		redirect('auth');
	}else{
		$role_id=$ci->session->userdata('role_id');
		$menu= $ci->uri->segment(1);

		$queryMenu=$ci->db->get_where('user_menu',['menu'=>$menu])->row_array();
		$menu_id=$queryMenu['id'];

		$userAccess=$ci->db->get_where('user_access_menu',[
			'role_id'=>$role_id,
			'menu_id'=>$menu_id
		]);

		if($userAccess->num_rows()<1){
			redirect('auth/errors');
		}
	}
}

function is_maintenance(){
	$ci=get_instance();
	if(!$ci->session->userdata('username')){
		redirect('home/maintenance');
	}else{
		$role_id=$ci->session->userdata('role_id');
		$menu= $ci->uri->segment(1);

		$queryMenu=$ci->db->get_where('user_menu',['menu'=>$menu])->row_array();
		$menu_id=$queryMenu['id'];

		$userAccess=$ci->db->get_where('user_access_menu',[
			'role_id'=>$role_id,
			'menu_id'=>$menu_id
		]);

		if($userAccess->num_rows()<1){
			redirect('home/maintenance');
		}
	}
}