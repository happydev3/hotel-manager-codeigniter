<?php $this->load->view('home/header') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/pymt.css">
<?php
	$search_details=$this->session->userdata('search_details');
	$pass_info=$this->session->userdata('passenger_info');
	// echo '<pre>'; print_r($pass_info);exit;
?>
<!-- <form action="success.php" method="POST">
	<script
	src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
	data-amount="999"
	data-name="wowbooking-bh.com"
	data-description="Holiday Booking"
	data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
	data-locale="auto"
	data-zip-code="true">
	</script>
</form> -->
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<!-- <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script> -->


<body style="background: #f8fbfd;">
	<div id="main" class="loading">
		<div id="checkout">
			<input type="hidden" id="idtype" value="<?php echo $search_details['cost'] ?>">
			<form id="payment-form" method="POST" action="<?php echo site_url() ?>payment/payment_return" enctype="multipart/form-data">
				<p class="instruction">Complete your payment details below</p>
				<section>
					<h2>Billing Information</h2>
					<fieldset class="with-state">
						<label>
							<span>Name</span>
							<input name="name" value="<?php echo $pass_info['GuestFirstName'].' '.$pass_info['GuestLastName'] ?>" class="field" placeholder="" required>
						</label>
						<label>
							<span>Email</span>
							<input name="email" value="<?php echo $pass_info['GuestEmailID'] ?>" type="email" class="field" placeholder="" required>
						</label>
						<label>
							<span>Address</span>
							<input name="address" value="<?php echo $pass_info['GuestAddress'] ?>" class="field" placeholder="">
						</label>
						<label>
							<span>City</span>
							<input name="city" value="<?php echo $pass_info['GuestCity'] ?>" class="field" placeholder="">
						</label>
						<label class="state">
							<span>State</span>
							<input name="state" value="<?php echo $pass_info['GuestState'] ?>" class="field" placeholder="">
						</label>
						<label class="zip">
							<span>ZIP</span>
							<input name="postal_code" value="<?php echo $pass_info['GuestPostalCode'] ?>" class="field" placeholder="">
						</label>
						<label class="select">
							<span>Country</span>
							<div id="country" class="field US">
								<select name="country">
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="BE">Belgium</option>
									<option value="BR">Brazil</option>
									<option value="CA">Canada</option>
									<option value="CN">China</option>
									<option value="DK">Denmark</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="DE">Germany</option>
									<option value="HK">Hong Kong</option>
									<option value="IE">Ireland</option>
									<option value="IT">Italy</option>
									<option value="JP">Japan</option>
									<option value="LU">Luxembourg</option>
									<option value="MX">Mexico</option>
									<option value="NL">Netherlands</option>
									<option value="NZ">New Zealand</option>
									<option value="NO">Norway</option>
									<option value="PT">Portugal</option>
									<option value="SG">Singapore</option>
									<option value="ES">Spain</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="GB">United Kingdom</option>
									<option value="US" selected="selected">United States</option>
								</select>
							</div>
						</label>
					</fieldset>
				</section>
				<section>
					<h2>Payment Information</h2>
					<div class="payment-info card visible">
						<fieldset>
							<label>
								<!-- <span>Card</span> -->
								<div id="card-element" class="field"></div>
							</label>
						</fieldset>
					</div>
				</section>
				<div>Test card: 4242424242424242</div><br>
				<button type="submit">Pay <?php echo $search_details['cost'] ?></button>
			</form>
			<div id="card-errors" class="payment-errors" role="alert"></div>
		</div>
	</div>
</body>

<?php $this->load->view('home/footer') ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/pymt.js"></script>