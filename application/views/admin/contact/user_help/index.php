        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row">
            
            <div class="col-lg">

            <h5 class="mt-3 mb-3">Your Message</h5>

            <div class="col-4 col-sm-5">
            <?=$this->session->flashdata('message');?>
            </div>

            <table class="table table-hover">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Category</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          <?php foreach ($help as $hl) :?>
            <tr class="text-center" onClick="top.location.href='<?=base_url('admin/helpDetail/').$hl['id_help'];?>'">
              <th scope="row"><?= $i;?></th>
                <td><?=$hl['nama'];?></td>
                <td><?=$hl['email'];?></td>
                <td><?=$hl['kategori'];?></td>
                <td><?=$hl['waktu'];?></td>
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