<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>
         <?= form_open_multipart('admin/editLookbook/'.$lookbook['id_lookbook']);?>
          <div class="row">
           <div class="col-lg-6">
          <?= $this->session->flashdata('message');?>
           			<div class="col-sm-6">
           			<div class="form-group">
           				<label for="nama" class="col-form-label text-dark">Lookbook Name</label>
		    			<input type="text" class="form-control" name="lookbook_nama" id="lookbook_nama" placeholder="Lookbook name.." value="<?=$lookbook['nama'];?>">
		    			<?=form_error('lookbook_nama','<small class="text-danger pl-3">','</small>');?>
		  			</div>
		  			<div class="form-group">
		  				<label for="tanggal" class="col-form-label text-dark">Input Date</label>
		    			<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?=$waktu;?>" value="<?=$lookbook['date']?>">
		    			<?=form_error('tanggal','<small class="text-danger pl-3">','</small>');?>
		  			</div>
		  			</div>
		  			<div class="col-sm-10">
		  			<div class="form-group">
		  				<label for="image1" class="col-form-label text-dark">Image 1 Preview</label>
		  				<div class="row">
					    <div class="col-sm-10">
					    	<div class="row">
					    		<div class="col-sm-3">
					    		<img src="<?= base_url('assets/img/lookbook/').$lookbook['gambar1'];?>" class="img-thumbnail"> 
					    		</div>
					    		<div class="col-sm-9">
					    			<div class="custom-file">
									  <input type="file" class="custom-file-input" id="image1" name="image1">
									  <label class="custom-file-label" for="image1">Choose File</label>
									</div>
					    		</div>
					    	</div>
					    </div>
					    </div>
					    </div>
				    	<div class="form-group">
		  				<label for="image2" class="col-form-label text-dark">Image 2 Preview</label>
		  				<div class="row">
					    <div class="col-sm-10">
					    	<div class="row">
					    		<div class="col-sm-3">
					    		<img src="<?= base_url('assets/img/lookbook/').$lookbook['gambar2'];?>" class="img-thumbnail"> 
					    		</div>
					    		<div class="col-sm-9">
					    			<div class="custom-file">
									  <input type="file" class="custom-file-input" id="image2" name="image2">
									  <label class="custom-file-label" for="image2">Choose File</label>
									</div>
					    		</div>
					    	</div>
					    </div>
					    </div>
					    </div>
				        <div class="form-group">
		  				<label for="image3" class="col-form-label text-dark">Image 3 Preview</label>
		  				<div class="row">
					    <div class="col-sm-10">
					    	<div class="row">
					    		<div class="col-sm-3">
					    		<img src="<?= base_url('assets/img/lookbook/').$lookbook['gambar3'];?>" class="img-thumbnail"> 
					    		</div>
					    		<div class="col-sm-9">
					    			<div class="custom-file">
									  <input type="file" class="custom-file-input" id="image3" name="image3">
									  <label class="custom-file-label" for="image3">Choose File</label>
									</div>
					    		</div>
					    	</div>
					    </div>
					    </div>
					    </div>
		  			</div>
		  			<div class="form-group">
		  				<button class="btn btn-dark" type="submit" value="submit">Submit</button>
		  			</div>
           </div>
           <div class="col-lg-5">
           	<h3>Input Product</h3>
           	<ul class="list-group">
           	<?php $a=1;?>
           	<?php foreach ($produk as $pr):?>
			  <li class="list-group-item mb-1">
           		<div class="row justify-content-center">
           			<div class="form-group form-check">
					    <input type="checkbox" class="form-check-input mt-4" id="checkbox" name="checkbox<?=$a?>" value="<?= $pr['nama_produk'];?>" <?=checked_access($lookbook['id_lookbook'],$pr['nama_produk']);?>>
					  </div>
           			<div class="col-sm-6">
           				<p class="pt-4" style="text-align: center"><?=$pr['nama_produk'];?></p>
           			</div>
           			<div class="col-sm-4">
           				<img class="img-fluid" src="<?= base_url()?>assets/img/produk/<?=$pr['gambar'];?>" class="mr-5 ml-5" style="width: 70px">
           			</div>
           		</div>
           		</li>
           		<?php $a++;?>
           	<?php endforeach;?>
			</ul>
           </div>
          </div>
         </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      