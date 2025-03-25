<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        echo "Post added successfully!";
        header("Location: index.php");  // Redirect back to homepage
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
