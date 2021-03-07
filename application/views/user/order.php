<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/user.css');?>"media="all"/>
<div class="row no-gutters bg-light">
	<div class="col-12 col-sm-3">
		<div class="row justify-content-center no-gutters" style="background-color: #E6E7E8;">
			<h3 id="title-user" class="p-2">My Account</h3>
		</div>
		<div class="row no-gutters" style="background-color: white;">
			<div class="container-fluid pt-3 pb-3">
				<ul class="list-group">
				  <a href="<?=base_url('user')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-12 col-sm-2">
				  			<img src="<?=base_url('assets/logo/mydetail.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-12 col-sm-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Detail</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/order')?>" class="list-profile-side-active"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-sm-2">
				  			<img src="<?=base_url('assets/logo/myorder.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-sm-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Orders</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/favorites')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-12 col-sm-2">
				  			<img src="<?=base_url('assets/logo/myfavorites.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-12 col-sm-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Favorites</p>
				  		</div>
				  	</div>
				  </li></a>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-8 pt-5 pb-5 pr-4 pl-4">
		<div class="container" style="border-style: solid; border-width: 1.5px; background-color: white;">
			<h3 class="pt-2" id="my-detail">MY ORDER</h3>
			<hr class="pt-0 mt-0" style="border-color: black; border-width: 1.7px;">
			<div class="row justify-content-center">
				<div class="col-12 col-sm-8 text-center">
					<?= $this->session->flashdata('message');?>
				</div>
			</div>
			<?php foreach ($checkout as $ck):?>
				<div class="media p-2">
				  <div class="media-body">
					    <h5 class="mt-0" id="media-top"><?= $ck['waktu'];?></h5>
				  	<div class="row">
					<?php if($ck['is_upload']==0):?>
				  	<div class="col-12 col-sm-9">
					    <p id="media-content"><?=rupiah($ck['total']);?></p>
					    <p id="media-content">Please confirm your transaction before <?=$ck['deadline'];?></p>
					</div>
					<div class="col-12 col-sm-3">
						<a href="<?=base_url('user/transaction_form/').$ck['id_checkout'];?>" class="btn btn-light">Confirm now</a>
					</div>
					<?php elseif($ck['is_upload']==1):?>
					<div class="col-12 col-sm">
						<p id="media-content"><?=rupiah($ck['total']);?></p>
						<?php if($ck['no_resi']==NULL):?>
						<p id="media-content">Please wait untill your transaction is processed, check kindly for receipt number</p>
						<?php else:?>
						<p id="media-content">Thank you for shopping in our website, this is your receipt number <?= $ck['no_resi'];?></p>
						<?php endif;?>
					</div>
					<?php elseif($ck['is_upload']==2):?>
					<div class="col-12 col-sm">
						<p id="media-content"><?=rupiah($ck['total']);?></p>
					    <p id="media-content">Proof of transfer that you sent is wrong, please contact admin to confirm payment</p>
					</div>
					<?php endif;?>
					</div>
				  </div>
				</div>
				<hr>
			<?php endforeach;?>
		</div>
	</div>
</div>