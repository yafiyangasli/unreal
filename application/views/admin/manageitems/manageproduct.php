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
        	

            <a href="" class="btn btn-dark" data-toggle="modal" data-target="#newProductModal">Input New Product</a>

            <h5 class="mt-3 mb-3">Your Product</h5>

            <table class="table table-hover">
			  <thead class="thead-dark">
			    <tr class="text-center">
			      <th scope="col">#</th>
			      <th scope="col">Product</th>
			      <th scope="col">Type</th>
			      <th scope="col">Price</th>
			      <th scope="col">Image</th>
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
			      <td>
					<a href="<?=base_url('admin/editProduk/').$pr['id'];?>" class="badge badge-success">Edit</a>
					<a href="<?=base_url('admin/hapusProduk/').$pr['id'];?>" class="badge badge-danger">Delete</a>
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
      <form action="<?= base_url('admin/manageproduct');?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      	<div class="form-group">
		    <input type="text" class="form-control" name="id_produk" id="id_produk" placeholder="Product id..">
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="produk" id="produk" placeholder="Product name..">
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="harga" id="harga" placeholder="Product price.. (ex: 1000)">
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="stokS" id="stokS" placeholder="Product stock size S..">
		  </div>
      <div class="form-group">
        <input type="text" class="form-control" name="stokM" id="stokM" placeholder="Product stock size M..">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="stokL" id="stokL" placeholder="Product stock size L..">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="stokXL" id="stokXL" placeholder="Product stock size XL..">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="berat" id="berat" placeholder="Product weight in Kg.. (ex: 0.25)">
      </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Choose Image</label>
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="imagelarger" name="imagelarger">
            <label class="custom-file-label" for="image">Choose Imager Larger</label>
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image2" name="image2">
            <label class="custom-file-label" for="image">Choose Image 2</label>
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="imagelarger2" name="imagelarger2">
            <label class="custom-file-label" for="image">Choose Imager 2 Larger</label>
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image3" name="image3">
            <label class="custom-file-label" for="image">Choose Image 3</label>
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="imagelarger3" name="imagelarger3">
            <label class="custom-file-label" for="image">Choose Imager 3 Larger</label>
          </div>
		  <div class="form-group">
		    <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Product description.." rows="3"></textarea>
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

<script type="text/javascript">

  function getSize(){
    var clothes = [
      {"value":"S", "option":"S"},
      {"value":"M", "option":"M"},
      {"value":"L", "option":"L"},
      {"value":"XL", "option":"XL"}
    ];

    var pants = [
      {"value":"30", "option":"30"},
      {"value":"31", "option":"31"},
      {"value":"32", "option":"32"},
      {"value":"33", "option":"33"}
    ];

    var floapers = [
      {"value":"37", "option":"37"},
      {"value":"38", "option":"38"},
      {"value":"39", "option":"39"},
      {"value":"40", "option":"40"},
      {"value":"41", "option":"41"},
      {"value":"42", "option":"42"},
      {"value":"43", "option":"43"}
    ];

    var shoes = [
      {"value":"37", "option":"37"},
      {"value":"38", "option":"38"},
      {"value":"39", "option":"39"},
      {"value":"40", "option":"40"},
      {"value":"41", "option":"41"},
      {"value":"42", "option":"42"},
      {"value":"43", "option":"43"}
    ];

    var jenis = document.getElementById('jenis').value;
    var size = document.getElementById('size');
    var sizelength = document.getElementById('size').length;

    if (jenis=="Clothes") {
      for(var j=0; j<sizelength;j++){
        size.remove(size.option);
      }
      for(var i=0; i<clothes.length;i++){
        size.innerHTML = size.innerHTML + '<option value="' + clothes[i]['value'] + '">' + clothes[i]['option'] + '</option>';
      }
      }else if(jenis=="Pants"){
        for(var j=0; j<sizelength;j++){
        size.remove(size.option);
        }
        for(var i=0; i<pants.length;i++){
        size.innerHTML = size.innerHTML + '<option value="' + pants[i]['value'] + '">' + pants[i]['option'] + '</option>';
      }
      }else if(jenis=="Shoes"){
        for(var j=0; j<sizelength;j++){
        size.remove(size.option);
        }
        for(var i=0; i<shoes.length;i++){
        size.innerHTML = size.innerHTML + '<option value="' + shoes[i]['value'] + '">' + shoes[i]['option'] + '</option>';
      }
      }else if(jenis=="Floapers"){
        for(var j=0; j<sizelength;j++){
        size.remove(size.option);
        }
        for(var i=0; i<floapers.length;i++){
        size.innerHTML = size.innerHTML + '<option value="' + floapers[i]['value'] + '">' + floapers[i]['option'] + '</option>';
      }
      }
  }
</script>

