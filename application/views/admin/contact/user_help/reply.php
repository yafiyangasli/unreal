<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

        <form method="post" action="<?=base_url('admin/replyHelp/').$pesan['id_help'];?>">
        <div class="row">
        	<div class="col-lg-6">
        		<div class="form-group row">
				    <label for="email" class="col-sm-2 col-form-label">Email</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control-plaintext" id="email" name="email" value="<?=$pesan['email'];?>" readonly>
				    </div>
				  </div>
           		<div class="form-group row">
				    <label for="subjek" class="col-sm-2 col-form-label">Subject</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Enter subject here..">
				      <?=form_error('subjek','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="pesan" class="col-sm-2 col-form-label">Message</label>
				    <div class="col-sm-10">
				      <textarea class="form-control" id="pesan" name="pesan" placeholder="Enter message here.." rows="3"></textarea>
				      <?=form_error('pesan','<small class="text-danger pl-3">','</small>');?>
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