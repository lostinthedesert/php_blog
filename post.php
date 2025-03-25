<?php
require 'db.php';

$id = $_GET['id'] ?? 1;  // Get post ID from URL
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $post['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?= $post['title']; ?></h1>
    <p><?= $post['content']; ?></p>
    <a href="index.php">Back to Home</a>
</body>
</html>
