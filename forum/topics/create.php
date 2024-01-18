<?php
require '../includes/header.php';
require '../config/config.php';
?>

<?php

if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
}

if (isset($_POST['submit'])) {

	if (empty($_POST['title']) or empty($_POST['category']) or empty($_POST['body'])) {
		echo "<script>alert('One or more field empty')</script>";
	} else {
		$id = generateRandomString(8);
		$title = $_POST['title'];
		$cat = $_POST['category'];
		$body = $_POST['body'];
		$username = $_SESSION['email'];
		$user_image = $_SESSION['user_image'];







		$query = "INSERT INTO topics (id,title,category,body,username,user_image) 
					VALUES(:id,:title,:category,:body,:username,:user_image)";

		$insert = $pdo->prepare($query);



		$insert->execute([
			":id" => $id,
			":title" => $title,
			":category" => $cat,
			":body" => $body,
			":username" => $username,
			":user_image" => $user_image,
		]);


		header("location: ../index.php?msg=topicCreated");



	}



}

function generateRandomString($length = 8)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>


<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Create A Topic</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<form role="form" method="post" action="create.php">
						<div class="form-group">
							<label>Topic Title</label>
							<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
						</div>
						<div class="form-group">
							<label>Category</label>
							<select name="category" class="form-control">
								<option value="Design">Design</option>
								<option value="Development">Development</option>
								<option value="Business & Marketing">Business & Marketing</option>
								<option value="Search Engines">Search Engines</option>
								<option value="Cloud & Hosting">Cloud & Hosting</option>
							</select>
						</div>
						<div class="form-group">
							<label>Topic Body</label>
							<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
						<button name="submit" type="submit" class="color btn btn-default">Create</button>
					</form>
				</div>
			</div>
		</div>
		<?php require '../includes/footer.php'; ?>