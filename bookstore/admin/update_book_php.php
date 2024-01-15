<?php
$host = 'localhost';
$dbname = 'bookstore';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['update'])) {
        $book_id = $_POST['book_id'];
        $new_title = $_POST['new_title'];
        $new_author = $_POST['new_author'];
        $new_publication_year = $_POST['new_publication_year'];
        $new_ISBN = $_POST['new_ISBN'];
        $new_price = $_POST['new_price'];
        $new_description = $_POST['new_description'];


        if (isset($_FILES['image'])) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_type = $_FILES['image']['type'];
            $image_size = $_FILES['image']['size'];


            $extension = pathinfo($image_name, PATHINFO_EXTENSION);


            $allowed_extensions = ['png', 'jpeg', 'jpg'];


            if (!in_array($extension, $allowed_extensions)) {
                echo "Only .png, .jpeg, and .jpg files are allowed.";
                exit();
            }

            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $target_file = $target_dir . basename($image_name);

            if (move_uploaded_file($image_tmp_name, $target_file)) {
                $image_url = $target_file;
            } else {
                echo "Error uploading the image.";
                exit();
            }
        } else {
            $image_url = '';
        }

        $sql = "UPDATE book
                SET title = :title, author = :author, publication_year = :publication_year,
                    ISBN = :ISBN, price = :price, description = :description, image_url = :image_url
                WHERE id = :book_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':title', $new_title);
        $stmt->bindParam(':author', $new_author);
        $stmt->bindParam(':publication_year', $new_publication_year);
        $stmt->bindParam(':ISBN', $new_ISBN);
        $stmt->bindParam(':price', $new_price);
        $stmt->bindParam(':description', $new_description);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':book_id', $book_id);

        $stmt->execute();

        echo "Book updated successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
