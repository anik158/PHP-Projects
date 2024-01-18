<?php
require '../includes/header.php';
require '../config/config.php';
?>

<?php



if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

//grapping the data

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $select = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $select->execute([':id' => $id]);
    $user = $select->fetch();
    $oldEmail = $user->email;

}

if (isset($_POST['submit'])) {

    if (
        empty($_POST['name']) or empty($_POST['email']) or empty($_POST['username'])
        or empty($_POST['password'])
    ) {
        echo "<script>alert('One or more field empty')</script>";
    } else {
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

                $target_dir = "../auth/img/";
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



            $query = "UPDATE users SET name = :name, email = :email, username = :username,
                    password = :password, avatar = :avatar, about = :about WHERE id = :id";


            $update = $pdo->prepare($query);





            $update->execute([
                ":name" => $name,
                ":email" => $email,
                ":username" => $username,
                ":password" => $password,
                ":avatar" => $avatar,
                ":about" => $about,
                ":id" => $id
            ]);


            $topic_update_query = "UPDATE topics SET username = :new_username, user_image = :user_image WHERE username LIKE :old_username;";
            $topic_update = $pdo->prepare($topic_update_query);
            $topic_update->execute([
                ":new_username" => $email,
                ":user_image" => $avatar,
                ":old_username" => $oldEmail
            ]);


            $replies_update_query = "UPDATE replies SET username = :new_username, user_image = :user_image WHERE username LIKE :old_username;";
            $replies_update = $pdo->prepare($replies_update_query);
            $replies_update->execute([
                ":new_username" => $email,
                ":user_image" => $avatar,
                ":old_username" => $oldEmail
            ]);

            // Redirect or handle post-update logic
            header("location: ../index.php?msg=profileUpdateSuccessful");
        }


    }



}
?>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Update Profile</h1>
                    <h4 class="pull-right">Forum Account</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" enctype="multipart/form-data" method="post"
                        action="edit-user.php?id=<?php echo $user->id; ?>">
                        <div class="form-group">
                            <label>Update Name*</label> <input type="text" value="<?php echo $user->name; ?>"
                                class="form-control" name="name" placeholder="Update Your Name">
                        </div>
                        <div class="form-group">
                            <label>Update Email*</label> <input type="email" value="<?php echo $user->email; ?>"
                                class="form-control" name="email" placeholder="Update Your Email Address">
                        </div>
                        <div class="form-group">
                            <label>Update Username*</label> <input type="text" value="<?php echo $user->username; ?>"
                                class="form-control" name="username" placeholder="Update Your Username">
                        </div>
                        <div class="form-group">
                            <label>Update Password*</label> <input type="password" class="form-control" name="password"
                                placeholder="Update A Password">
                        </div>
                        <div class="form-group">
                            <label>Update Confirm Password*</label> <input type="password" class="form-control"
                                name="password2" placeholder="Enter Password Again">
                        </div>
                        <div class="form-group">
                            <label>Upload Avatar</label>
                            <input type="file" value="<?php echo $user->avatar; ?>" name="avatar">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label>Update About Me</label>
                            <textarea id="about" rows="6" cols="80" class="form-control" name="about"
                                placeholder="Tell us about yourself (Optional)">
                                <?php echo $user->about; ?>
                            </textarea>
                        </div>
                        <input name="submit" type="submit" class="color btn btn-default" value="Edit Profile" />
                    </form>
                </div>
            </div>
        </div>
        <?php require '../includes/footer.php'; ?>