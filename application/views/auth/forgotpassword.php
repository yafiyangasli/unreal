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
			<form class="pt-2 pb-4 pl-4 pr-4" method="post" action="<?=base_url('auth/forgotpassword');?>">
			  <div class="form-group">
			  	<div class="row justify-content-center">
			  	<div class="col-12 col-sm-12">
			  		<?= $this->session->flashdata('message');?>
				    <label class="offset-sm-2" for="id" style="font-family: 'Montserrat-regular'; font-size: 25px;">Email</label>
				    <input type="text" class="form-control col-sm-8 offset-sm-2" id="email" name="email" placeholder="Enter your email...">
				    <?=form_error('email','<small class="text-danger pl-3">','</small>');?>
			  	</div>
			  	</div>
			  </div>

				<button type="submit" class="btn btn-dark col-10 offset-1 col-sm-6 offset-sm-3">Reset Password</button>

			</form>

			<div class="col-lg" style="padding-top: 5rem; padding-bottom: 1rem;">
					<div class="row justify-content-center">
					<a href="<?=base_url('auth');?>" class="text-dark" style="text-align: center; text-decoration: none;"><i class="fas fa-fw fa-arrow-left"></i> Back to Login</a>
					</div>
				</div>

		</div>
	</div>
</div>

<div class="d-none d-xl-block" style="height: 250px;">
  <p style="height: 100%; display: block;"></p>
</div>