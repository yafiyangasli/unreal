<div class="row no-gutters">
	<div class="col-md">
		 <img class="img-fluid" src="<?=base_url('assets/img/header/').$header['gambar'];?>">
	</div>
</div>

<div class="container mt-5 mb-5">
	<div class="row justify-content-center m-3">
		<div class="col-md-10">
			<div class="row justify-content-center">
			<?php foreach($lookbook as $lk):?>
				<div id="display-lookbook">
					<a href="<?=base_url('lookbook/detail/').$lk['id_lookbook'];?>"><div id="display-lookbookimg-wrapper">
					<img id="display-lookbookimg" src="<?=base_url('assets/img/lookbook/').$lk['gambar1'];?>" class="d-flex img-fluid align-self-center">
					</div></a>
					<a href="<?=base_url('lookbook/detail/').$lk['id_lookbook'];?>" class="text-decoration-none text-dark"><h5><?= $lk['nama'] ;?></h5></a>
					<p><?= $lk['date'];?></p>
				</div>
			<?php endforeach;?>
			</div>
		</div>
	</div>
</div>