<?php
include '../dbh.php';
$pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['delete'])) {
    $book_id = $_POST['book_id'];

    try {
        $sql = "DELETE FROM book WHERE id = :book_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();

        echo "Book deleted successfully!";
        
        header("Location: ad_index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
