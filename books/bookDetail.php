<?php
include '../header.php';
include '../includes/functions.php';

$book_id = $_GET['id'];
$book = getBookById($book_id);
$comments = getCommentsByBookId($book_id);

?>

<div class="container">
    <h2><?php echo $book['title']; ?></h2>
    <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
    <p><strong>Summary:</strong> <?php echo $book['summary']; ?></p>
    <img src="assets/img/<?php echo $book['cover_image']; ?>" alt="Book Cover">
    
    <h3>Comments</h3>
    <?php foreach ($comments as $comment) { ?>
        <p><?php echo $comment['content']; ?> - <em>By User <?php echo $comment['user_id']; ?></em></p>
    <?php } ?>

    <form method="POST" action="addComment.php">
        <textarea name="comment" class="form-control" required></textarea>
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
</div>

<?php include '../footer.php'; ?>
