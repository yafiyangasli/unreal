<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset='utf-8'>

<head>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<!-- META ===================================================== -->
	<title>Smooth Products Demo</title>
	<meta name="description" content="A lightweight and dead simple lightbox script">

	<!-- Favicon  ========================================== -->
	<link rel="icon" href="favicon.ico">

	<!-- CSS ====================================================== -->
	<link rel="stylesheet" href="<?=base_url('assets/css/smoothproducts.css');?>">
	<!-- Demo CSS (don't use) -->

</head>

<body>
	<br>
		<div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
		<div class="sp-wrap">
			<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
			<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
			<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
			<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
		</div>
	<br>
	<!-- JS ======================================================= -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery-2.1.3.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/smoothproducts.min.js');?>"></script>
	<script type="text/javascript">
	/* wait for images to load */
	$(window).load(function() {
		$('.sp-wrap').smoothproducts();
	});
	</script>

</body>

</html>
