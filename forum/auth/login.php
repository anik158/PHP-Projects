<?php
require '../config/config.php';
require '../includes/header.php';

if(isset($_SESSION['username'])){
  header('location: ../index.php');
}

if (isset($_POST['login'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('One or more fields are empty')</script>";
  } else {
    $user = $_POST["email"];
    $password = $_POST["password"];


    $selectQuery = "SELECT * FROM users WHERE username = :username OR email = :email";
    $query = $pdo->prepare($selectQuery);

    $query->execute([
      ":username" => $user,
      ":email" => $user
    ]);

    $fetch = $query->fetch();

    if ($fetch && password_verify($password, $fetch->password)) {
      $_SESSION['username'] = $fetch->username;
      $_SESSION['user_id'] = $fetch->id;
      $_SESSION['email'] = $fetch->email;
      $_SESSION['user_image'] = $fetch->avatar;

      header("location: ../index.php");
    } else {
      echo "<script>alert('Email or Password is wrong.')</script>";
    }
  }
}
?>


<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="main-col">
        <div class="block">
          <h1 class="pull-left">Login</h1>
          <h4 class="pull-right">A Simple Forum</h4>
          <div class="clearfix"></div>
          <hr>
          <form role="form" enctype="multipart/form-data" method="post" action="login.php">

            <div class="form-group">
              <label>Email Address*</label> <input type="email" class="form-control" name="email"
                placeholder="Enter Your Email Address">
            </div>

            <div class="form-group">
              <label>Password*</label> <input type="password" class="form-control" name="password"
                placeholder="Enter A Password">
            </div>

            <input name="login" type="submit" class="color btn btn-default" value="Login" />
          </form>
        </div>
      </div>
    </div>
    <?php require '../config/config.php';
    require '../includes/footer.php';
    ?>