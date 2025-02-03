<?php
// Include database connection
include('includes/db.php');

// Get the book ID from the URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the book details from the database
$sql = "SELECT books.*, genres.name AS genre_name FROM books 
        INNER JOIN genres ON books.genre_id = genres.id 
        WHERE books.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the book exists
$book = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Header -->
    <?php include('header.php'); ?>

    <div class="container bg-light mt-4">
        <?php if ($book): ?>
            <h2 class="text-center"><?php echo htmlspecialchars($book['title']); ?></h2>
            
            <div class="row mt-4">
                <div class="col-md-4">
                    <!-- Book Cover -->
                    <img src="<?php echo !empty($book['cover_image']) ? 'admin/uploads/' . $book['cover_image'] : 'images/placeholder.jpg'; ?>" 
                         class="img-fluid" 
                         alt="<?php echo htmlspecialchars($book['title']); ?>">
                </div>
                <div class="col-md-8">
                    <!-- Book Details -->
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre_name']); ?></p>
                    <p><strong>Published On:</strong> <?php echo htmlspecialchars($book['publication_date']); ?></p>
                    <p><strong>Summary:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($book['summary'])); ?></p>
                    <a href="index.php" class="btn btn-secondary mt-3">Back to Catalog</a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">The requested book does not exist.</p>
            <a href="index.php" class="btn btn-secondary mt-3">Back to Catalog</a>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
