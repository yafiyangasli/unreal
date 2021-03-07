<div class="row no-gutters" id="regis">
  	<div class="col-md-5">
		<div class="img-wrapper">
	     <img class="img-fluid" src="<?=base_url('assets/img/auth/1.png')?>" style="width: 110%; height: 45rem;">
		</div> 
  	</div>
  	<div class="col-md-7 col-lg-5 p-3 pr-5">
  		<div class="container-fluid">
  		<h3 id="headRegis">Register</h3>
  		<p id="bawahHead">New Customers? Create your account, it takes less than a minute</p>

	  		<form class="p-auto" method="post" action="<?=base_url('auth/register')?>">
			  <div class="form-row pt-3">
			    <div class="form-group col-md-6">
			      <label for="username">Username</label>
			      <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>">
			      <?=form_error('username','<small class="text-danger pl-3">','</small>');?>
			    </div>
			    <div class="form-group col-md-6">
			      <label for="email">Email</label>
			      <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>">
			      <?=form_error('email','<small class="text-danger pl-3">','</small>');?>
			    </div>
			  </div>
			  <div class="form-row pt-3">
			    <div class="form-group col-md-6">
			      <label for="password1">Password</label>
			      <input type="password" class="form-control" id="password1" name="password1">
			      <?=form_error('password1','<small class="text-danger pl-3">','</small>');?>
			    </div>
			    <div class="form-group col-md-6">
			      <label for="password2">Re-Enter Password</label>
			      <input type="password" class="form-control" id="password2" name="password2">
			      <?=form_error('password2','<small class="text-danger pl-3">','</small>');?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="telephone">Contact Number</label>
			    <input type="text" class="form-control" id="telephone" name="telephone" value="<?=set_value('telephone')?>">
			    <?=form_error('telephone','<small class="text-danger pl-3">','</small>');?>
			  </div>
			  <div class="form-group">
			    <label for="address">Your Address</label>
			    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Not required now, it's need just for transaction process..."><?=set_value('address');?></textarea>
			  </div>
			  <div class="form-group">
			    <div class="form-check">
			    	<div class="row align-items-center">
			      		<input class="form-check-terms col-1 offset-1 offset-sm-2 col-sm-1" type="checkbox" id="terms" name="terms" onclick>
			    		<label class="form-check-label col col-sm" for="terms">
			        		I Accept terms and conditions & privacy policy
			      		</label>
			    	</div>
			    </div>
			      <?=form_error('terms','<small class="text-danger pl-3">','</small>');?>
			  </div>
			  <div class="row justify-content-center">
			  	<button type="submit" class="btn btn-dark">CREATE ACCOUNT</button>
			  </div>
			</form>
		</div>
  	</div> 	
</div>