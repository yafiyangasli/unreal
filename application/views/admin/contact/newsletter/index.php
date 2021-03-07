<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row">
            
            <div class="col-lg">
        	

            <a href="<?=base_url('admin/newNewsletter');?>" class="btn btn-dark">Make Newsletter</a>

            <table class="table table-hover mt-5">
			  <thead class="thead-dark">
			    <tr class="text-center">
			      <th scope="col">#</th>
			      <th scope="col">Email</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1;?>
			  	<?php foreach ($newsletter as $nl) :?>
			    <tr class="text-center">
			      <th scope="row"><?= $i;?></th>
			      <td><?= $nl['email'];?></td>
			      <td>
					<a href="<?=base_url('admin/deleteEmailNewsletter/').$nl['id_newsletter'];?>" class="badge badge-danger">Delete</a>
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