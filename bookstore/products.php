<?php include("header.php") ?>

<?php
include_once("dbh.php");
try {


	$sql = "SELECT id, title, price, description, image_url FROM book";
	$stmt = $pdo->query($sql);
	$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

?>
<!-- Main -->
<div id="main">
	<div class="inner">
		<h1>Products</h1>

		<div class="image main">
			<img src="images/banner-image-6-1920x500.jpg" class="img-fluid" alt="" />
		</div>

		<!-- Products -->

		<section class="tiles">
			<?php foreach ($books as $book): ?>
				<?php
				$short_description = implode(' ', array_slice(explode(' ', $book['description']), 0, 15)) . '...';
				?>

				<article class="style1">
					<span class="image">
						<img width="280px" height="320px"
							src="<?php echo 'admin/' . htmlspecialchars($book['image_url']); ?>"
							alt="<?php echo htmlspecialchars($book['title']); ?>" />
					</span>
					<a href="product-details.php?id=<?php echo $book['id']; ?>">
						<h2>
							<?php echo htmlspecialchars($book['title']); ?>
						</h2>
						<p><strong>৳
								<?php echo number_format($book['price'], 2); ?>
							</strong></p>
						<p>
							<?php echo htmlspecialchars($short_description); ?>
						</p>
					</a>
				</article>
			<?php endforeach; ?>
		</section>

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