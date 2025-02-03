<?php
// Include database connection
include('includes/db.php');

// Query to fetch books and join with genres table to get genre names
$sql = "SELECT books.*, genres.name AS genre_name FROM books 
        INNER JOIN genres ON books.genre_id = genres.id 
        ORDER BY books.created_at DESC";
$result = $conn->query($sql);

// Fetch the data to display on the page
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Catalog - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Header -->
    <?php include('header.php'); ?>

    <!-- Main Content Area -->
    <div class="container mt-4">
        <h2 class="text-center">Library Catalog</h2>
        
        <?php if (!empty($books)): ?>
            <div class="row">
                <?php foreach ($books as $book): ?>
                    <div class="col-md-4 p-4 mb-1">
                        <div class="card">
                            <!-- Display the book cover image -->
                            <img src="<?php echo !empty($book['cover_image']) ? 'admin/uploads/' . $book['cover_image'] : 'images/placeholder.jpg'; ?>" 
                                 class="card-img " 
                                 alt="<?php echo htmlspecialchars($book['title']); ?>">
                            
                            <div class="card-body">
                                <h5 class="card-title mt-2"><?php echo htmlspecialchars($book['title']); ?></h5>
                                <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                                <p class="card-text mb-2"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre_name']); ?></p>
                                <a href="book_details.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No books available at the moment.</p>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
