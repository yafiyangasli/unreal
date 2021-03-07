<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row">
          		<div class="col-md-4">
          			<?= $this->session->flashdata('message');?>
          		</div>
          	</div>


            <div class="row">
            	<div class="col-md">
            		<a href="<?=base_url('admin/addLookbook');?>" class="btn btn-dark">Add new lookbook</a>

            		<table class="table table-hover mt-5 mb-5">
					  <thead class="thead-dark">
					    <tr class="text-center">
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Date</th>
					    </tr>
					  </thead>
			  <tbody>
			  	<?php $i=1;?>
			  	<?php foreach ($lookbook as $lb) :?>
			    <tr class="text-center" onClick="top.location.href='<?=base_url('admin/manageLookbookDetail/').$lb['id_lookbook'];?>'">
			      <th scope="row"><?= $i;?></th>
			      <td><?= $lb['nama'];?></td>
			      <td><?= $lb['date'];?></td>
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