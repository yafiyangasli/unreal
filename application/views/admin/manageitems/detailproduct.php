        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

          <div class="row mx-auto mt-5">
          	<div class="col-md-5">
          		<img name="gambar"  id="gambar" src="<?php echo base_url();?>assets/img/produk/<?php echo $produk['gambar'];?>" style="width: 275px"> 
              <br><br><a class="btn btn-success" href="<?=base_url('admin/editGambar1/').$produk['id'];?>">Edit Image 1</a><br><br>
              <?php if($produk['gambarlarger2'] && $produk['gambar2'] != NULL):?>
                <img name="gambar2"  id="gambar2" src="<?php echo base_url();?>assets/img/produk/<?php echo $produk['gambar2'];?>" style="width: 275px">
              <br><br><a class="btn btn-success mr-3" href="<?=base_url('admin/editGambar2/').$produk['id'];?>">Edit Image 2</a><a class="btn btn-danger mr-3" href="<?=base_url('admin/deleteGambar2/').$produk['id'];?>">Delete Image 2</a><br><br>
              <?php else:?>
                <img name="gambar2"  id="gambar2" src="<?php echo base_url();?>assets/img/produk/plain.png" style="width: 275px">
                <br><br><a class="btn btn-success mr-3" href="<?=base_url('admin/editGambar2/').$produk['id'];?>">Edit Image 2</a> <a class="btn btn-danger" href="<?=base_url('admin/deleteGambar2/').$produk['id'];?>">Delete Image 2</a><br><br>
              <?php endif;
              if($produk['gambarlarger3'] && $produk['gambar3'] != NULL):?>
              <img name="gambar3"  id="gambar3" src="<?php echo base_url();?>assets/img/produk/<?php echo $produk['gambar3'];?>" style="width: 275px">
              <br><br><a class="btn btn-success mr-3" href="<?=base_url('admin/editGambar3/').$produk['id'];?>">Edit Image 3</a><a class="btn btn-danger" href="<?=base_url('admin/deleteGambar3/').$produk['id'];?>">Delete Image 3</a><br><br>
              <?php else:?>
                <img name="gambar3"  id="gambar3" src="<?php echo base_url();?>assets/img/produk/plain.png" style="width: 275px">
                <br><br><a class="btn btn-success mr-3" href="<?=base_url('admin/editGambar3/').$produk['id'];?>">Edit Image 3</a><a class="btn btn-danger" href="<?=base_url('admin/deleteGambar3/').$produk['id'];?>">Delete Image 3</a><br><br>
              <?php endif;?>

          	</div>

          	<div class="col-md-5">
          		<h2 class="text-dark"><strong><?= $produk['nama_produk'];?></strong></h2>
          		<h5><?=$produk['jenis']?></h5>
          		<div class="row">
          		<div class="col-sm-4">
          		<p><?=rupiah($produk['harga']);?></p>
          		</div>
          		<div class="col-sm-6">
              <select class="form-control">
                <option>Size - Stock</option>
          		<?php foreach($sizestok as $ss):?>
                <option><?=$ss['size']?> - <?=$ss['stok']?></option>
              <?php endforeach;?>
          		</select>
              </div>
          		</div>
          		<br>
          		<h3 class="text-dark">Description</h3>
          		<p><?=$produk['deskripsi'];?></p>
              <?php if($produk['is_new']==0):?>
          <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8">
              <a href="<?=base_url('admin/addNewProduk/').$produk['id'];?>" class="btn btn-secondary">Add to New Product</a>
            </div>
          </div>
        <?php endif;?>
          	</div>
          	
          </div>
          
            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->