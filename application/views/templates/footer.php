

<div id="needHelp">
  <div class="row bg-black justify-content-center no-gutters">
      <p>Need Help? <a href="<?=base_url('help');?>">click here!</a></p>
  </div>
</div>

<!-- Newsletter modal -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="container">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
            <img src="<?=base_url('assets/logo/unreal.png');?>" class="img-fluid p-2" style="width: 8rem;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body col-12 mt-4">
          <p id="modal-body-header">SUBSCRIBE & GET UPDATES ON SPECIAL PROMOTION</p>
          <form class="pt-2" method="post" action="<?= base_url('home/newsletter');?>">
            <div class="input-group justify-content-center mb-5">
              <input class="form-input col-8 col-md-7" type="email" name="newsletter" id="newsletter" placeholder="Input your email here..." style="font-size: 12px;" required>
              <div class="input-group-prepend">
              <button type="submit" class="btn btn-outline-secondary btn-sm">Subscribe</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="container">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
            <img src="<?=base_url('assets/logo/unreal.png');?>" class="img-fluid p-2" style="width: 8rem;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body mt-4">
          <p id="modal-body-header">SUBSCRIBE & GET UPDATES ON SPECIAL PROMOTION</p>
          <p id="modal-body-header" style="font-size: 12px;">Thanks for subscribing</p>
        </div>
      </div>
      </div>
      
    </div>
  </div>
<!-- end of newsletter modal -->
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

    <?php if($active == 'NEW PRODUCT' && $this->session->userdata('username')==NULL && $this->session->userdata('newsletter')==NULL):?>
     $("#myModal").modal("show");
     <?php elseif($active == 'NEW PRODUCT' && $this->session->userdata('username')==NULL && $this->session->userdata('newsletter')!=NULL):?>
      $("#myModal2").modal("show");
      <?php $this->session->unset_userdata('newsletter');?>
   <?php endif;?>

      function uploadModal(){
        $("#myModal2").modal("show");
      }

    $(document).ready(function(){
      $(".btn-primary:first").click(function(){
        $(this).button('toggle');
      });   
    });

    $('.liked-button').on('click', function(){
      const likedId = $(this).data('liked');
      $.ajax({    
        url: "<?=base_url('catalogue/likedproduct');?>",
        type: 'post',
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          likedId: likedId
        },
        success:function(){
          <?php if($this->session->userdata('username')==NULL):?>
          document.location.href="<?= base_url('auth'); ?>";
          <?php endif;?>
        }
      });
    });


    $('.liked-buttonClothes').on('click', function(){
      const likedId = $(this).data('liked');
      $.ajax({    
        url: "<?=base_url('catalogue/likedproduct');?>",
        type: 'post',
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          likedId: likedId
        },
        success:function(){
          <?php if($this->session->userdata('username')==NULL):?>
          document.location.href="<?= base_url('auth'); ?>";
          <?php endif;?>
        }
      });
    });

    $('.liked-buttonPants').on('click', function(){
      const likedId = $(this).data('liked');
      $.ajax({    
        url: "<?=base_url('catalogue/likedproduct');?>",
        type: 'post',
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          likedId: likedId
        },
        success:function(){
          <?php if($this->session->userdata('username')==NULL):?>
          document.location.href="<?= base_url('auth'); ?>";
          <?php endif;?>
        }
      });
    });

    $('.liked-buttonFloapers').on('click', function(){
      const likedId = $(this).data('liked');
      $.ajax({    
        url: "<?=base_url('catalogue/likedproduct');?>",
        type: 'post',
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          likedId: likedId
        },
        success:function(){
          <?php if($this->session->userdata('username')==NULL):?>
          document.location.href="<?= base_url('auth'); ?>";
          <?php endif;?>
        }
      });
    });

    $('.liked-buttonShoes').on('click', function(){
      const likedId = $(this).data('liked');
      $.ajax({    
        url: "<?=base_url('catalogue/likedproduct');?>",
        type: 'post',
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          likedId: likedId
        },
        success:function(){
          <?php if($this->session->userdata('username')==NULL):?>
          document.location.href="<?= base_url('auth'); ?>";
          <?php endif;?>
        }
      });
    });

    <?php if($active == 'CATALOGUE' || $active == 'LOOKBOOK'):?>
    <?php for ($b=1; $b<=$jumlah_produk ; $b++):?>
      $('.form-check-input').on('click', function(){
      const jenisId = $(this).data('jenis');

      $.ajax({
        data: {
          // menuId 1 = objek data
          // menuId 2 = variabel
          jenisId: jenisId,
        },
        success:function(){
          document.location.href="<?= base_url('catalogue/'); ?>"+ jenisId;
        }
      });
    });
      
    $(document).ready(function(){
        $('#liked<?=$b;?> #no').on('click',function(){
          $('#liked<?=$b;?> #no').fadeOut(1);
          $('#liked<?=$b;?> #yes2').fadeIn(1);

        });
        $('#liked<?=$b;?> #yes').on('click',function(){
          $('#liked<?=$b;?> #yes').fadeOut(1);
          $('#liked<?=$b;?> #no2').fadeIn(1);
        });

        $('#liked<?=$b;?> #yes2').on('click',function(){
          $('#liked<?=$b;?> #yes2').fadeOut(1);
          $('#liked<?=$b;?> #no').fadeIn(1);
        });

        $('#liked<?=$b;?> #no2').on('click',function(){
          $('#liked<?=$b;?> #no2').fadeOut(1);
          $('#liked<?=$b;?> #yes').fadeIn(1);

        });
    });
  <?php endfor;?>
<?php endif;?>

     

    
  </script>
</body>
</html>