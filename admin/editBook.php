<?php
// Include database connection
include('includes/db.php');

// Check if the id is passed via GET request
if (isset($_GET['id'])) {
    $book_id = (int) $_GET['id'];

    // Fetch book details
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$book_id]);
    $book = $stmt->fetch();

    if (!$book) {
        echo "Book not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Check if form is submitted to update book details
if (isset($_POST['update_book'])) {
    // Get data from the form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $summary = $_POST['summary'];
    $genre_id = $_POST['genre_id'];
    $cover_image = $_FILES['cover_image']['name'];
    $publication_date = $_POST['publication_date'];

    // Handle cover image upload
    if (!empty($cover_image)) {
        $upload_dir = 'uploads/';
        $cover_image_path = $upload_dir . basename($cover_image);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_path);
    } else {
        $cover_image = $book['cover_image']; // Keep the existing image if not uploaded
    }

    // Update the book information
    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, summary = ?, genre_id = ?, cover_image = ?, publication_date = ? WHERE id = ?");
    $stmt->execute([$title, $author, $summary, $genre_id, $cover_image, $publication_date, $book_id]);

    if ($stmt->rowCount() > 0) {
        header('Location: manageBooks.php'); // Redirect back to manageBooks page
        exit;
    } else {
        echo "Error updating book!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include('adheader.php'); ?>

<!-- HTML Form for editing the book -->
<div class="d-flex col-12 justify-content-center">
    <div class="col-6 p-5">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group m-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="form-group m-2">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            </div>
            <div class="form-group m-2">
                <label for="summary">Summary</label>
                <textarea class="form-control" name="summary" required><?php echo htmlspecialchars($book['summary']); ?></textarea>
            </div>
            <div class="form-group m-2">
                <label for="genre_id">Genre</label>
                <select class="form-control" name="genre_id" required>
                    <?php
                    $genre_sql = "SELECT * FROM genres";
                    $genre_result = $pdo->query($genre_sql);
                    while ($genre = $genre_result->fetch()) {
                        echo "<option value='" . $genre['id'] . "' " . ($genre['id'] == $book['genre_id'] ? 'selected' : '') . ">" . htmlspecialchars($genre['name']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group m-2">
                <label for="cover_image">Cover Image</label>
                <input type="file" class="form-control" name="cover_image">
            </div>
            <div class="form-group m-2">
                <label for="publication_date">Publication Date</label>
                <input type="date" class="form-control" name="publication_date" value="<?php echo htmlspecialchars($book['publication_date']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary m-2" name="update_book">Update Book</button>
        </form>
    </div>
</div>

<?php include('adfooter.php'); ?>

</body>
</html>
