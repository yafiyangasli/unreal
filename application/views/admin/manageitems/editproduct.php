        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

            <div class="row">

            	<div class="col-lg-8">
            		
            		<?= form_open_multipart('admin/editProduk/'.$produk['id']);?>
            			
            		<div class="form-group row">
				    <label for="id_produk" class="col-sm-2 col-form-label">Product ID</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?=$produk['id'];?>">
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="produk" class="col-sm-2 col-form-label">Product Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="produk" name="produk" value="<?= $produk['nama_produk'];?>">
				      <?=form_error('produk','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="harga" class="col-sm-2 col-form-label">Price</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="harga" name="harga" value="<?= $produk['harga'];?>">
				      <?=form_error('harga','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				    <div class="form-group row">
				    <label for="jumlah" class="col-sm-2 col-form-label">Stock S</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="stokS" name="stokS" value="<?= $sizestokS['stok'];?>">
				      <?=form_error('stokS','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="jumlah" class="col-sm-2 col-form-label">Stock M</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="stokM" name="stokM" value="<?= $sizestokM['stok'];?>">
				      <?=form_error('stokM','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="jumlah" class="col-sm-2 col-form-label">Stock L</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="stokL" name="stokL" value="<?= $sizestokL['stok'];?>">
				      <?=form_error('stok','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="jumlah" class="col-sm-2 col-form-label">Stock XL</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="stokXL" name="stokXL" value="<?= $sizestokXL['stok'];?>">
				      <?=form_error('stok','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="berat" class="col-sm-2 col-form-label">Weight</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="berat" name="berat" value="<?= $produk['berat'];?>">
				      <?=form_error('berat','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="deskripsi" class="col-sm-2 col-form-label">Description</label>
				    <div class="col-sm-10">
				      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $produk['deskripsi'];?></textarea>
				      <?=form_error('deskripsi','<small class="text-danger pl-3">','</small>');?>
				    </div>
				  </div>

				    <div class="form group row justify-content-end">
				    	<div class="col-sm-10">
				    		<button type="submit" class="btn btn-primary">Edit</button>
				    	</div>
				    </div>

            		</form>

            	</div>
            	

            </div>
<!-- <script type="text/javascript">
      	function getStok(){
        let size = $('#size').val();
        let id_produk = <?= $produk['id']?>;

        $.ajax({
            url: '<?= base_url('admin/get_stok/')?>'+`${id_produk}/${size}`,
            dataType: 'json',

            success: function(response){
                var html = '';
                var i;
                for (var i =0; i<response.length; i++) {
                    var a = response[i].stok;
                }
                        html+= '<input type="text" class="form-control" id="stok" name="stok" value="'+a+'">'
                $('#jumlah').html(html);
            }
        });
    }
      </script> -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      