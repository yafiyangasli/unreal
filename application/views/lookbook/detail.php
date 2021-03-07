<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/catalogue.css');?>"media="all"/>
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="transition: 5s;">
  <div class="carousel-inner" style="max-height: 470px">
    <div class="carousel-item active" >
      <img class="d-block w-100" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar1'];?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar2'];?>" alt="Second slide">
    </div>
    <div class="carousel-item" >
      <img class="d-block w-100" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar3'];?>" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- end of carousel -->

<div class="container mt-4 mb-5">
  <div id="lookbook-main-body">
  <h3 class="text-center">Lookbook</h3>
  <p id="judul"><?= $lookbook['nama'];?></p>
  <p class="text-center"><?= $lookbook['date'];?></p>
  </div>
</div>

<div class="container mb-5">
  <h3>Products</h3>
  <hr>
  <div class="row justify-content-center">
    <div class="col-10 col-sm-10">
      <div class="row justify-content-center mt-3">
      <?php $a=1;?>
      <?php foreach ($produk_lookbook as $pl):?>
        <?php foreach ($produk as $pr):?>
          <?php $stokkosong=0;
          $stokakhir=0;?>
          <?php foreach ($sizestok as $ss):
            if($ss['id_produk']==$pr['id']):
              $stokawal = $ss['stok'];
              $stokakhir = $stokakhir + $stokawal;
            endif;
          endforeach;?>
          <?php if($pr['nama_produk']==$pl['nama_produk_lookbook']):?>
            <?php if($stokakhir > 0):?>
      <div class="card m-3 mr-5" style="width:13rem; border: none;">
    <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none">
       <img class="card-img-top" src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" alt="Card image">
    </a>
       <div class="card-body">
        <div class="row">
          <div class="col-9 col-lg-9">
            <a href="<?=base_url('catalogue/detailProduk/').$pr['id'];?>" class="text-dark text-decoration-none">
            <h6 class="card-title"><?= $pr['nama_produk']?></h6>
            </a>
          </div>
          <div class="col col-lg-3">
            <div id="liked<?=$a;?>">
            <?php if($this->session->userdata('username')!=NULL):?>
            <?php $i=0;?>
            <?php foreach($liked as $lk):?>
              <?php if($lk['id_produk']==$pr['id']):?>
              <?php $i++;?>
              <?php endif;?>
            <?php endforeach;?>
            <?php if($i==1):?>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="yes" class="fas fa-fw fa-heart" style="color: #F2B8D8;"></i></span>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="no2" class="fas fa-fw fa-heart"></i></span>
            <?php else:?>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="no" class="fas fa-fw fa-heart"></i></span>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="yes2" class="fas fa-fw fa-heart" style="color: #F2B8D8;"></i></span>
            <?php endif;?>
            <?php else:?>
            <span class="liked-button" data-liked="<?=$pr['id'];?>"><i id="no" class="fas fa-fw fa-heart"></i></span>
            <?php endif;?>
            </div>
          </div>
        </div>
         <p class="card-text" style="font-size: 11px;"><?=rupiah($pr['harga'])?></p>
       </div>
    </div>
    <?php else:?>
    <div class="card m-3 mr-5" style="width:13rem; border: none;">
    <div id="img-outofstock">
       <img class="card-img-top" id="img-card-catalogue" src="<?php echo base_url();?>assets/img/produk/<?php echo $pr['gambar'];?>" alt="Card image">
       <div class="centered text-secondary">Out of Stock</div>
    </div>
       <div class="card-body">
        <div class="row">
          <div class="col-9 col-lg-9">
            <h6 class="card-title"><?= $pr['nama_produk']?></h6>
          </div>
          <div class="col col-lg-3">
            <div id="liked<?=$a;?>">
            <?php if($this->session->userdata('username')!=NULL):?>
            <?php $i=0;?>
            <?php foreach($liked as $lk):?>
              <?php if($lk['id_produk']==$pr['id']):?>
              <?php $i++;?>
              <?php endif;?>
            <?php endforeach;?>
            <?php if($i==1):?>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="yes" class="fas fa-fw fa-heart" style="color: #F2B8D8;"></i></span>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="no2" class="fas fa-fw fa-heart"></i></span>
            <?php else:?>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="no" class="fas fa-fw fa-heart"></i></span>
              <span class="liked-button"  data-liked="<?=$pr['id'];?>"><i id="yes2" class="fas fa-fw fa-heart" style="color: #F2B8D8;"></i></span>
            <?php endif;?>
            <?php else:?>
            <span class="liked-button" data-liked="<?=$pr['id'];?>"><i id="no" class="fas fa-fw fa-heart"></i></span>
            <?php endif;?>
            </div>
          </div>
        </div>
         <p class="card-text" style="font-size: 11px;"><?=rupiah($pr['harga'])?></p>
       </div>
    </div>
    <?php endif;?>
          <?php endif;?>
        <?php endforeach;?>
        <?php $a=$a+1;?>
      <?php endforeach;?>
      </div>
    </div>
  </div>
</div>