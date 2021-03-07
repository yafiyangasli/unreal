<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/favorites.css');?>"media="all"/>

<div class="row no-gutters bg-light">
	<div class="col-md-3">
		<div class="row justify-content-center no-gutters" style="background-color: #E6E7E8;">
			<h3 id="title-user" class="p-2">My Account</h3>
		</div>
		<div class="row no-gutters" style="background-color: white;">
			<div class="container-fluid pt-3 pb-3">
				<ul class="list-group">
				  <a href="<?=base_url('user')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-lg-2">
				  			<img src="<?=base_url('assets/logo/mydetail.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-lg-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Detail</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/order')?>" class="list-profile-side"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-lg-2">
				  			<img src="<?=base_url('assets/logo/myorder.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-lg-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Orders</p>
				  		</div>
				  	</div>
				  </li></a>
				  <a href="<?=base_url('user/favorites')?>" class="list-profile-side-active"><li class="list-group-item" style="border-width: 0px;">
				  	<div class="row">
				  		<div class="col-lg-2">
				  			<img src="<?=base_url('assets/logo/myfavorites.png');?>" style="width: 3rem;">
				  		</div>
				  		<div class="col-lg-10">
				  			<p class="text-dark" style="text-align: left; font-size: 25px;">My Favorites</p>
				  		</div>
				  	</div>
				  </li></a>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-8 col-md-8 pt-5 pb-5 pr-4 pl-4">
		
		<div class="container-fluid" style="border-style: solid; border-width: 1.5px; background-color: white;">
			<h3 class="pt-2" id="my-detail">MY FAVORITES PRODUCTS</h3>
			<hr class="pt-0 mt-0" style="border-color: black; border-width: 1.7px;">
			<div class="pb-5">
					<div class="row align-content-center">
					<?php $a=1;?>
					<?php foreach($liked as $lk):?>
					<form method="post" action="<?=base_url('user/addToCart/').$lk['id_produk'];?>">
						<?php foreach($produk as $pr):?>
							<?php if($lk['id_produk']==$pr['id']):?>
								<div class="row justify-content-center">
								<div class="col-10 col-md-11">
								<?php $stokkosong=0;
									$stokakhir=0;?>
								<?php foreach ($sizestok as $ss):
									if($ss['id_produk']==$pr['id']):
										$stokawal = $ss['stok'];
										$stokakhir = $stokakhir + $stokawal;
									endif;
								endforeach;
								if($stokakhir > 0):?>
								<div class="card my-3 mx-1 p-3" style="max-width: 400px;">
								  <div class="row no-gutters">
								    <div class="col-lg-4 pt-auto">
								   <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none">
								      <img src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" class="card-img pt-3" alt="<?= $pr['nama_produk'];?>">
								  </a>
								    </div>
								    <div class="col-12 col-lg-8">
								      <div class="card-body">
								      	<a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none">
								        <h5 class="card-title" id="title-card-fav"><?= $pr['nama_produk'];?></h5>
								        </a>
								        <p class="card-text" style="font-size: 17px;"><?=rupiah($pr['harga'])?></p>
								        <div class="row justify-content-start" style="font-family: Montserrat-regular;">
							        <div class="col-lg-5 pt-3">
									  <p class="card-text" for="size">Size</p>
									</div>
									<div class="col-lg-6">
									<select name="size" id="size<?=$a;?>" class="custom-select my-1 mr-sm-2" onChange="getStok<?=$a?>(<?=$lk['id_produk']?>)" >
										<option></option>
									  <?php foreach ($sizestok as $ss):
										if($ss['id_produk']==$pr['id']&& $ss['stok']>0) :?>
											<option value="<?=$ss['size'];?>"><?=$ss['size'];?></option>
										<?php endif;
									endforeach;?>
									</select>
									</div>
									</div>

									

									<div class="row justify-content-start" style="font-family: Montserrat-regular;">
									<div class="col-lg-5 pt-3">
									  <p class="card-text" for="size">Jumlah</p>
									</div>
									<div class="col-lg-6">
									<select name="jumlah" id="jumlah<?=$a;?>" class="custom-select">
									
									</select>
									</div>
									</div>
								      </div>
								    </div>
								  </div>
								</div>
								<div class="row justify-content-end no-gutters pb-4">
									<div class="col-6 col-sm-4">
									<a href="<?=base_url('user/deletefav/').$lk['id_produk'];?>" class="btn btn-light mx-1 p-1" style="font-family: Montserrat-regular;"><i class="far fa-fw fa-trash-alt"></i> Remove</a>
									</div>
									<div class="col-6 col-sm-5">
									<button class="btn btn-light mx-1 p-1" value="Cart" style="font-family: Montserrat-regular;"><i class="fas fa-fw fa-cart-plus"></i> Add to cart</button>
									</div>
								</div>
								<?php else:?>
									<div class="card my-3 mx-1 p-3" style="max-width: 400px;">
								  <div class="row no-gutters">
								    <div class="col-lg-4 pt-auto">
								    <div id="img-outofstock">
								      <img src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" class="card-img pt-3" id="img-fav" alt="<?= $pr['nama_produk'];?>">
								      <div class="centered text-secondary">Out of Stock</div>
								    </div>
								    </div>
								    <div class="col-12 col-lg-8">
								      <div class="card-body">
								        <h5 class="card-title" id="title-card-fav"><?= $pr['nama_produk'];?></h5>
								        <p class="card-text" style="font-size: 17px;"><?=rupiah($pr['harga'])?></p>
								        <div class="row justify-content-start" style="font-family: Montserrat-regular;">
							        <div class="col-lg-5 pt-3">
									  <p class="card-text" for="size">Size</p>
									</div>
									<div class="col-lg-6">
									<select name="size" id="size<?=$a;?>" class="custom-select my-1 mr-sm-2" onChange="getStok<?=$a?>(<?=$lk['id_produk']?>)" disabled>
										<option></option>
									  <?php foreach ($sizestok as $ss):
										if($ss['id_produk']==$pr['id']&& $ss['stok']>0) :?>
											<option value="<?=$ss['size'];?>"><?=$ss['size'];?></option>
										<?php endif;
									endforeach;?>
									</select>
									</div>
									</div>

									

									<div class="row justify-content-start" style="font-family: Montserrat-regular;">
									<div class="col-lg-5 pt-3">
									  <p class="card-text" for="size">Jumlah</p>
									</div>
									<div class="col-lg-6">
									<select name="jumlah" id="jumlah<?=$a;?>" class="custom-select" disabled>
									
									</select>
									</div>
									</div>
								      </div>
								    </div>
								  </div>
								</div>
								<div class="row justify-content-end no-gutters pb-4">
									<div class="col-6 col-sm-4">
									<a href="<?=base_url('user/deletefav/').$lk['id_produk'];?>" class="btn btn-light mx-1 p-1" style="font-family: Montserrat-regular;"><i class="far fa-fw fa-trash-alt"></i> Remove</a>
									</div>
									<div class="col-6 col-sm-5">
									<button class="btn btn-light mx-1 p-1" value="Cart" style="font-family: Montserrat-regular;" disabled><i class="fas fa-fw fa-cart-plus"></i> Add to cart</button>
									</div>
								</div>
								<?php endif;?>
								</div>
								</div>
								<?php $a++;?>
							<?php endif;?>
						<?php endforeach;?>
					</form>
					<?php endforeach;?>
					</div>
			</div>
		</div>
	</div>
</div>

<?php $b=1;?>
<script type="text/javascript">
<?php foreach($liked as $lk):?>
	function getStok<?=$b;?>(){
										
		let size<?=$b;?> = $('#size<?=$b;?>').val();
		let id_produk<?=$b;?> = <?=$lk['id_produk'];?>;

			$.ajax({
				url: '<?= base_url('user/get_stok/')?>'+`${id_produk<?=$b;?>}/${size<?=$b;?>}`,
				dataType: 'json',


				success: function(response<?=$b;?>){
					var html<?=$b;?> = '';
					var i<?=$b;?>;
					console.log(response<?=$b;?>);
					for (var i<?=$b;?> =0; i<?=$b;?><response<?=$b;?>.length; i<?=$b;?>++) {
						var a<?=$b;?> = response<?=$b;?>[i<?=$b;?>].stok;
						for (var j<?=$b;?> = 1; j<?=$b;?><=a<?=$b;?> ; j<?=$b;?>++) {
							html<?=$b;?>+= '<option value="'+j<?=$b;?>+'">'+j<?=$b;?>+'</option>'
						}
					}
					$('#jumlah<?=$b;?>').html(html<?=$b;?>);
				}
			});
		}
		<?php $b++;?>
<?php endforeach?>
		
	</script>