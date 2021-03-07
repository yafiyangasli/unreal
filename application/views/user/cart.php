<div class="row no-gutters mt-5">
	<div class="col-10 offset-1 offset-sm-1 col-sm-7 order-sm-1 col-md-7 order-md-1 pb-5">
		<h3 id="header-cart">Cart</h3>
		<div class="row">
			<div class="col-12 col-sm-4">
				<?= $this->session->flashdata('message');?>
			</div>
		</div>
		<hr>
		<ul class="list-unstyled">
		<?php foreach($cart as $ct):?>
			<?php foreach($produk as $pr):?>
				<?php if($ct['id_produk']==$pr['id']):?>
					  <li class="media pb-5">
					  	<a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none">
					    <img src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" alt="<?=$pr['nama_produk'];?>" style="max-width: 150px; min-width: 100px;" class="img-fluid order-sm-1 mr-2"></a>
					    <div class="media-body order-sm-2">
					    <div class="row no-gutters">
					    	<div class="col-12 col-md-5">
						      <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none"><h5 class="mt-0 mb-1"><?=$pr['nama_produk'];?></h5></a>
						      <p id="list-cart"><?=$ct['size'];?></p>
					    	</div>
					    	<div class="col-12 col-md-4">
								<p id="list-cart"><?=rupiah($ct['harga']);?></p>
					    	</div>
					    	<div class="col-12 col-md-3">
					    	<form method="post" action="<?=base_url('user/updateCart/').$ct['id_cart'];?>">
					    		<div class="row justify-content-center no-gutters">
					    		<div class="form-inline" style="padding-top: 0.5rem;">
							      	<select name="jumlah" id="jumlah" class="custom-select col-6 col-sm-6">
							      	<?php foreach ($sizestok as $ss):
										if($ss['id_produk']==$pr['id'] && $ss['size']==$ct['size']):
											$stokawal = $ss['stok'];
										endif;
									endforeach;?>
									<?php if ($stokawal >= $ct['jumlah']):?>
										<option value="<?= $ct['jumlah']?>"><?= $ct['jumlah']?></option>
									<?php elseif($stokawal > 0):?>
										<?php redirect('user/updateCartStokKurang/'.$ct['id_cart'].'/'.$stokawal);?>
									<?php elseif($stokawal <=0):?>
										<?php redirect('user/removeCart/'.$ct['id_cart']);?>
									<?php endif;?>
									<?php foreach ($sizestok as $ss):
										if($ss['id_produk']==$pr['id'] && $ss['size']==$ct['size']):
											$stok = $ss['stok'];
										endif;
									endforeach;
									for($i=1;$i<=$stok;$i++):
										if($i!=$ct['jumlah']):?>
										<option value="<?=$i;?>"><?=$i;?></option>
									<?php endif;	
									endfor;?>
									</select>									
									<button class="btn btn-light col-5 col-sm offset-1" value="Cart" style="font-family: Montserrat-regular; font-size: 10px; padding: 5px;">Update Cart</button>
					    		</div>
					    		</div>
					    		<div class="row justify-content-center pt-3 no-gutters">
					    			<a href="<?=base_url('user/removeCart/').$ct['id_cart'];?>" class="text-dark"><i class="far fa-fw fa-trash-alt pt-2"></i></a>
					    		</div>
					    	</form>
					    	</div>
					    </div>
					    </div>
					  </li>
				<?php endif;?>
			<?php endforeach;?>
		<?php endforeach;?>
		</ul>
		<hr>
		<div class="row justify-content-center no-gutters">
			<a href="<?=base_url('catalogue')?>" class="btn btn-light" style="font-family: Montserrat-regular;">Continue Shopping</a>
		</div>
	</div>
	<div class="col-sm-3 order-sm-2 offset-sm-1 col-md order-md-1 bg-light mt-5 mb-5">
		<div class="container-fluid">
			<h5 class="pt-5 pb-3">Order Summary</h5>
			<?php 
	          $totalPesan=0;
	          $totalCheckout=0;
	          $jumlahPesan=0;
	            foreach($cart as $ct):
	            $hargaAwal= $ct['harga'];
	            $jumlahPesan= $ct['jumlah'];
	            $totalPesan = $hargaAwal * $jumlahPesan;
	            $totalCheckout = $totalCheckout + $totalPesan;
	          endforeach;
	        ?>

	        <div class="row no-gutters">
			    <?php if($jumlahPesan!=NULL):?>
			    	<?php 
			    		$totalBarang=0;
			    		$totalBarangAkhir=0;
			    		foreach($cart as $ct):
			            $totalBarang= $ct['jumlah'];
			            $totalBarangAkhir = $totalBarangAkhir + $totalBarang;
			          endforeach;
			    	?>
	        		<div class="col-sm-5">
					<p id="order-summary-body"><?=$totalBarangAkhir;?> items</p>
					</div>
					<?php else:?>
					<div class="col-sm">
			        <p id="order-summary-body">There are no items in your cart</p>
					</div>
				<?php endif;?>
				<?php if($jumlahPesan!=NULL):?>
					<div class="col-sm-7">
					<p id="order-summary-body"><?=rupiah($totalCheckout);?></p>
					</div>
				<?php endif;?>
			</div>
			
			<?php if($jumlahPesan!=NULL):?>
			<div class="row justify-content-center mt-5 mb-5 no-gutters">
				<a href="<?=base_url('user/checkout');?>" class="btn btn-dark" style="font-family: Montserrat-regular;">Checkout</a>
			</div>
			<?php else:?>
				<div class="row justify-content-center mt-5 mb-5 no-gutters">
				<a href="<?=base_url('user/checkout');?>" style="font-family: Montserrat-regular;"></a>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
