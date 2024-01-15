<?php
$host = 'localhost';
$dbname = 'bookstore';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submit'])) {
        $randomString = generateRandomString(10);
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publication_year = $_POST['publication_year'];
        $ISBN = $_POST['ISBN'];
        $price = $_POST['price'];
        $description = $_POST['description'];

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

        $sql = "INSERT INTO book (id, title, author, publication_year, ISBN, price, description, image_url)
                VALUES (:id, :title, :author, :publication_year, :ISBN, :price, :description, :image_url)";

        $stmt = $pdo->prepare($sql);


        $stmt->bindParam(':id', $randomString);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':publication_year', $publication_year);
        $stmt->bindParam(':ISBN', $ISBN);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image_url', $image_url);


        $stmt->execute();

        echo "Book inserted successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function generateRandomString($length = 10)
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