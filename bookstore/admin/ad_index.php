<?php session_start(); if (isset($_SESSION['name'])): ?>
    <!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">Admin Dashboard</h1>
    <div class="container">

        <form name="submit" action="#" method="post">

            <a name="add" href="insert_book.php" class="btn btn-primary">Add Book</a>
            <a name="up" href="update_book.php" class="btn btn-success">Update Book</a>
            <a name="del" href="delete_book.php" class="btn btn-danger">Delete Book</a>
            <a name="acc" href="ad_account.php" class="btn btn-info">Account</a>
            <a name="site" href="../index.php" class="btn btn-secondary">Go to Website</a>
            <a name="site" href="ad_logout.php" class="btn btn-danger">Logout</a>

        </form>
    </div>
</body>

</html>
                <?php else: header("Location: admin_login.php");
                    
                endif; ?>

