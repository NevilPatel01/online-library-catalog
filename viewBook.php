<?php
// Include database connection
include('includes/db.php');

// Check if the id is passed via GET request
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    
    // Query to fetch the book by id
    $sql = "SELECT books.*, genres.name AS genre_name FROM books INNER JOIN genres ON books.genre_id = genres.id WHERE books.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found!";
    }
} else {
    echo "Invalid request!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- HTML to display book details -->
<div  class=" d-flex flex-col col-12 justify-content-center p-5">
    <div class="p-5 shadow">
       <h3><?php echo $book['title']; ?></h3>
       <div>
          <img style="height: 400px;" class="img-fluid mt-2 m" src="uploads/<?php echo $book['cover_image']; ?>" alt="Cover Image">
       </div>
       <div class="d-flex justify-content-center m-2 shadow p-3">
          <p class="m-2"><strong>Author:</strong> <?php echo $book['author']; ?></p>
          <p class="m-2"><strong>Genre:</strong> <?php echo $book['genre_name']; ?></p>
          <p class="m-2"><strong>Publication Date:</strong> <?php echo $book['publication_date']; ?></p>
       </div>
       <div class="p-3 m-5 d-flex col-6 justify-content-center shadow">
          <p><strong>Summary:</strong> <?php echo $book['summary']; ?></p>
       </div>
       <a class="nav-link m-4 p-2 col-3 text-light text-center bg-primary" href="manageBooks.php">Back to Desh</a>
    </div>
</div>
</body>