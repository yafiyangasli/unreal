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
        	

            <a href="" class="btn btn-dark" data-toggle="modal" data-target="#newProductModal">Input New Header</a>

            <h5 class="mt-3 mb-3">Your Product</h5>

            <table class="table table-hover">
			  <thead class="thead-dark">
			    <tr class="text-center">
			      <th scope="col">#</th>
			      <th scope="col">Place</th>
			      <th scope="col">Image</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1;?>
			  	<?php foreach ($header as $hr) :?>
			    <tr class="text-center">
			      <th scope="row"><?= $i;?></th>
			      <td><?= $hr['tempat'];?></td>
			      <td><img src="<?= base_url()?>assets/img/header/<?=$hr['gambar'];?>" class="mr-5 ml-5" style="width: 150px"></td>
			      <td>
					<a href="<?=base_url('admin/editHeader/').$hr['tempat'];?>" class="badge badge-success">Edit</a>
					<a href="<?=base_url('admin/deleteHeader/').$hr['tempat'];?>" class="badge badge-danger">Delete</a>
			      </td>
			    </tr>
			    <?php $i++;?>
				<?php endforeach?>
			  </tbody>
			</table>
			</div>
		</div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      	<!-- Modal -->
<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add new product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/manageheader');?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
		  <div class="form-group">
            <select id="tempat" name="tempat" class="form-control">
              <option value="">Header place...</option>
              <option value="Home">Home</option>
              <option value="Lookbook">Lookbook</option>
              <option value="Catalogue">Catalogue</option>
              <option value="About">About</option>
            </select>
        </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Choose File</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

