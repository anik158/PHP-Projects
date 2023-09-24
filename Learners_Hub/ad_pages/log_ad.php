<?php 


session_start();

include_once "../includes/auto_loader.inc.php";

if(isset($_POST['login'])){
    $email = $_POST['usr'];
    $pwd = $_POST['pwd'];
    $pdo = new Dbh();
    $conn = $pdo->connect();
            
            $sql = "SELECT * FROM admin WHERE email = ? OR username = ?";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute([$email, $email]);
    
            $user = $stmt->fetch();
        
            if($user === false){
                header("location: ../ad_pages/admin_panel.php?error=nouserfound");
                exit();
            }else{
    
                if(password_verify($pwd, $user->password)){
                    $_SESSION["id"] = $user->admin_id;
                    $_SESSION["email"] = $user->email;
                    $_SESSION["username"] = $user->username;
                    setcookie("user_id", $user->admin_id, time() + 3600, "/");
                    setcookie("username", $user->username, time() + 3600, "/");
                    header("location: ../ad_pages/admin_panel.php?login=success");
                    exit();
                }else{
                    header("location: ../ad_pages/admin_panel.php?error=passwordnotmatch");
                    exit();
                }
                
            }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ad_style.css">
    <link rel="icon" href="img/favIcon.png" type="image/png">
    <title>Log In</title>
    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<nav>
        <p class="title">Admin Panel</p>
    </nav>
    <main>
        <h2 style="margin-left: 400px;color: coral;width: 100%;">Log In</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <!--<form action="../includes/log_ad_inc.php" method="post" enctype="multipart/form-data">-->
            <label for="usr">Username/Email</label>
            <input type="text" id="usr" name="usr">
            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="pwd">
            <br>
            <div class="button-container">
                <input type="submit" value="Log In" name="login">
                <a name="return" class="return" href="admin_panel.php">Return</a>
            </div>
        </form>
    </main>    
</body>
</html>
