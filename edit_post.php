<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    echo "<p>Post updated! <a href=\"edit_post.php\">Back to list</a> or <a href=\"index.php\">Back to Home</a></p>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();
    $stmt->close();

    $editing = true;
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
            <h1>Edit Blog Post</h1>
            <?php require 'post_form.php';
            exit; ?>
        </body>
    </html>
<?php }

// List all posts
$result = $conn->query("SELECT id, title FROM posts ORDER BY created_at DESC");
echo "<h1>Select a Post to Edit</h1><ul>";
while ($row = $result->fetch_assoc()) {
    $safeTitle = htmlspecialchars($row['title']);
    echo "<li><a href='edit_post.php?id={$row['id']}'>{$safeTitle}</a></li>";
}
echo "</ul>";