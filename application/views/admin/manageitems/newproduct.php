        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>


         
         <div class="row">

        	<div class="col-lg-5">
              <?php if(validation_errors()):?>
                <div class="col-lg">
                <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
                </div>
                </div>
             <?php endif;?>
             <?= $this->session->flashdata('message');?>
            </div>
           </div>
          <div class="row">
            
            <div class="col-lg">

            <table class="table table-hover">
			  <thead class="thead-dark">
			    <tr class="text-center">
			      <th scope="col">#</th>
			      <th scope="col">Product</th>
			      <th scope="col">Type</th>
			      <th scope="col">Price</th>
			      <th scope="col">Image</th>
			      <!-- <th scope="col">Stock</th> -->
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1;?>
			  	<?php foreach ($produk as $pr) :?>
			    <tr class="text-center" onClick="top.location.href='<?=base_url('admin/detailProduk/').$pr['id'];?>'">
			      <th scope="row"><?= $i;?></th>
			      <td><?= $pr['nama_produk'];?></td>
			      <td><?= $pr['jenis'];?></td>
			      <td><?=rupiah($pr['harga']);?></td>
			      <td><img src="<?= base_url()?>assets/img/produk/<?=$pr['gambar'];?>" class="mr-5 ml-5" style="width: 150px"></td>
			      <!-- <td><?= $pr['stok'];?></td> -->
			      <td>
					<a href="<?= base_url('admin/hapusFromNewProduk/').$pr['id'];?>" class="badge badge-danger">Delete from New Product</a>
			      </td>
			    </tr>
			    <?php $i++;?>
				<?php endforeach?>
			  </tbody>
			</table>
      <?= $this->pagination->create_links();?>
			</div>
		</div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->