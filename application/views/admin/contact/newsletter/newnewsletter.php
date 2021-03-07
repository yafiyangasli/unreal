<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

        <form method="post" action="<?=base_url('admin/newNewsletter');?>" enctype="multipart/form-data">
        <div class="row">
        	<div class="col-lg-6">
           		<div class="form-group row">
				    <label for="subjek" class="col-sm-2 col-form-label">Subject</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Enter subject here..">
				      <?=form_error('subjek','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="image" class="col-sm-2 col-form-label">Photo</label>
				    <div class="col-sm-10">            
					    <div class="custom-file">
					        <input type="file" class="custom-file-input" id="image" name="image">
					        <label class="custom-file-label" for="image">Choose File</label>
					    </div>
					</div>
				  </div>
				  <div class="form-group justify-content-end">
				  <button class="btn btn-dark" type="submit">Send</button>
				  </div>
           	</div>
        </div>
        </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->