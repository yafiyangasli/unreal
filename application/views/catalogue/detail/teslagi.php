<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$title;?>UNREAL</title>
	<meta name="description" content="A lightweight and dead simple lightbox script">

	<!-- Favicon  ========================================== -->
	<link rel="icon" href="favicon.ico">

	<link href="<?=base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- CSS ====================================================== -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/product.css');?>">
	<!-- Demo CSS (don't use) -->

	<style>
  
 @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Montserrat-bold'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/montserrat/');?>/Montserrat-Bold.otf');/*memanggil file font eksternalnya di folder montserrat*/

    }
 @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Montserrat-regular'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/montserrat/');?>/Montserrat-Regular.otf');/*memanggil file font eksternalnya di folder montserrat*/
    
    }
  @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Montserrat-extra-bold'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/montserrat/');?>/Montserrat-ExtraBold.otf');/*memanggil file font eksternalnya di folder montserrat*/
  }

  @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Montserrat-medium'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/montserrat/');?>/Montserrat-Medium.otf');/*memanggil file font eksternalnya di folder montserrat*/
    
    }

  @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Myriad-regular'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/myriad/');?>/MYRIADPRO-REGULAR.otf');/*memanggil file font eksternalnya di folder montserrat*/

    }

  @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Montserrat-semibold'; /*memberikan nama bebas untuk font*/
    src: url('<?=base_url('assets/font/montserrat/');?>/Montserrat-SemiBold.otf');/*memanggil file font eksternalnya di folder montserrat*/

    }

</style>
	
</head>

