<div class="row no-gutters">
  <div class="col-md">
  <div class="img-wrapper">
     <img class="img-fluid" src="<?=base_url('assets/img/header/').$header['gambar'];?>">
 </div>
 </div>
</div>

<div class="container">
	<div class="row justify-content-center mt-4">
		<h5>New Arrivals</h5>
	</div>
</div>

<div class="container">

  <div class="row">
  	<div class="col-12 col-sm-8 offset-sm-2 mb-5">
  		<div class="row justify-content-center">  		
  		<?php foreach($produk as $pr):?>
  		<div class="card m-3" style="width:11rem; border: none;">
		   <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none"><img class="card-img-top" src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" alt="Card image"></a>
		   <div class="card-body">
		     <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none"><h6 class="card-title"><?= $pr['nama_produk']?></h6></a>
		     <p class="card-text" style="font-size: 11px;"><?=rupiah($pr['harga'])?></p>
		   </div>
		</div>
		<?php endforeach;?>
		</div>
	</div>
	</div>
</div>