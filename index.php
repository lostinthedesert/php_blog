<?php
require 'db.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ast.o</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Optional Bootstrap for styling -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    
    <!-- Optional custom styles -->
    <link rel="stylesheet" href="style.css?v2.4">
</head>
<body class="index">
    <h1 class="my-4">Agreeable Sharing Time Blog🍉</h1>

    <?php
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<div class='post-content'>" . $row['content'] . "</div>";
            echo "<p class='timestamp'>Posted on " . $row['created_at'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
