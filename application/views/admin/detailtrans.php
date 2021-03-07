        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

          <div class="col-12 col-sm-4">
            <?= $this->session->flashdata('message');?>
          </div>

          <div class="row mx-auto mt-5">
          	<div class="col-md-5">
          		<img name="gambar"  id="gambar" src="<?= base_url('assets/img/buktitrans/').$bukti['bukti_trans'];?>" style="width: 275px">
          	</div>

          	<div class="col-md-5">
          		<h2 class="text-dark mb-5"><strong><?= $bukti['id_bukti'];?></strong></h2>
          		<div class="row mb-4">
                <div class="col-md-5">
                  <h5><?=$bukti['username']?></h5>
                </div>
                <div class="col-md-6">
                  <h5><?=$bukti['tanggal_trans']?></h5>
          		  </div>
              </div>
          		<p><?=rupiah($bukti['total']);?></p>
          		<p><?=$bukti['nama_akun'];?></p>
              <div class="row">
                <div class="col-md-2">
                  <p><?=$bukti['bank'];?></p>
          		  </div>
                <div class="col-md-3">
                  <p><?=$bukti['nomor_akun']?></p>
                </div>
              </div>
              <?php if ($bukti['is_processed']==0):?>
              <a href="<?= base_url('admin/confirmPayment/').$bukti['id_bukti'];?>" class="btn btn-dark">Confirm Payment</a>
              <a href="<?= base_url('admin/cancelPayment/').$bukti['id_bukti'];?>" class="btn btn-danger ml-3">Cancel Payment</a>
              <?php elseif ($bukti['is_processed']==1):?>
              <form method="post" action="<?= base_url('admin/confirmProcessingOrder/').$bukti['id_bukti'];?>">
                <div class="row justify-content-center mb-4">
                <input class="form-control col-sm-8" type="text" name="resi" id="resi" placeholder="Input receipt number here">
                </div>
                <div class="row justify-content-center">
                <button class="btn btn-dark" type="submit">Order Processed</button>
                </div>
              </form>
              <?php elseif ($bukti['is_processed']==2):?>
                <a href="<?= base_url('admin/confirmPayment/').$bukti['id_bukti'];?>" class="btn btn-dark">Confirm Payment</a>
                <a href="<?= base_url('admin/deletePayment/').$bukti['id_bukti'];?>" class="btn btn-danger ml-3">Delete</a>
            <?php endif;?>
          	</div>            

          </div>

          <div class="col-lg">

            <h5 class="mx-auto mt-5">Checkout Detail</h5>

            <table class="table">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">Name</th>
            <th scope="col">Address & Telephone</th>
            <th scope="col">Province</th>
            <th scope="col">City</th>
            <th scope="col">Ongkir</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center">
            <td><?=$checkout['nama'];?></td>
            <td><?=$checkout['address'];?></td>
            <td id="provinsi"> </td>
            <td id="city"> </td>
            <td><?=rupiah($checkout['ongkir']);?></td>
          </tr>
        </tbody>
      </table>
      </div>

          <div class="col-lg">

            <h5 class="mx-auto mt-5">Order Detail</h5>

            <table class="table table-hover">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col">Size</th>
            <th scope="col">Image</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          <?php foreach ($orderan as $or) :?>
          <?php foreach($produk as $pr):?>
          <?php if($or['id_produk']==$pr['id']):?>
          <tr class="text-center" onClick="top.location.href='<?=base_url('admin/detailProduk/').$pr['id'];?>'">
            <th scope="row"><?= $i;?></th>
            <td><?=$pr['nama_produk'];?></td>
            <td><?=rupiah($pr['harga']);?></td>
            <td><?=$or['jumlah'];?></td>
            <td><?=$or['size'];?></td>
            <td><img src="<?= base_url()?>assets/img/produk/<?=$pr['gambar'];?>" class="mr-5 ml-5" style="width: 150px"></td>
          </tr>
          <?php $i++;?>
        <?php endif;?>
        <?php endforeach?>
        <?php endforeach?>
        </tbody>
      </table>
      </div>
    </div>
    </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->