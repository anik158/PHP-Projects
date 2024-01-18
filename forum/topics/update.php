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
    $select = $pdo->prepare("SELECT * FROM topics WHERE id = :id");
    $select->execute([':id' => $id]);
    $topic = $select->fetch();

    if ($topic->username !== $_SESSION['email']) {
        header('location: ../index.php');
    }
}

if (isset($_POST['submit'])) {

    if (empty($_POST['title']) or empty($_POST['category']) or empty($_POST['body'])) {
        echo "<script>alert('One or more field empty')</script>";
    } else {

        $title = $_POST['title'];
        $cat = $_POST['category'];
        $body = $_POST['body'];
        $username = $topic->username;
        $user_image = $topic->user_image;


        $query = "UPDATE topics SET title = :title,category = :category, body = :body,
                    username = :username,user_image = :user_image WHERE id = :id";

        $update = $pdo->prepare($query);


        if (
            !$update->execute([
                ":title" => $title,
                ":category" => $cat,
                ":body" => $body,
                ":username" => $username,
                ":user_image" => $user_image,
                ":id" => $topic->id
            ])
        ) {
            var_dump($update->errorInfo());
            exit;
        }




        if ($update->rowCount() > 0) {
            header("location: /index.php?msg=topicUpdated");
            exit;
        } else {
            echo "<script>alert('Update failed.')</script>";
        }


    }



}
?>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Update Topic</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="post" action="update.php?id=<?php echo $topic->id ?>">
                        <div class="form-group">
                            <label>Update Title</label>
                            <input type="text" value="<?php echo $topic->title; ?>" class="form-control" name="title"
                                placeholder="Enter Post Title">
                        </div>

                        <div class="form-group">
                            <label>Update Category</label>
                            <select name="category" class="form-control">
                                <option value="Design">Design</option>
                                <option value="Development">Development</option>
                                <option value="Business & Marketing">Business & Marketing</option>
                                <option value="Search Engines">Search Engines</option>
                                <option value="Cloud & Hosting">Cloud & Hosting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Update Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body">
                            <?php echo $topic->body; ?>
                            </textarea>
                            <script>CKEDITOR.replace('body');</script>
                        </div>
                        <button name="submit" type="submit" class="color btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require '../includes/footer.php'; ?>