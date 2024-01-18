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
    $select = $pdo->prepare("SELECT * FROM replies WHERE id = :id");
    $select->execute([':id' => $id]);
    $reply_up = $select->fetch();

    if ($reply_up->username !== $_SESSION['email']) {
        header('location: ../index.php');
    }

}

if (isset($_POST['repsubmit'])) {

    if (empty($_POST['reply'])) {
        echo "<script>alert('Reply field is empty. ')</script>";
    } else {

        $reply = $_POST['reply'];


        $query = "UPDATE replies SET reply = :reply WHERE id = :id";

        $update = $pdo->prepare($query);


        if (
            !$update->execute([
                ":reply" => $reply,
                ":id" => $reply_up->id
            ])
        ) {
            var_dump($update->errorInfo());
            exit;
        }




        if ($update->rowCount() > 0) {
            header("location: ../index.php");
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
                    <h1 class="pull-left">Update Reply</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="post" action="rep_update.php?id=<?php echo $reply_up->id; ?>">

                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply">
                                <?php echo $reply_up->reply;?>
                            </textarea>
                            <script>
                                CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button type="submit" name="repsubmit" class="color btn btn-default">Update Reply</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require '../includes/footer.php'; ?>