<body>
	
	<!-- navbar -->

	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white; padding-top: 20px; padding-bottom: 20px;">
    <a class="navbar-brand" href="#"><img src="<?=base_url('assets/logo/unreal.png');?>" style="width: 8rem;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 14px;">
      <ul class="navbar-nav mx-auto">
        <?php foreach($nav as $nv):?>
        <?php if($nv['nama_navbar'] == $active ):?>
          <?php if($nv['nama_navbar'] == 'ABOUT' ||$nv['nama_navbar'] == 'Cart'||$nv['nama_navbar'] == 'Saved Items'):?>
            <li class="nav-item active mr-2 ml-2" style="font-family: 'Montserrat-regular';">
            <?php if($nv['nama_navbar'] == 'Cart'||$nv['nama_navbar'] == 'Saved Items'):?>
              <li class="nav-item active mr-2 ml-2" style="font-family: 'Montserrat-regular'; font-size: 12px;">
            <?php endif?>
            <?php elseif($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')!=NULL):?>
              <li class="nav-item dropdown active mr-2 ml-2">
            <?php else:?>
              <li class="nav-item active mr-2 ml-2">
          <?php endif;?>
          <?php if($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')==NULL):?>
            <a class="nav-link" href="<?=base_url().$nv['link_navbar'];?>"><?=$nv['nama_navbar']?></a>
            <?php elseif($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')!=NULL):?>
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('username');?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?=base_url('user')?>">My Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?=base_url('auth/logout')?>">Logout</a>
              </div>
              <?php else:?>
              <a class="nav-link" href="<?=base_url().$nv['link_navbar'];?>"><?=$nv['nama_navbar']?></a>
            <?php endif;?>
            </li>
        <?php elseif ($nv['nama_navbar'] != $active ):?>
          <?php if($nv['nama_navbar'] == 'ABOUT' ||$nv['nama_navbar'] == 'Cart'||$nv['nama_navbar'] == 'Saved Items'):?>
            <li class="nav-item mr-1 ml-1" style="font-family: 'Montserrat-regular';">
            <?php if($nv['nama_navbar'] == 'Cart'||$nv['nama_navbar'] == 'Saved Items'):?>
              <li class="nav-item mr-1 ml-1" style="font-family: 'Montserrat-regular'; font-size: 12px;">
            <?php endif?>
            <?php elseif($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')!=NULL):?>
              <li class="nav-item dropdown mr-1 ml-1">
            <?php else:?>
              <li class="nav-item mr-1 ml-1">
          <?php endif;?>
          <?php if($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')==NULL):?>
            <a class="nav-link" href="<?=base_url().$nv['link_navbar'];?>"><?=$nv['nama_navbar']?></a>
            <?php elseif($nv['nama_navbar']=='LOGIN' && $this->session->userdata('username')!=NULL):?>
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('username');?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?=base_url('user')?>">My Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?=base_url('auth/logout')?>">Logout</a>
              </div>
              <?php else:?>
              <a class="nav-link" href="<?=base_url().$nv['link_navbar'];?>"><?=$nv['nama_navbar']?></a>
            <?php endif;?>
        </li>
        <?php endif;?>
        <?php endforeach;?>
      <form class="form-inline ml-2 mr-3 my-lg-0" name="barSearch" action="" method="post">
        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text bg-white pl-2" style="border-right: 0px;"><i class="fas fa-fw fa-search"></i></span>
        </div>
        <input class="form-control form-control-md" name="search" id="search" type="search" placeholder="Click here to search..." aria-label="Search" style="border-left: 0px;">
        </div>
      </form>
      </ul>
  </div>

  </nav>
  <div class="border-top border-dark" style="opacity: 20%"></div>

  <!-- end of navbar -->
  	<div class="layout">

  	<div class="pname">
        <div class="row-justify-center">
            <h1 class="pb-3"><?=$dproduk['nama_produk']?></h1>
        </div>
    </div>

    <form method="post" action="<?=base_url('user/addToCart/').$dproduk['id'];?>">
    	<div class="row no-gutters">

    		<div class="col-6 offset-sm-1 offset-md-1 col-sm-5 col-md-5 d-none d-sm-block">
				<div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
				<div class="sp-wrap">
					<a href="<?php echo base_url();?>assets/img/produk/<?php echo $dproduk['gambarlarger'];?>"><img src="<?php echo base_url();?>assets/img/produk/<?php echo $dproduk['gambar'];?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
				</div>
			</div>
			<div class="col-10 offset-sm-1 offset-md-1 col-sm-5 col-md-5 d-block d-sm-none">
            <div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
				<div class="sp-wrap">
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
					<a href="<?=base_url('assets/img/produk/plainlarger.png');?>"><img src="<?=base_url('assets/img/produk/plain.png');?>" alt=""></a>
				</div>
        	</div>

        	<div class="col-12 col-sm-6 col-md offset-md-1">
            <div class="row no-gutters mt-3 mb-4">
                <div class="detail col-12 col-sm-8 text-sm">
                        <?= $this->session->flashdata('message');?>
                    </div>
                <div class="detail col-8 offset-1 col-sm-5 offset-sm-0 col-md-5 mb-3 align-self-center">
                    <h3> <?=rupiah($dproduk['harga'])?></h3>
                </div>
                <?php if($this->session->userdata('username')!=NULL):?>
                <?php if($liked==NULL):?>
                    <div class="detail col-11 offset-1 col-sm-4">
                        <a href="<?=base_url('user/addfav/').$dproduk['id'];?>" class="btn btn-outline-dark"><span><i class="fa fa-fw fa-heart"></i> Add to Wishlist</span></a>
                    </div>
                <?php else:?>
                    <div class="detail col-11 offset-1 col-sm-4">
                        <a href="<?=base_url('user/addfav/').$dproduk['id'];?>" class="btn btn-outline-dark"><span><i class="fa fa-fw fa-times"></i> Remove from Wishlist</span></a>
                    </div>
                <?php endif;?>
                <?php else:?>
                    <div class="detail col-11 offset-1 col-sm-4">
                        <a href="<?=base_url('user/addfav/').$dproduk['id'];?>" class="btn btn-outline-dark"><span><i class="fa fa-fw fa-heart"></i> Add to Wishlist</span></a>
                    </div>
            <?php endif;?>
            </div>
            <div class="row no-gutters col-10">
                <div class="detail col-5 col-sm-3 col-md-3">
                    <div class="form-group">
                        <h4><label for="size">Size</label></h4>
                            <select class="custom-select" name="size" id="size" onChange="getStok()">
                                <option></option>
                                <?php foreach($sizestok as $ss):?>
                                    <?php if($ss['stok']>0):?>
                                    <option value="<?=$ss['size'];?>"><?=$ss['size'];?></option>
                                <?php endif;?>
                                <?php endforeach;?>
                            </select>
                    </div>
                </div>
                <div class="detail col-6 offset-1 col-sm-3 col-md-3 offset-sm-1 offset-md-2">
                    <div class="form-group">
                        <h4><label for="qty">Quantity</label></h4>
                        <select class="custom-select" name="jumlah" id="jumlah">
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="detail col-12 col-sm-10 col-md-10">
                <h4 class="mt-2">Description</h4>
                <p class="mt-1"><?=$dproduk['deskripsi']?></p>
            </div>
            <div class="detail col-12 col-sm-8 col-md-8 row-justify-center mt-4">
                <button class="cart-button" type="submit">Add to Cart</button>
            </div>
        </div>

		</div>
	</form>
		
	</div>
	<!-- JS ======================================================= -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery-2.1.3.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/smoothproducts.min.js');?>"></script>
	<script type="text/javascript">
	/* wait for images to load */
	$(window).load(function() {
		$('.sp-wrap').smoothproducts();
	});

	function getStok(){
        let size = $('#size').val();
        let id_produk = <?= $dproduk['id']?>;

        $.ajax({
            url: '<?= base_url('catalogue/get_stok/')?>'+`${id_produk}/${size}`,
            dataType: 'json',

            success: function(response){
                var html = '';
                var i;
                for (var i =0; i<response.length; i++) {
                    var a = response[i].stok;
                    for (var j = 1; j<=a ; j++) {
                        html+= '<option value="'+j+'">'+j+'</option>'
                    }
                }
                $('#jumlah').html(html);
            }
        });
    }
	</script>


<div id="needHelp">
  <div class="row bg-black justify-content-center no-gutters">
      <p>Need Help? <a href="<?=base_url('help');?>">click here!</a></p>
  </div>
</div>

 <!-- Footer -->

      <footer class="footer bg-dark text-white pr-5 pl-5 pt-4 pb-1">
        <div class="row mb-3">
          <div class="col-md-4">
            <h5 style="font-family: Montserrat-extra-bold; font-size: 16px">UNREAL CLUBS</h5>
            <p class="text-secondary" style="font-family: Montserrat-regular; font-size: 16px;">Jl. KH. Ahmad Dahlan No.34, Pahoman, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35228</p>
          </div>
          <div class="col-md-4">
            <h5 class="mt-1 pb-1" style="font-family: Montserrat-regular; font-size: 10px;">SUBSCRIBE & GET UPDATES ON <strong>SPECIAL PROMOTION</strong></h5>
            <form method="post" action="<?= base_url('home/newsletter');?>">
            <input class="mb-5" name="newsletter" id="newsletter" type="email" placeholder="Enter your email address here..." style="font-size: 12px; width: 17rem; height: 2.2rem; font-family: Montserrat-regular; text-align: left; border: 0px;">
            </form>
          </div>
          <div class="col-6 col-md-2">
            <h5 style="font-size: 16px">ABOUT</h5>
            <ul class="text-secondary pl-0" style="font-family: Montserrat-regular; font-size: 12px; list-style-type: none;">
              <li><a href="<?=base_url('about')?>" class="text-secondary text-decoration-none">About us</a></li>
              <li><a href="<?=base_url('about')?>" class="text-secondary text-decoration-none">Terms & Conditions</a></li>
              <li>Return Policy</li>
              <li>Shipping & Handling</li>
            </ul>
          </div>
          <div class="col-6 col-md-2">
            <h5 style="font-family: Montserrat-regular; font-size: 16px;">Connect with us!</h5>
            <ul class="list-group list-group-horizontal" style="list-style-type: none;">
              <li class="pr-3"><a href="#WA" id="WA" class="text-decoration-none" data-toggle="tooltip" data-html="true" title="Whatsapp us at<br><strong>085808580858</strong>"><img src="<?=base_url('assets/logo/wa.png')?>" style="width: 30px;"></a></li>
              <li class="pr-3"><a href="https://www.instagram.com/unrealclubs/" target="https://www.instagram.com/unrealclubs/" class="text-decoration-none"><img src="<?=base_url('assets/logo/ig.png')?>" style="width: 30px;"></a></li>
              <li class="pr-3 "><a href="https://www.tokopedia.com/unrealclubs?source=universe&st=product" class="text-decoration-none" target="https://www.tokopedia.com/unrealclubs?source=universe&st=product"><img src="<?=base_url('assets/logo/tokped.png')?>" style="width: 30px;"></a></li>
            </ul>
          </div>
        </div>
        <div class="row no-gutters">
        <div class="col-12">
          <hr style="border-width: 2px; border-color: black; opacity: 50%;">
          <p style="text-align: center;">Website by <a href="http://teratics.tech/" target="http://teratics.tech/"><img src="<?=base_url('assets/logo/teratics.png');?>" style="max-height: 20px;"></a></p>
        </div>
        </div>
      </footer>
      <!-- end of footer -->
  
<!-- Bootstrap core JavaScript-->
  
  <script src="<?=base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->

</body>
</html>