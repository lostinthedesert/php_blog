<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    echo "<p>Post published! <a href=\"new_post.php\">Create another</a> or <a href=\"index.php\">Go back Home</a></p>";
    exit;
}

$title = '';
$content = '';
$editing = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v2.4">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
</head>
<body class="new_post">
    <h1>Add a New Blog Post</h1>
    <?php require 'post_form.php'; ?>
    <p><a href="index.php">Back to Blog</a></p>
</body>
</html>
