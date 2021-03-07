<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$title;?>UNREAL</title>
  <!-- Custom fonts for this template-->
  <link href="<?=base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.elevatezoom.js"></script>
  <script src="<?=base_url('assets/')?>fungsi.js"></script>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/style.css')?>">
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
<?php if ($active=='LOGIN'):?>
  <body onload=enable_password(false);>
  <?php else:?>
<body style="height: 100%;">
<?php endif;?>
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
