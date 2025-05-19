<?php
require 'db.php'; // Include database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Checks if form was submitted
    if (isset($_POST["title"]) && isset($_POST["content"])) {  // Ensures fields exist
        // Trim input (removes leading/trailing spaces)
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);

        // Sanitize input (prevents XSS attacks)
        $title = $title;
        $content = $content;

        if (!empty($title) && !empty($content)) {  // Ensures fields are not empty
            //  Prepares the SQL query
            $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $title, $content);
            $stmt->execute();

             // Redirect to index.php after successful submission
            header("Location: index.php");
            exit(); // Always use exit() after a header redirect!
        
        } else {
            echo "<p style='color: red;'>Title and content are required!</p>";  // Error message
        }
    }
}
?>
<?php echo __FILE__; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
</head>
<body>
    <h1>Add a New Blog Post</h1>
    <form method="post" action="new_post.php">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea name="content" rows="5" cols="50" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
    <p><a href="index.php">Back to Blog</a></p>
</body>
</html>
