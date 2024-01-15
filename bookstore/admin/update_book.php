<!DOCTYPE html>
<html>

<head>
    <title>Admin Update Book</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Book</h2>
        <form action="update_book_php.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="book_id">Select Book:</label>
                <select class="form-control" id="book_id" name="book_id">
                    <?php
                    $host = 'localhost';
                    $dbname = 'bookstore';
                    $username = 'root';
                    $password = '';

                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT id, title FROM book";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="new_title">New Title:</label>
                <input type="text" class="form-control" id="new_title" name="new_title" required>
            </div>
            <div class="form-group">
                <label for="new_author">New Author:</label>
                <input type="text" class="form-control" id="new_author" name="new_author">
            </div>
            <div class="form-group">
                <label for="new_publication_year">New Publication Year:</label>
                <input type="number" class="form-control" id="new_publication_year" name="new_publication_year">
            </div>
            <div class="form-group">
                <label for="new_ISBN">New ISBN:</label>
                <input type="text" class="form-control" id="new_ISBN" name="new_ISBN">
            </div>
            <div class="form-group">
                <label for="new_price">New Price:</label>
                <input type="number" step="0.01" class="form-control" id="new_price" name="new_price" required>
            </div>
            <div class="form-group">
                <label for="new_description">New Description:</label>
                <textarea class="form-control" id="new_description" name="new_description"></textarea>
            </div>

            <div class="form-group">
                <label for="image">New Cover:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a class="btn btn-secondary" href="ad_index.php">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
