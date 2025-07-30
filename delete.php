<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: dashboard.php');
    exit;
}

// Get ID from URL (for confirmation page)
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="delete-container">
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete this post?</p>

    <div class="delete-buttons">
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <button type="submit" name="confirm_delete" class="confirm-delete">Yes, Delete</button>
        </form>

        <a href="dashboard.php" class="cancel-btn">Cancel</a>
    </div>
</div>

</body>
</html>
