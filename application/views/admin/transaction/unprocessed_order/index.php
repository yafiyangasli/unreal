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
			      <th scope="col">Proof ID</th>
			      <th scope="col">Purchase ID</th>
			      <th scope="col">Username</th>
			      <th scope="col">Total</th>
			      <th scope="col">Transfer Date</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1;?>
			  	<?php foreach ($bukti as $bk) :?>
			    <tr class="text-center" onClick="top.location.href='<?=base_url('admin/detailTrans/').$bk['id_bukti'];?>'">
			      <th scope="row"><?= $i;?></th>
			      <td><?= $bk['id_bukti'];?></td>
			      <td><?= $bk['id_checkout'];?></td>
			      <td><?= $bk['username'];?></td>
			      <td><?=rupiah($bk['total']);?></td>
			      <td><?= $bk['tanggal_trans'];?></td>
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