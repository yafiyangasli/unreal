<div class="row no-gutters mt-5">
	<div class="col-12 col-sm-9 order-sm-1 pl-5 pr-5 pb-5">
		<div class="container-fluid">
		<h3 id="header-cart">Your Transaction</h3>
 		<form method="post" action="<?=base_url('user/checkout');?>" id="form">
		<div class="container-fluid mt-5" id="container-checkout-body">
			<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Name</label>
				<div class="col-12 col-sm-8 mb-2 mt-2">
					<input type="text" class="form-control" id="name" name="name" value="<?=$user['name']?>" readOnly>
					<?=form_error('name','<small class="text-danger pl-3">','</small>');?>
				</div>
				<div class="col-sm-2 mb-2 mt-2">
					<a class="btn btn-light" onclick="disableTxtname()">Change</a>
				</div>
			</div>
			<hr>
			<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Address & Telephone</label>
				<div class="col-12 col-sm-8 mb-2 mt-2">
					<input type="text" class="form-control" readOnly id="address" name=address value="<?=$user['address']?>, <?=$user['telephone']?>">
					<?=form_error('address','<small class="text-danger pl-3">','</small>');?>
				</div>
				<div class="col-12 col-sm-2 mb-2 mt-2">
					<a class="btn btn-light" onclick="disableTxtaddress()">Change</a>
				</div>
			</div>
			<hr>
			<div class="form-group row">
			<label for="provinsi" class="col-sm-2 col-form-label">Province</label>
				<div class="col-12 col-sm-4 mb-2 mt-2">
					<select class="form-control provinsi" id="provinsi" name=provinsi>
						<option value="">Please wait...</option>
					</select>
					<?=form_error('provinsi','<small class="text-danger pl-3">','</small>');?>
				</div>
			</div>
			<hr>
			<div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
				<div class="col-12 col-sm-4 mb-2 mt-2">
					<select onClick="getOngkir()" class="form-control" id="city" name=city>
						<option id="opt1" value="">Click change...</option>
					</select>
					<?=form_error('city','<small class="text-danger pl-3">','</small>');?>
				</div>
				<div class="col-12 col-sm-2 mb-2 mt-2">
					<a class="btn btn-light" onClick="getKotaTujuan()">Change</a>
				</div>
			</div>
			<hr>
			<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Delivery Fee</label>
				<div class="col-12 col-sm-4 mb-2 mt-2" id="hargaOngkir">
					
				</div>
				<div class="col-12 col-sm-2 mb-2 mt-2">
					<a class="btn btn-light" onClick="getOngkir()">Update</a>
				</div>
			</div>
		</div>

		<div class="col-12 col-sm-4 mt-5">
			<h4 id="header-cart">Shipping Method</h4>
			<div class="row pt-3">
				<div class="col-sm-5">
				<img class="img-fluid pt-2 pb-2" src="<?=base_url('assets/logo/jne.png')?>" style="max-width: 100px;">
				</div>
				<div class="col-12 col-sm-7">
					<p id="shipping-method">Regular</p>
					<p id="shipping-method">3-5 days</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-7 mb-5">
				<a href="<?=base_url('user/cart');?>" class="text-dark text-decoration-none"><i class="fas fa-fw fa-arrow-left"></i> Return to cart</a>
			</div>
			<div class="col-12 col-sm offset-1">
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="valid" name="valid">
					<label class="form-check-label" for="valid">My address already valid</label>
				</div>
				<button class="btn btn-outline-dark" id="btn-checkout">Confirm Checkout</button>
			</div>
		</div>
		</form>
		</div>
	</div>
	<div class="col-sm-3 order-sm-2 bg-light mt-5 pb-5">
		<div class="container-fluid">
			<h5 class="pt-5 pb-3">Order Summary</h5>
			<?php 
	          $totalPesan=0;
	          $totalCheckout=0;
	          $jumlahPesan=0;
	            foreach($cart as $ct):
	            $hargaAwal= $ct['harga'];
	            $jumlahPesan= $ct['jumlah'];
	            $totalPesan = $hargaAwal * $jumlahPesan;
	            $totalCheckout = $totalCheckout + $totalPesan;
	          endforeach;
	        ?>

	        <?php
	          $totalPesan=0;
	          $beratAwal=0;
	          $jumlahPesan=0;
	          $beratAkhir=0;
	          $totalBerat=0;
	          $beratAkhir=0;
	            foreach($cart as $ct):
	            $beratAwal= $ct['berat'];
	            $jumlahPesan= $ct['jumlah'];
	            $totalPesan = $beratAwal * $jumlahPesan;
	            $totalBerat = $totalBerat + $totalPesan;
	          endforeach;
	          $beratAkhir=0;
	          while ($totalBerat>$beratAkhir) {
	          	$beratAkhir++;
	          }
	        ?>

	        <div class="row">
			    <?php if($jumlahPesan!=NULL):?>
			    	<?php 
			    		$totalBarang=0;
			    		$totalBarangAkhir=0;
			    		foreach($cart as $ct):
			            $totalBarang= $ct['jumlah'];
			            $totalBarangAkhir = $totalBarangAkhir + $totalBarang;
			          endforeach;
			    	?>
	        		<div class="col-sm-5">
					<p id="order-summary-body"><?=$totalBarangAkhir;?> items</p>
					</div>
					<?php else:?>
					<div class="col-sm">
			        <p id="order-summary-body">There are no items in your cart</p>
					</div>
				<?php endif;?>
				<?php if($jumlahPesan!=NULL):?>
					<div class="col-sm-7">
					<p id="order-summary-body"><?=rupiah($totalCheckout);?></p>
					</div>
				<?php endif;?>
			</div>
			<div class="row no-gutters">
			    <?php if($jumlahPesan!=NULL):?>
	        		<div class="col-sm-5">
					<p id="order-summary-body">Total Weight</p>
					</div>
				<?php endif;?>
				<?php if($jumlahPesan!=NULL):?>
					<div class="col-sm-7">
					<p id="order-summary-body"><?=$beratAkhir;?> Kg</p>
					</div>
				<?php endif;?>
			</div>
			<div class="row no-gutters">
			    <?php if($jumlahPesan!=NULL):?>
	        		<div class="col-sm-5">
					<p id="order-summary-body">Delivery Fee</p>
					</div>
				<?php endif;?>
				<?php if($jumlahPesan!=NULL):?>
					<div class="col-sm-7">
					<p id="order-summary-body" class="totalOngkir"></p>
					</div>
				<?php endif;?>
			</div>
			<div class="row pt-3">
			    <?php if($jumlahPesan!=NULL):?>
	        		<div class="col-sm-5">
					<h5>Total Cost</h5>
					</div>
				<?php endif;?>
				<?php if($jumlahPesan!=NULL):?>
					<?php
						$totalCost=$totalCheckout + 50000;
					?>
					<div class="col-sm-7">
					<p id="order-summary-body" class="hargaAkhir"></p>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		$.get("<?= base_url('user/getProvince')?>",{},(response)=>{
			let output = '';
			let provinsi = response.rajaongkir.results
			console.log(response)

			provinsi.map((val,i)=>{
				output+=`<option value="${val.province_id}" >${val.province}
		
				</option>`
			})
			$('.provinsi').html(output)

			})
		$('#btn-checkout').attr('disabled', true);
		$('#valid').attr('disabled', true);
		});

	function getKotaTujuan(){
		let id_provinsi = $('#provinsi').val();

		$.get("<?= base_url('user/getKota/')?>"+id_provinsi,{},(response)=>{
			let output = '';
			let kota = response.rajaongkir.results
			console.log(response)

			kota.map((val,i)=>{
				output+=`<option value="${val.city_id}" >${val.city_name}</option>`
			})
			$('#city').html(output)
		})
		$('#valid').attr('disabled', true);
		$('#btn-checkout').attr('disabled', true);
	}

	function getOngkir(){
		let berat =<?=$beratAkhir?>;
		let asal = "21";
		let tujuan = $('#city').val();
		let kurir ="jne";
		let hargaBarang=<?=$totalCheckout?>;
		let output = '';

		$.get("<?= base_url('user/get_ongkir/')?>"+`${asal}/${tujuan}/${berat}/${kurir}`,{},(response)=>{
			let biaya = response.rajaongkir.results
			console.log(biaya)

			biaya.map((val,i)=>{
				for (var i = 0; i < val.costs.length; i++) {
						 let jenis_layanan= val.costs[i].service
						 val.costs[i].cost.map((val,i)=>{
						 	if (jenis_layanan=="REG") {
						 	totalOngkir=berat*val.value;
						 	totalHarga=totalOngkir+hargaBarang;
						 	var	reverse = totalOngkir.toString().split('').reverse().join(''),
							ribuan 	= reverse.match(/\d{1,3}/g);
							ribuan	= ribuan.join('.').split('').reverse().join('');

							var	reverse2 = totalHarga.toString().split('').reverse().join(''),
							ribuan2 = reverse2.match(/\d{1,3}/g);
							ribuan2	= ribuan2.join('.').split('').reverse().join('');

						 	output=`<input type="text" value="Rp. `+`${ribuan}`+`" class="form-control-plaintext" readOnly id="ongkir" name="ongkir">`
						 	output2=`${ribuan2}`
						 	output3=`${ribuan}`
						 	}
						 })
					}
				})
				$(`#hargaOngkir`).html(output)
				$(`.hargaAkhir`).html("Rp. "+output2+",00")
				$(`.totalOngkir`).html("Rp. "+output3+",00")
		})
		$('#valid').removeAttr('disabled');
		$('#valid'). prop("checked", false);
		$('#btn-checkout').attr('disabled',true);
	}

	$('#valid').click(function(){
        //check if checkbox is checked
        if($(this).is(':checked')) {
            $('#btn-checkout').removeAttr('disabled'); //enable input

        } else {
            $('#btn-checkout').attr('disabled', true); //disable input
        }
    });

	// $('#valid').click(function () {
 //        //check if checkbox is checked
 //        if ($(this).is(':checked')) {
 //            $('#btn-checkout').fadeIn(2000); //enable input

 //        } else {
 //            $('#btn-checkout').hide(0); //disable input
 //        }
 //    });
 		// var sec = 5;
 		// window.onload= countDown;

  //   	var checker = document.getElementById('valid');
		// var sendbtn = document.getElementById('btn-checkout');
		//  // when unchecked or checked, run the function
		// checker.onchange = function(){
		// 	if(this.checked){
		// 	    sendbtn.disabled = false;
		// 	} else if(this.checked!=true) {
		// 		sendbtn.disabled = true;
		// 	}
		// }

</script>
