<div class="container-fluid">
	<div class="row justify-content-center p-5">
		<div class="col-12 col-sm-4 p-0" style="border-style: solid; border-width: 1.5px; background-color: white">
			<h3 id="header-login">WELCOME</h3>
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
			<form class="pt-2 pb-4 pl-4 pr-4" method="post" action="">
			  <div class="form-group">
			  	<div class="row justify-content-center">
			  	<div class="col-12 col-lg-8">
			  		<?= $this->session->flashdata('message');?>
				    <label for="id" style="font-family: 'Montserrat-regular'; font-size: 25px;">ID</label>
				    <input type="text" class="form-control" id="id" name="id" placeholder="Enter your username or email...">
				    <?=form_error('id','<small class="text-danger pl-3">','</small>');?>
			  	</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row justify-content-center">
			  	<div class="col-12 col-lg-8">
				    <label for="password" style="font-family: 'Montserrat-regular'; font-size: 25px;">Password</label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password...">
				    <?=form_error('password','<small class="text-danger pl-3">','</small>');?>
			  	</div>
			  	</div>
			  </div>
				  <div class="row justify-content-center pr-3 pl-3 pb-4">
				  	<div class="col col-lg-4">
				  		<button type="submit" class="btn btn-dark">Login</button>
				  	</div>
				  	<div class="col-lg-5">
				  		<a href="<?=base_url('auth/forgotpassword');?>" class="text-dark" style="font-size: 12px; text-decoration: none;">Forgot password?</a>
				  	</div>
				  </div>
			</form>
			
				<div class="col-lg" style="padding-top: 5rem; padding-bottom: 1rem;">
					<div class="row justify-content-center">
					<a href="<?=base_url('auth/register');?>" class="text-dark" style="text-align: center; text-decoration: none;">Create Your Account <i class="fas fa-fw fa-arrow-right"></i></a>
					</div>
				</div>
		</div>
	</div>
</div>
