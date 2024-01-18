<?php
require '../includes/header.php';
require '../config/config.php';
?>

<?php

if (isset($_SESSION['username'])) {
	header('location: ../index.php');
}


if (isset($_POST['submit'])) {

	if (
		empty($_POST['name']) or empty($_POST['email']) or empty($_POST['username'])
		or empty($_POST['password']) or empty($_POST['about'])
	) {
		echo "<script>alert('One or more field empty')</script>";
	} else {
		$id = generateRandomString(8);
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$pwd = $_POST['password'];
		$conPWD = $_POST['password2'];

		if ($conPWD != $pwd) {
			echo "<script>alert('Password does not match.')</script>";
		} else {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$about = $_POST['about'];
			if (empty($about)) {
				$about = "";
			}


			if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
				$image_name = $_FILES['avatar']['name'];
				$image_tmp_name = $_FILES['avatar']['tmp_name'];
				$image_type = $_FILES['avatar']['type'];
				$image_size = $_FILES['avatar']['size'];


				$extension = pathinfo($image_name, PATHINFO_EXTENSION);


				$allowed_extensions = ['png', 'jpeg', 'jpg'];


				if (!in_array($extension, $allowed_extensions)) {
					echo "Only .png, .jpeg, and .jpg files are allowed.";
					exit();
				}

				$target_dir = "img/";
				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}

				$target_file = $target_dir . basename($image_name);

				if (move_uploaded_file($image_tmp_name, $target_file)) {
					$avatar = basename($image_name);
				} else {
					echo "Error uploading the image.";
					exit();
				}
			} else {
				$avatar = 'default_img.jpg';
			}



			$query = "INSERT INTO users (id,name,email,username,password,avatar,about) 
					VALUES(:id,:name,:email, :username,:password, :avatar, :about)";

			$insert = $pdo->prepare($query);



			$insert->execute([
				":id" => $id,
				":name" => $name,
				":email" => $email,
				":username" => $username,
				":password" => $password,
				":avatar" => $avatar,
				":about" => $about
			]);


			header("location: login.php?msg=registrationSuccessful");
		}


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
					<h1 class="pull-left">Register</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<form role="form" enctype="multipart/form-data" method="post" action="register.php">
						<div class="form-group">
							<label>Name*</label> <input type="text" class="form-control" name="name"
								placeholder="Enter Your Name">
						</div>
						<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control" name="email"
								placeholder="Enter Your Email Address">
						</div>
						<div class="form-group">
							<label>Choose Username*</label> <input type="text" class="form-control" name="username"
								placeholder="Create A Username">
						</div>
						<div class="form-group">
							<label>Password*</label> <input type="password" class="form-control" name="password"
								placeholder="Enter A Password">
						</div>
						<div class="form-group">
							<label>Confirm Password*</label> <input type="password" class="form-control"
								name="password2" placeholder="Enter Password Again">
						</div>
						<div class="form-group">
							<label>Upload Avatar</label>
							<input type="file" name="avatar">
							<p class="help-block"></p>
						</div>
						<div class="form-group">
							<label>About Me</label>
							<textarea id="about" rows="6" cols="80" class="form-control" name="about"
								placeholder="Tell us about yourself (Optional)"></textarea>
						</div>
						<input name="submit" type="submit" class="color btn btn-default" value="Register" />
					</form>
				</div>
			</div>
		</div>

		<?php require '../includes/footer.php'; ?>