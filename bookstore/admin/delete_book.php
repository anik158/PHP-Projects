<!DOCTYPE html>
<html>
<head>
    <title>Admin Delete Book</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Delete Book</h2>
        <form action="delete_book_php.php" method="POST">

            <div class="form-group">
                <label for="book_id">Select Book to Delete:</label>
                <select class="form-control" id="book_id" name="book_id">
                    <?php
                    include '../dbh.php'; 

                    try {
                        $sql = "SELECT id, title FROM book";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
            <a class="btn btn-secondary" href="ad_index.php">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
