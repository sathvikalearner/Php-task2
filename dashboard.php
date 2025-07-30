<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all records from 'posts' table
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Welcome, Dileep</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <a href="create.php" class="add-btn">+ Add New Post</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['content']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td class="action-btns">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this post?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
