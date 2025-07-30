<?php
session_start();
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get post ID from URL
$id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header('Location: dashboard.php');
    exit;
}

// Fetch post to edit
$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h2>Edit Post</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>" required />
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="6" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <button type="submit" name="update" class="update-btn">Update Post</button>
    </form>
</div>

</body>
</html>
