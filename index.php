<?php
require 'db.php';  // Include database connection

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Blog</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v1.0">
</head>
<body>
    <h1>Pando Blog</h1>
    
    <!-- // Fetch blog posts -->
    <?php
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo '<p class="timestamp">' . nl2br(htmlspecialchars($row['created_at'])) . '</p>';
            echo "<hr>";
        }
    } else {
        echo "<p>No posts found.</p>";
    }
    
    $conn->close();
    ?>


</body>
</html>
