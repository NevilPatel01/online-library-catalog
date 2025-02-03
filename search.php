<?php

// Include database connection
include('includes/db.php');

// Initialize variables for search criteria
$title = '';
$author = '';
$genre = '';
$start_date = '';
$end_date = '';
$summary = '';

// Set the default number of results per page
$results_per_page = 10;

// Get the current page from URL (default is 1)
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

// Initialize the base SQL query
$sql = "SELECT books.*, genres.name AS genre_name FROM books 
        INNER JOIN genres ON books.genre_id = genres.id WHERE 1";

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare($sql);

// Handle normal search
if (isset($_GET['search'])) {
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';

    // Add search conditions for title and author
    if (!empty($title)) {
        $sql .= " AND books.title LIKE ?";
    }

    if (!empty($author)) {
        $sql .= " AND books.author LIKE ?";
    }
}

// Handle advanced search
if (isset($_GET['advanced_search'])) {
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $genre = $_GET['genre'] ?? '';
    $start_date = $_GET['start_date'] ?? '';
    $end_date = $_GET['end_date'] ?? '';
    $summary = $_GET['summary'] ?? '';

    if (!empty($title)) {
        $sql .= " AND books.title LIKE ?";
    }
    
    if (!empty($author)) {
        $sql .= " AND books.author LIKE ?";
    }

    if (!empty($genre)) {
        $sql .= " AND books.genre_id = ?";
    }

    if (!empty($start_date)) {
        $sql .= " AND books.publication_date >= ?";
    }

    if (!empty($end_date)) {
        $sql .= " AND books.publication_date <= ?";
    }

    if (!empty($summary)) {
        $sql .= " AND books.summary LIKE ?";
    }
}

// Add limit and offset for pagination
$sql .= " LIMIT ?, ?";

// Prepare the SQL query
$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$params = [];
$types = "";

// Add parameters based on search fields
if (!empty($title)) {
    $params[] = "%" . $title . "%";
    $types .= "s";
}

if (!empty($author)) {
    $params[] = "%" . $author . "%";
    $types .= "s";
}

if (!empty($genre)) {
    $params[] = $genre;
    $types .= "i";
}

if (!empty($start_date)) {
    $params[] = $start_date;
    $types .= "s";
}

if (!empty($end_date)) {
    $params[] = $end_date;
    $types .= "s";
}

if (!empty($summary)) {
    $params[] = "%" . $summary . "%";
    $types .= "s";
}

// Add pagination parameters
$params[] = $offset;
$params[] = $results_per_page;
$types .= "ii";

// Bind the parameters
$stmt->bind_param($types, ...$params);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch the data to display on the page
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Fetch genres for the advanced search dropdown
$sql_genres = "SELECT * FROM genres";
$genres_result = $conn->query($sql_genres);
$genres = [];
if ($genres_result->num_rows > 0) {
    while ($genre = $genres_result->fetch_assoc()) {
        $genres[] = $genre;
    }
}

// Get the total number of books for pagination
$sql_count = "SELECT COUNT(*) AS total FROM books INNER JOIN genres ON books.genre_id = genres.id WHERE 1";
if (!empty($title)) {
    $sql_count .= " AND books.title LIKE '%$title%'";
}
if (!empty($author)) {
    $sql_count .= " AND books.author LIKE '%$author%'";
}
if (!empty($genre)) {
    $sql_count .= " AND books.genre_id = '$genre'";
}
if (!empty($start_date)) {
    $sql_count .= " AND books.publication_date >= '$start_date'";
}
if (!empty($end_date)) {
    $sql_count .= " AND books.publication_date <= '$end_date'";
}
if (!empty($summary)) {
    $sql_count .= " AND books.summary LIKE '%$summary%'";
}

$count_result = $conn->query($sql_count);
$total_books = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_books / $results_per_page);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Header -->
    <?php include('header.php'); ?>

    <!-- Search Form -->
    <div class="container mt-4">
        <h2 class="text-center">Search Books</h2>

        <!-- Normal Search Form -->
        <form action="search.php" method="get">
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>">
                </div>
                <div class="col-md-4">
                    <input type="text" name="author" class="form-control" placeholder="Author" value="<?php echo htmlspecialchars($author); ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" name="search" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- Advanced Search Form -->
        <form action="search.php" method="get">
            <div class="row mb-4">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="author" class="form-control" placeholder="Author" value="<?php echo htmlspecialchars($author); ?>">
                </div>
                <div class="col-md-3">
                    <select name="genre" class="form-control">
                        <option value="">Select Genre</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre['id']; ?>" <?php echo ($genre['id'] == $genre) ? 'selected' : ''; ?>><?php echo $genre['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($start_date); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($end_date); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="summary" class="form-control" placeholder="Summary" value="<?php echo htmlspecialchars($summary); ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" name="advanced_search" class="btn btn-secondary w-100">Advanced Search</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- Results Display -->
        <h4>Results</h4>
        <?php if (!empty($books)): ?>
            <div class="row">
                <?php foreach ($books as $book): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="<?php echo !empty($book['cover_image']) ? 'admin/uploads/' . $book['cover_image'] : 'images/placeholder.jpg'; ?>" 
                                 class="card-img-top " 
                                 alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $book['title']; ?></h5>
                                <p class="card-text"><strong>Author:</strong> <?php echo $book['author']; ?></p>
                                <p class="card-text"><strong>Genre:</strong> <?php echo $book['genre_name']; ?></p>
                                <p class="card-text"><?php echo substr($book['summary'], 0, 150); ?>...</p>
                                <a href="book_details.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
        // Remove the 'page' parameter from $_GET
        $query_params = $_GET;
        unset($query_params['page']);
        
        for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&<?php echo http_build_query($query_params); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

        <?php else: ?>
            <p>No books found based on your search criteria.</p>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include('footer.php'); ?>
</body>
</html>
