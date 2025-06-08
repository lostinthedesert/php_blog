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

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v2.4">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
</head>
<body class="new_post">
    <h1>Add a New Blog Post</h1>
    <form method="post" action="new_post.php">
        <label for="title">Title:</label>
        <input class="new_post" type="text" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <div id="editor-container">
          <div id="editor" style="height: 400px;"></div>
          <input type="hidden" name="content" id="content">
          <button type="submit">Submit</button>
        </div>
    </form>
    <p><a href="index.php">Back to Blog</a></p>
    <script>
      var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link']
          ]
        }
      });

  // On form submit, copy Quill content into the hidden input
  document.querySelector('form').addEventListener('submit', function () {
    document.querySelector('#content').value = quill.root.innerHTML;
  });
</script>

</body>
</html>
