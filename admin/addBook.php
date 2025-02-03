<?php
// Include the database connection file
include('includes/db.php');

// Fetch genres from the database
$genres = [];
try {
    $stmt = $conn->query("SELECT id, name FROM genres");
    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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

<div class="container mt-5">
    <h2>Add New Book</h2>
    <!-- Form to add a new book -->
    <form action="addBook.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="BookTitle" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="BookTitle" name="BookTitle" required>
        </div>
        <div class="mb-3">
            <label for="Auther" class="form-label">Author</label>
            <input type="text" class="form-control" id="Auther" name="Auther" required>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea class="form-control" id="summary" name="summary" required></textarea>
        </div>
        <div class="mb-3">
            <label for="inputState" class="form-label">Genres</label>
            <select id="inputState" name="genres" class="form-select" required>
                <option selected disabled>Choose...</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Publication Date</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" required>
        </div>
        <div class="mb-3">
            <label for="coverimg" class="form-label">Cover Image</label>
            <input type="file" class="form-control" id="coverimg" name="coverimg" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'genres' is set and handle the value
    if (isset($_POST['genres'])) {
        $genre_id = $_POST['genres'];
    } else {
        echo "Please select a genre.";
        exit;
    }

    // Fetch other form data
    $title = $_POST['BookTitle'];
    $author = $_POST['Auther'];
    $summary = $_POST['summary'];
    $publication_date = !empty($_POST['publication_date']) ? $_POST['publication_date'] : date('Y-m-d');

    // Handle file upload
    $cover_image = null;
    if (isset($_FILES['coverimg']) && $_FILES['coverimg']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        $coverImageName = time() . '_' . basename($_FILES['coverimg']['name']);
        $uploadFilePath = $uploadDir . $coverImageName;

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['coverimg']['tmp_name'], $uploadFilePath)) {
            $cover_image = $coverImageName;
        } else {
            echo "Error: Unable to move the uploaded file.";
            exit;
        }
    }

    // Insert data into the database
    try {
        $stmt = $conn->prepare("INSERT INTO books (title, author, summary, genre_id, cover_image, publication_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $summary, $genre_id, $cover_image, $publication_date]);

        // Redirect to avoid form resubmission on refresh
        header("Location: manageBooks.php");
        exit;  // Ensure no further code is executed after the header() call
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
