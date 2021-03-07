<div class="container">
	<h2 id="header-detail"><?=$produk['nama_produk'];?></h2>

	<div class="row justify-content-center">
		<div class="col-lg-6">
			<img name="gambar"  id="gambarDetail" src="<?php echo base_url();?>assets/img/produk/<?php echo $produk['gambar'];?>" data-zoom-image="<?php echo base_url();?>assets/img/produk/larger/<?php echo $produk['gambar'];?>">
		</div>
		<div class="col-lg-2">
			
		</div>
		<div class="col-lg-4">
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#gambarDetail').elevateZoom({
      zoomType: "inner",
      cursor: "crosshair",
      zoomWindowFadeIn: 500,
      zoomWindowFadeOut: 750
         }); 
</script>