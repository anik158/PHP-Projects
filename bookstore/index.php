<?php include 'header.php'; ?>

<?php
include_once("dbh.php");
try {


	$sql = "SELECT id, title, price, description, image_url FROM book LIMIT 3";
	$stmt = $pdo->query($sql);
	$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

?>



<!-- Main -->
<div id="main">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="images/slider-image-1-1920x700.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/slider-image-2-1920x700.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/slider-image-3-1920x700.jpg" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<br>
	<br>

	<div class="inner">
		<!-- About Us -->
		<header id="inner">
			<h1>Find your new book!</h1>
			<p>Etiam quis viverra lorem, in semper lorem. Sed nisl arcu euismod sit amet nisi euismod sed cursus
				arcu elementum ipsum arcu vivamus quis venenatis orci lorem ipsum et magna feugiat veroeros
				aliquam. Lorem ipsum dolor sit amet nullam dolore.</p>
		</header>

		<br>

		<h2 class="h2">Featured Products</h2>

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

		<p class="text-center"><a href="products.php">More Books &nbsp;<i class="fa fa-long-arrow-right"></i></a></p>

		<br>

		<h2 class="h2">Testimonials</h2>

		<div class="row">
			<div class="col-sm-6 text-center">
				<p class="m-n"><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt delectus
						mollitia, debitis architecto recusandae? Quidem ipsa, quo, labore minima enim similique,
						delectus ullam non laboriosam laborum distinctio repellat quas deserunt voluptas
						reprehenderit dignissimos voluptatum deleniti saepe. Facere expedita autem quos."</em>
				</p>

				<p><strong> - John Doe</strong></p>
			</div>

			<div class="col-sm-6 text-center">
				<p class="m-n"><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt delectus
						mollitia, debitis architecto recusandae? Quidem ipsa, quo, labore minima enim similique,
						delectus ullam non laboriosam laborum distinctio repellat quas deserunt voluptas
						reprehenderit dignissimos voluptatum deleniti saepe. Facere expedita autem quos."</em>
				</p>

				<p><strong>- John Doe</strong> </p>
			</div>
		</div>

		<p class="text-center"><a href="testimonials.php">Read More &nbsp;<i class="fa fa-long-arrow-right"></i></a>
		</p>

		<br>

		<h2 class="h2">Blog</h2>

		<div class="row">
			<div class="col-sm-4 text-center">
				<img src="images/blog-1-720x480.jpg" class="img-fluid" alt="" />

				<h2 class="m-n"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>

				<p> John Doe &nbsp;|&nbsp; 12/06/2020 10:30</p>
			</div>

			<div class="col-sm-4 text-center">
				<img src="images/blog-2-720x480.jpg" class="img-fluid" alt="" />

				<h2 class="m-n"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>

				<p> John Doe &nbsp;|&nbsp; 12/06/2020 10:30</p>
			</div>

			<div class="col-sm-4 text-center">
				<img src="images/blog-3-720x480.jpg" class="img-fluid" alt="" />

				<h2 class="m-n"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>

				<p> John Doe &nbsp;|&nbsp; 12/06/2020 10:30</p>
			</div>
		</div>

		<p class="text-center"><a href="blog.php">Read More &nbsp;<i class="fa fa-long-arrow-right"></i></a>
		</p>


	</div>
</div>

<!-- Footer -->
<footer id="footer">
	<div class="inner">
		<section>
			<h2>Contact Us</h2>
			<form method="post" action="#">
				<div class="fields">
					<div class="field half">
						<input type="text" name="name" id="name" placeholder="Name" />
					</div>

					<div class="field half">
						<input type="text" name="email" id="email" placeholder="Email" />
					</div>

					<div class="field">
						<input type="text" name="subject" id="subject" placeholder="Subject" />
					</div>

					<div class="field">
						<textarea name="message" id="message" rows="3" placeholder="Notes"></textarea>
					</div>

					<div class="field text-right">
						<label>&nbsp;</label>

						<ul class="actions">
							<li><input type="submit" value="Send Message" class="primary" /></li>
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