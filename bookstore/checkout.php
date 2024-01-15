<?php

include("header.php");


if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
	$id = $_GET['id'];
	unset($_SESSION['cart'][$id]); 
	header("Location: checkout.php");
	exit();
}


?>

<!-- Menu -->
<nav id="menu">
	<h2>Menu</h2>
	<ul>
		<li><a href="index.php">Home</a></li>

		<li><a href="products.php">Products</a></li>

		<li><a href="checkout.php" class="active">Checkout</a></li>

		<li>
			<a href="#" class="dropdown-toggle">About</a>

			<ul>
				<li><a href="about.php">About Us</a></li>
				<li><a href="blog.php">Blog</a></li>
				<li><a href="testimonials.php">Testimonials</a></li>
				<li><a href="terms.php">Terms</a></li>
			</ul>
		</li>

		<li><a href="contact.php">Contact Us</a></li>
	</ul>
</nav>

<!-- Main -->
<div id="main">
	<div class="inner">
		<h1>Checkout</h1>
		<?php if (isset($_SESSION['userid'])):?>

		<div class="container px-3 my-5 clearfix">
			<!-- Shopping cart table -->
			<div class="card">
				<div class="card-header">
					<h2>Shopping Cart</h2>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
								<!-- Table headers -->
							</thead>
							<tbody>
								<?php
								$total_price = 0;
								if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
									<?php foreach ($_SESSION['cart'] as $id => $item):
										$item_total = $item['price'] * $item['quantity'];
										$total_price += $item_total; // Add to total price
										?>

										<tr>
											<td class="p-4">
												<div class="media align-items-center">
													<img width="180px" height="220px"
														src=" <?php echo 'admin/' . htmlspecialchars($item['image_url']); ?>"
														class="d-block ui-w-40 ui-bordered mr-4"
														alt="<?php echo htmlspecialchars($item['title']); ?>">
													<div class="media-body">
														<?php echo htmlspecialchars($item['title']); ?>
													</div>
												</div>
											</td>
											<td class="text-center font-weight-semibold align-middle p-4">
												<?php echo number_format($item['price'], 2); ?>
											</td>
											<td class="text-center font-weight-semibold align-middle p-4">৳
												<?php echo htmlspecialchars($item['quantity']); ?>
											</td>
											<td class="text-center font-weight-semibold align-middle p-4">৳
												<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
											</td>
											<td class="text-center align-middle px-0"><a
													href="checkout.php?id=<?php echo $id; ?>"
													class="shop-tooltip close float-none text-danger" title="Remove">×</a></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>

							</tbody>
						</table>
					</div>
					

					<!-- / Shopping cart table -->

					<div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
						<div class="mt-4">
							<label class="text-muted font-weight-normal">Promocode</label>
							<input readonly type="text" placeholder="ABC" class="form-control">
						</div>
						<div class="d-flex">
							<div class="text-right mt-4 mr-5">
								<label class="text-muted font-weight-normal m-0">Discount</label>
								<div class="text-large"><strong>৳0</strong></div>
							</div>
							<div class="text-right mt-4">
								<label class="text-muted font-weight-normal m-0">Total price</label>
								<div class="text-large"><strong>৳
										<?php echo number_format($total_price, 2); ?>
									</strong></div>
							</div>
						</div>
					</div>
					

					<div class="float-right">
					<a type="button" href="payment.php?price=<?php echo number_format($total_price, 2);?>" class="btn btn-lg btn-primary mt-2">Checkout</a>
					<a type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3" href="index.php">Back to
							shopping</a>
					
					<?php else: ?>

						<a type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3" href="signup_log.php">Sign In</a>
						<a type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3" href="index.php">Back to
							shopping</a>
					<?php endif; ?>
					

						
					</div>

					

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<footer id="footer">
	<div class="inner">
		<section>
			<form method="post" action="#">
				<div class="fields">
					<div class="field half">
						<select>
							<option value="">-- Choose Title--</option>
							<option value="dr">Dr.</option>
							<option value="miss">Miss</option>
							<option value="mr">Mr.</option>
							<option value="mrs">Mrs.</option>
							<option value="ms">Ms.</option>
							<option value="other">Other</option>
							<option value="prof">Prof.</option>
							<option value="rev">Rev.</option>
						</select>
					</div>

					<div class="field half">
						<input type="text" name="field-2" id="field-2" placeholder="Name">
					</div>

					<div class="field half">
						<input type="text" name="field-3" id="field-3" placeholder="Email">
					</div>

					<div class="field half">
						<input type="text" name="field-4" id="field-4" placeholder="Phone">
					</div>

					<div class="field half">
						<input type="text" name="field-5" id="field-5" placeholder="Address 1">
					</div>

					<div class="field half">
						<input type="text" name="field-6" id="field-6" placeholder="Address 2">
					</div>

					<div class="field half">
						<input type="text" name="field-7" id="field-7" placeholder="City">
					</div>

					<div class="field half">
						<input type="text" name="field-8" id="field-8" placeholder="State">
					</div>

					<div class="field half">
						<input type="text" name="field-7" id="field-7" placeholder="Zip">
					</div>

					<div class="field half">
						<select>
							<option value="">-- Choose Country--</option>
							<option value="">-- Choose Country --</option>
							<option value="">-- Choose Country --</option>
							<option value="">-- Choose Country --</option>
						</select>
					</div>

					<div class="field half">

						<select>
							<option value="">-- Choose Payment Method--</option>
							<option value="">-- Choose Payment Method--</option>
							<option value="">-- Choose Payment Method--</option>
							<option value="">-- Choose Payment Method--</option>
						</select>
					</div>

					<div class="field half">
						<input type="text" name="field-9" id="field-9" placeholder="Captcha">
					</div>

					<div class="field">
						<div>
							<input type="checkbox" id="checkbox-4">

							<label for="checkbox-4">
								I agree with the <a href="terms.php" target="_blank">Terms &amp; Conditions</a>
							</label>
						</div>
					</div>


					<div class="field half text-right">
						<ul class="actions">
							<li><input type="submit" value="Finish" class="primary"></li>
						</ul>
					</div>
				</div>
			</form>
		</section>
		<section>
			<h2>Contact Info</h2>

			<ul class="alt">
				<li><span class="fa fa-envelope-o"></span> <a href="#">contact@company.com</a></li>
				<li><span class="fa fa-phone"></span> +1 333 4040 5566 </li>
				<li><span class="fa fa-map-pin"></span> 212 Barrington Court New York, ABC 10001 United States
					of America</li>
			</ul>

			<h2>Follow Us</h2>

			<ul class="icons">
				<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon style2 fa-linkedin"><span class="label">LinkedIn</span></a></li>
			</ul>
		</section>

		<ul class="copyright">
			<li>Copyright © 2020 Company Name </li>
			<li>Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>
		</ul>
	</div>
</footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>