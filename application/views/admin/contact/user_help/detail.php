        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

          <div class="row mx-auto mt-5">

          	<div class="col-md-5">
          		<h2 class="text-dark mb-1"><strong><?= $pesan['subject'];?></strong></h2>
              <h2 class="text-dark mb-1"><strong><?= $pesan['waktu'];?></strong></h2>
              <h5 class="text-dark mb-4">Sender : <?=$pesan['nama'];?> (<?=$pesan['email'];?>)</h5>
              <p><?=$pesan['pesan'];?></p>
              <div class="row mt-3">
                <div class="col-md-2">
                <a href="<?=base_url('admin/replyHelp/').$pesan['id_help'];?>" class="btn btn-success">Reply</a>
                </div>
                <div class="col-md-2">
                <a href="" class="btn btn-danger">Delete</a>
                </div>
              </div>
          	</div>            
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->