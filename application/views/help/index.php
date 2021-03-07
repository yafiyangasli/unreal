<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/contact.css');?>"media="all"/>
<div class="container-fluid text-dark">
	<h1 id="header">HELP</h1>

	<div class="row ml-2 mr-4 mb-5 no-gutters">
		<div class="col-12 col-sm-4 col-md-4">
			<h2 id="toggler1">How To Shop</h2>
			<h2 id="toggler2">Return & Exchange Guide</h2>
			<h2 id="toggler3">FAQ</h2>
			<h2 id="toggler4">Contact Us</h2>
		</div>
		<div class="col-12 col-sm-8 col-md-8">
			<div class="col-12 col-sm-6">
            <?=$this->session->flashdata('message');?>
			</div>
			<div class="row">
				<div class="col-sm-1">
					<div id="vl" class="d-none d-sm-block"></div>
				</div>
				<div class="col-12 col-sm-11">
			<div id="content-1" class="w3-animate-left">
				<p id="head-content">How To Shop</p>
				<div class="text-secondary">
				<p>1. BROWSE & SELECT PRODUCT(S) </p>
				<p>From the home page, click on a category to browse our product(s). 
			You can click the picture for complete description and details of your desired product(s).</p>
			<p>2. ADD TO CART</p>
			<p>Choose your desired colour (if any), then size and quantity.
			Click ADD TO CART to add the product(s) to your shopping bag.
			You can directly CHECKOUT or view your shopping bag to review your order and
			continue shopping.
			<p>3. REVIEW ORDER</p>
			<p>If you decide to ‘continue shopping’, you can check the item(s) you chose previously by clicking
				the SHOPPING BAG section at the top of the site.</p>
			<p>4. CHECKOUT</p>
			<p>If you decide to finalize your order, click CHECKOUT on the SHOPPING BAG section.
			Log in to your registered account or create an account for faster checkout on your next purchase.
			Availability your desired items are not guaranteed before you CHECKOUT.
			</p>
			<p>5. PAYMENT & SHIPPING METHOD</p>
			<p>Choose your desired payment and shipping method. On the SHIPPING METHOD section,
			you can choose either express, regular or economical shipping.
			</p>
			<p>6. CONFIRM ORDER</p>
			<p>Please review and do double check before you confirm your order.
			Your order number will be displayed on the page and will also be sent in an email notification.</p>
			</p>
			<p>7. CONFIRM PAYMENT</p>
			<p>After you have done the payment, re-visit the website and choose PAYMENT CONFIRMATION
			at the top of the site. You will receive your payment confirmation via email after you
			submit your payment details.
			</p>
			<p>8. IT’S DONE!</p>
			<p>You can now sit back and wait for your order to arrive.</p>
			</div>
			</div>
			<div id="content-2" class="w3-animate-left text-dark">
				<p id="head-content">Return & Exchange Guide</p>
				<div class="text-secondary">
				<p>1. MAKE A RETURN REQUEST</p>
				<p>On MY ACCOUNT section, click Return and Exchange.</p>
				<p>2. SELECT ITEM(S)</p>
				<p>Choose Request New Return and Exchange, then select the order ID with item(s)
				that you want to return/exchange. Mark the corresponding boxes beside the
				name of item(s) that you wish to return and select the reason from the options
				why you wish to return the product(s). You can upload images related to the
				condition of the product(s).</p>
				<p>3. CHOOSE RESOLUTION TYPE</p>
				<p>Choose your desired resolution type (Refund to Store Credit or Exchange to
				Other Size). If you wish to ‘exchange to other size’, select your desired size from
				the options given. We only accept exchange to other size of same style. If you
				wish to exchange to other style, please choose Refund to Store Credit and shop
				the desired style.</p>
				<p>4. REVIEW RETURN POLICY</p>
				<p>Please check our return policy before you submit the return and exchange
				request. If you agree to our policy, click the SUBMIT REQUEST button.</p>
				<p>5. WAIT FOR RETURN REQUEST APPROVAL</p>
				<p>You will be directed to Return and Exchange History page where you can check
				your request status. Our admin will check your request and confirm it to you.</p>
				<p>6. SHIP YOUR PACKAGE TO US</p>
				<p>You will receive an email when your return request is accepted and your return
				status will be changed from ‘pending’ to ‘processing’. Print out the Return &
				Exchange Confirmation label that you can find on the Return & Exchange detail
				page by clicking 'Print RMA' and attach it inside the package.</p>
				<p>7. WAIT FOR YOUR NEW ITEM(S)!</p>
				<p>After we have received your package, we will process your return & exchange
				within 2-7 business days.</p>
				</div>
			</div>
			<div id="content-3" class="w3-animate-left">
				<p id="head-content">FAQ</p>
				<div class="text-secondary">
				<p>Where are you based?</p>
				<p>We are based at Bandar Lampung, Indonesia.</p>
				<br>
				<p>Do you have any offline store?</p>
				<p>Yes. You can find us at Jl. KH. Ahmad Dahlan No.34, Pahoman, Kec. Tlk. Betung
				Utara, Kota Bandar Lampung, Lampung.</p>
				<br>
				<p>Are your items ready stock?</p>
				<p>Yes, all items are ready stock, except stated otherwise in the description.</p>
				<br>
				<p>Are your items manufactured yourself?</p>
				<p>Yes, they are. We have our own workshop and manufacture our products
				exclusively for our brand.</p>
				<br>
				<p>I haven’t got my order, it has been late for couple of days. Where is my order?</p>
				<p>Kindly email us to contact@unreal_club, there might be possibilities of delay
				caused by the shipping courier, but we will try to help you as much as we can.
				Note that if your order is sent during public holiday, there may be some delays.</p>
				<br>
				<p>I have received my package. Unfortunately, there is some defect in the product.
				What should I do?</p>
				<p>We apologize for our mistake, and please kindly email us to
				contact@unreal_club, and we will give you instructions to return it to us. All
				shipping fees will be paid by us (both returns and sending it back).</p>
				<br>
				<p>The garment I received does not fit me well (It is too big or too small). What
				should I do?</p>
				<p>Don't worry, you can exchange it to other size. However, return and exchanges
				should be done maximum 5x24 hours after you receive the package.</p>
				<br>
				<p>Can I exchange or return sale item(s)?</p>
				<p>No you can't, sale items are not refundable or exchangeable, except if there is
				any defect in our item.</p>
				</div>
			</div>
			<div id="content-4" class="w3-animate-left">
				<p id="head-content">Contact Us</p>
				<div class="text-secondary">
				<p>Please complete the form below with your query or
				feedback and our customer service team will be more
				than happy to help you. We will reply your e-mail within
				24 hours in our working hours.</p>
				<div class="row">
					<div class="col-2 col-sm-2 col-md-1"><img id="img-maps" src="<?=base_url('assets/logo/maps.png')?>" class="img-fluid"></div>
					<div class="col col-sm col-md">
						<p>Jl. KH. Ahmad Dahlan No.34, Pahoman, Kec. Tlk.
						Betung Utara, Kota Bandar Lampung, Lampung
						35228</p>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-2 col-sm-2 col-md-1"><i class="far fa-clock"></i></div>
					<div class="col col-sm col-md">
						<p>Monday – Sunday<br>
						10 AM – 10 PM</p>
					</div>
				</div>
				<p>Message us here</p>
				<form method="post" action="">
					<div class="form-group">
					<input class="form-control col-8 col-sm-6 mb-2" type="text" name="nama" id="nama" placeholder="Name..." required>
					<?=form_error('nama','<small class="text-danger pl-3">','</small>');?>
					</div>
					<div class="form-group">
					<input class="form-control col-8 col-sm-6 mb-2" type="email" name="email" id="email" placeholder="Email..." required>
					<?=form_error('email','<small class="text-danger pl-3">','</small>');?>
					</div>
					<div class="form-group">
					<input class="form-control col-8 col-sm-6 mb-2" type="text" name="subject" id="subject" placeholder="Subject..." required>
					<?=form_error('subject','<small class="text-danger pl-3">','</small>');?>
					</div>
					<div class="form-group">
					<select id="kategori" name="kategori" class="form-control col-8 col-sm-6 mb-3 text-secondary pl-1" required>
						<option value="">Message Category...</option>
				        <option value="Store">Store</option>
				        <option value="Confirm Payment">Confirm Payment</option>
				        <option value="Order">Order</option>
					</select>
					<?=form_error('kategori','<small class="text-danger pl-3">','</small>');?>
					</div>
					<div class="form-group">
				    	<label for="pesan">Message</label>
				    	<textarea class="form-control col-8 col-sm-6 mb-2" id="pesan" name="pesan" rows="3" required></textarea>
				    	<?=form_error('pesan','<small class="text-danger pl-3">','</small>');?>
				  	</div>
				  	<button class="btn btn-dark col-3 col-sm-1" type="submit">Send</button>
				</form>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("#toggler1").click(function(){
			$("#content-2").hide(1);
			$("#content-3").hide(1);
			$("#content-4").hide(1);
			$("#content-1").show(100);
		});
	});

	$(document).ready(function(){
		$("#toggler2").click(function(){
			$("#content-1").hide(1);
			$("#content-3").hide(1);
			$("#content-4").hide(1);
			$("#content-2").show(100);
		});
	});
	$(document).ready(function(){
		$("#toggler3").click(function(){
			$("#content-1").hide(1);
			$("#content-2").hide(1);
			$("#content-4").hide(1);
			$("#content-3").show(100);
		});
	});
	$(document).ready(function(){
		$("#toggler4").click(function(){
			$("#content-1").hide(1);
			$("#content-2").hide(1);
			$("#content-3").hide(1);
			$("#content-4").show(100);
		});
	});
</script>