<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row justify-content-center">
            	<div class="col-lg-7">
            		<p id="manage-lookbook-head"><?=$lookbook['nama'];?></p>
            		<p id="manage-lookbook-body"><?=$lookbook['date'];?></p>

                <p class="mt-3" id="manage-lookbook-body">Preview 1</p>
                <img class="img-fluid" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar1'];?>" style="width: 500px">
                <p class="mt-3" id="manage-lookbook-body">Preview 2</p>
                <img class="img-fluid" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar2'];?>" style="width: 500px">
                <p class="mt-3" id="manage-lookbook-body">Preview 3</p>
                <img class="img-fluid" src="<?= base_url()?>assets/img/lookbook/<?=$lookbook['gambar3'];?>" style="width: 500px">
                
                <div class="row pt-3">
                  <a class="btn btn-success mr-3" href="<?=base_url('admin/editLookbook/').$lookbook['id_lookbook'];?>">Edit</a>
                  <a class="btn btn-danger" href="<?=base_url('admin/deleteLookbook/').$lookbook['id_lookbook'];?>">Delete</a>
                </div>
            	</div>

            	<div class="col-lg-4">
            		<p id="manage-lookbook-head">Products</p>

                <ul class="list-group">
                    <?php foreach ($produk_lookbook as $pl):?>
                      <?php foreach ($produk as $pr):?>
                        <?php if($pr['nama_produk']==$pl['nama_produk_lookbook']):?>
                        <li class="list-group-item mb-1">
                        <div class="row justify-content-center">
                        <div class="col-sm-6">
                          <p class="pt-4" style="text-align: center"><?=$pr['nama_produk'];?></p>
                        </div>
                        <div class="col-sm-6">
                          <img class="img-fluid" src="<?= base_url()?>assets/img/produk/<?=$pr['gambar'];?>" class="mr-5 ml-5" style="width: 70px">
                        </div>
                      </div>
                      </li>
                    <?php endif;?>
                    <?php endforeach;?>
                    <?php endforeach;?>
              </ul>
            	</div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->