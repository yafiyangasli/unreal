
<div class="row no-gutters bg-light">
	<div class="col-md-3">
		<div class="row justify-content-center no-gutters" style="background-color: #E6E7E8;">
			<h3 id="title-user" class="p-2">My Account</h3>
		</div>
		<div class="row no-gutters" style="background-color: white;">
			<div class="container-fluid pt-3 pb-3">
				<ul class="list-group">
				  <a href="<?=base_url('user')?>" class="list-profile-side-active"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-md-2">
				  			<img src="<?=base_url('assets/logo/mydetail.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-md-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Detail</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/order')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-md-2">
				  			<img src="<?=base_url('assets/logo/myorder.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-md-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Orders</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/favorites')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-md-2">
				  			<img src="<?=base_url('assets/logo/myfavorites.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-md-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Favorites</p>
				  		</div>
				  	</div>
				  </li></a>
				</ul>
			</div>
		</div>
	</div>



	<div class="col-md-8 pt-5 pb-5 pr-4 pl-4">
		<div class="container-fluid" style="border-style: solid; border-width: 1.5px; background-color: white;">
			<h3 class="pt-2" id="my-detail">MY DETAIL</h3>
			<hr class="pt-0 mt-0" style="border-color: black; border-width: 1.7px;">
			<div class="container-fluid pb-5">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-8 text-center">
						<?= $this->session->flashdata('message');?>
					</div>
				</div>
				<div class="col-lg-10">
					<form class="form-profile" name="formDetailUser" method="post" action="<?=base_url('user/editProfile');?>">
					  <div class="form-group row">
					    <label for="name" class="col-lg-2 col-form-label">Name</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control-plaintext text-secondary" readonly id="name" name=name value="<?=$user['name']?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="username" class="col-lg-2 col-form-label">Username</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control-plaintext text-secondary" readonly id="username" name="username" value="<?=$user['username']?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="email" class="col-lg-2 col-form-label">Email</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control-plaintext text-secondary" readonly id="email" name="email" value="<?=$user['email']?>">
					    </div>
					    </div>
					  <div class="form-group row">
					    <label for="phone" class="col-lg-2 col-form-label">Phone</label>
					    <div class="col-lg-8">
					      <input type="text" class="form-control-plaintext text-secondary" readonly id="phone" name="phone" value="<?=$user['telephone']?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="address" class="col-lg-2 col-form-label">Address</label>
					    <div class="col-lg-8">
					    	<textarea class="form-control-plaintext text-secondary" readonly id="address" name="address" rows="3"><?=$user['address']?></textarea>
					  	</div>
					  </div>
					  <div class="form-group row justify-content-center">
					  	<div class="col-lg">
					  		<div class="row justify-content-center">
					  			<a href="<?=base_url('user/edit');?>" class="btn btn-dark">EDIT</a>
					  		</div>
					  	</div>
					  </div>
					</form>
				</div>
			</div>
			<p class="p-5" style="text-align: center; font-family: Montserrat-regular;">Manage your profile information to control, protect and secure accounts</p>
		</div>
	</div>
</div>