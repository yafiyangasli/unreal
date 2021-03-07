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
<body>

<div class="container mt-5">

  <div class="row justify-content-center no-gutters">
    <div class="col-8 col-sm-6 mt-5">
      <h1 id="header-maintenance">COOMING SOON</h1>
    </div>
  </div>

  <div class="row justify-content-center no-gutters">
    <div class="col-8 col-sm-4 align-self-center">
      <img src="<?=base_url('assets/logo/unreal.png');?>" class="img-fluid mt-5">
    </div>
  </div>
</div>

  <script src="<?=base_url('assets/');?>js/jquery-3.3.1.js"></script>
<!-- Bootstrap core JavaScript-->
  
  <script src="<?=base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url('assets/');?>js/jquery.elevatezoom.js"></script>
  <script src="<?=base_url('assets/');?>js/sb-admin-2.min.js"></script>

  <script>

    $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();   
    });

    $(document).ready(function(){
      $(".btn-primary:first").click(function(){
        $(this).button('toggle');
      });   
    });
  </script>
</body>
</html>