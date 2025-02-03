<?php

// Include database connection
include('includes/db.php');

// Query to fetch books and join with genres table to get genre names
$sql = "SELECT books.*, genres.name AS genre_name FROM books INNER JOIN genres ON books.genre_id = genres.id ORDER BY books.created_at DESC";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Include Header -->
    <?php include('adheader.php'); ?>

    <!-- Main Content Area -->
    <div class="d-flex ">
        <div class="col-2 m-1 text-light bg-dark " style="height: 800px;">
            <div class="d-flex m-5 justify-content-center ">
                <img class="lg-20" src="" alt="">
                <h3>ManageBooks</h3>
            </div>
            <div class="p-3 d-flex p-2 m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageAdmins.php">Admin</a>
            </div>
            <div class="p-3 d-flex p-2 m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageBooks.php">Add NewBook</a>
            </div>
            <div class="p-3 d-flex p-2 m-2 bg-primary justify-content-center">
                <a class="nav-link " href="manageUsers.php">Users</a>
            </div>
        </div>

        <div style="height:800px" class="col-9  justify-content-center d-flex mt-0 m-5 p-2  ">
            <div class="col-7 overflow-scroll p-4 m-1 shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Book-Id</th>
                            <th scope="col">Book-Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <th scope="row"><?php echo $book['id']; ?></th>
                                <td><?php echo $book['title']; ?></td>
                                <td>
                                    <!-- Edit Button - Redirect to edit page with book id -->
                                    <a class="btn btn-sm btn-primary" href="editBook.php?id=<?php echo $book['id']; ?>" role="button">Edit</a>

                                    <!-- View Button - Redirect to view page with book id -->
                                    <a class="btn btn-sm btn-dark" href="viewBook.php?id=<?php echo $book['id']; ?>" role="button">View</a>

                                    <!-- Delete Button - Redirect to delete action with book id -->
                                    <a class="btn btn-sm btn-danger" href="deleteBook.php?id=<?php echo $book['id']; ?>" role="button" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6 m-1 p-4 shadow">
                <?php include('addBook.php'); ?>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include('adfooter.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
