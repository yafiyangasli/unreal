        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row">

            	<div class="col-lg-8">
            		
            		<?= form_open_multipart('admin/doEditHeader/'.$header['tempat']);?>

				  <div class="form-group">
				    <label for="produk" class="col-sm-2 col-form-label">Header For</label>
				    <div class="col-sm-10">
				      <h3><?=$header['tempat'];?></h3>
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-2">
				    	Header
				    </div>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-sm-3">
				    		<img src="<?= base_url('assets/img/header/').$header['gambar'];?>" class="img-thumbnail"> 
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