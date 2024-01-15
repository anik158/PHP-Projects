<?php

include("header.php");
include_once("dbh.php");
$book_id = $_GET['id'];
try {

	$sql = "SELECT title, price, description, image_url FROM book WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['id' => $book_id]);
	$book = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Assuming you have a POST request to add to cart
	$quantity = $_POST['quantity']; // Get the quantity from the form
	$book_id = $_GET['id']; // Assuming you're still getting the book ID from the URL

	// Retrieve book details again (or you can optimize by storing them in session)
	$sql = "SELECT title, price, image_url FROM book WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['id' => $book_id]);
	$book = $stmt->fetch(PDO::FETCH_ASSOC);

	// Add to session cart
	$_SESSION['cart'][$book_id] = [
		'title' => $book['title'],
		'price' => $book['price'],
		'quantity' => $quantity,
		'image_url' => $book['image_url']
	];

	// Redirect to checkout.php
	header("Location: checkout.php");
	exit();
}


	?>

<!-- Main -->

<div id="main">

	<div class="inner">
		<h1>
			<?php echo htmlspecialchars($book['title']); ?> <span class="pull-right">৳
				<?php echo number_format($book['price'], 2); ?>
			</span>
		</h1>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-5">
					<img src="<?php echo 'admin/' . htmlspecialchars($book['image_url']); ?>" class="img-fluid"
						alt="<?php echo htmlspecialchars($book['title']); ?>">
				</div>

				<div class="col-md-7">
					<p>
						<?php echo htmlspecialchars($book['description']); ?>
					</p>


					<div class="row">


						<div class="col-sm-8">
							<form action="product-details.php?id=<?php echo $book_id; ?>" method="post">
								<div class="form-group">
									<label for="quantity" class="control-label">Quantity</label>
									<input type="number" name="quantity" id="quantity" class="form-control" min="1"
										value="1">
								</div>
								<input type="submit" class="btn btn-primary" value="Add to Cart">
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<br>


	</div>
</div>

<!-- Footer -->
<footer id="footer">
	<div class="inner">
		<section>
			<ul class="icons">
				<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon style2 fa-linkedin"><span class="label">LinkedIn</span></a></li>
			</ul>

			&nbsp;
		</section>

		<ul class="copyright">
			<li>Copyright © 2020 Company Name </li>
			<li>Template by: <a href="https://www.anik158.com/">anik158.com</a></li>
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