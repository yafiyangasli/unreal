<div class="container-fluid">
	<div class="row justify-content-center p-5">
		<div class="col-12 col-sm-4 p-0" style="border-style: solid; border-width: 1.5px; background-color: white">
			<h3 id="header-login">FORGOT PASSWORD</h3>
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<hr size="5px" width="100%" style="border-color: black;">
				</div>
				<div class="col-lg-2">
					<img class="img-fluid" src="<?=base_url('assets/logo/profile.png');?>" style="width: 6rem; display: block; margin:auto;">
				</div>
				<div class="col-lg-5">
					<hr style="border-color: black;">
				</div>
			</div>
			<form class="pt-2 pb-4 pl-4 pr-4" method="post" action="<?=base_url('auth/changepassword');?>">
			  <div class="form-group">
			  	<div class="row justify-content-center">
			  	<div class="col-12 col-sm-12">
			  		<?= $this->session->flashdata('message');?>
			  		<label class="offset-sm-2" for="password" style="font-family: 'Montserrat-regular'; font-size: 15px;">Change your password for</label>
				    <label class="offset-sm-2 text-center" for="password" style="font-family: 'Montserrat-regular'; font-size: 20px;"><?= $this->session->userdata('reset_email');?></label>
				    <input type="password" class="form-control col-sm-8 offset-sm-2" id="password1" name="password1" placeholder="Enter new password...">
				    <?=form_error('password1','<small class="text-danger pl-3">','</small>');?>

				    <input type="password" class="form-control col-sm-8 offset-sm-2 mt-3" id="password2" name="password2" placeholder="Repeat password...">
				    <?=form_error('password2','<small class="text-danger pl-3">','</small>');?>
			  	</div>
			  	</div>
			  </div>

				<button type="submit" class="btn btn-dark col-10 offset-1 col-sm-6 offset-sm-3">Change Password</button>

			</form>
		</div>
	</div>
</div>

<div class="d-none d-sm-none d-md-none d-lg-block" style="height: 200px;">
  <p style="height: 100%; display: block;"></p>
</div>