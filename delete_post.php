<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: edit_post.php?deleted=1");
            exit;
        } else {
            echo "Error deleting post.";
        }
        $stmt->close();
    } else {
        echo "Invalid post ID.";
    }
} else {
    // Disallow GET requests
    header('HTTP/1.1 405 Method Not Allowed');
    echo "This endpoint only accepts POST requests.";
}
?>
