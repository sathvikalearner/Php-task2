<?php
session_start();
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h2>Add New Post</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" required />
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="6" required></textarea>
        </div>

        <button type="submit" name="submit" class="submit-btn">Create Post</button>
    </form>
</div>

</body>
</html>
