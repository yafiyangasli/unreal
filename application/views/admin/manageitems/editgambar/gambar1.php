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

            	<div class="col-lg-8">
            		
            		<?= form_open_multipart('admin/doEditGambar1/'.$produk['id']);?>

				  <div class="form-group">
				    <div class="col-sm-2">
				    	Gambar 1
				    </div>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-sm-3">
				    		<img src="<?= base_url('assets/img/produk/').$produk['gambar'];?>" class="img-thumbnail"> 
				    		</div>
				    		<div class="col-sm-9">
				    			<div class="custom-file">
								  <input type="file" class="custom-file-input" id="image" name="image">
								  <label class="custom-file-label" for="image">Choose File</label>
								</div>
				    		</div>
				    	</div>
				    </div>
				    </div>

				    <div class="form-group">
				    <div class="col-sm-2">
				    	Gambar 1 Larger
				    </div>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-sm-3">
				    		<img src="<?= base_url('assets/img/produk/').$produk['gambarlarger'];?>" class="img-thumbnail"> 
				    		</div>
				    		<div class="col-sm-9">
				    			<div class="custom-file">
								  <input type="file" class="custom-file-input" id="imagelarger" name="imagelarger">
								  <label class="custom-file-label" for="imagelarger">Choose File</label>
								</div>
				    		</div>
				    	</div>
				    </div>
				    </div>

				    <div class="form group">
				    	<div class="col-sm-10">
				    		<button type="submit" class="btn btn-dark">Edit</button>
				    	</div>
				    </div>

            		</form>

            	</div>
            	

            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->