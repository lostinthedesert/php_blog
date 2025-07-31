<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $id = $_POST['id'];
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]); // This will be HTML from Quill

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    echo "<p>Post updated! <a href=\"edit_post.php\">Back to list</a> | <a href=\"index.php\">Back to main page</a></p>";
} elseif (isset($_GET['id'])) {
    // Show the edit form for a given post
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Post</title>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            #editor { height: 300px; background: #fff; }
        </style>
    </head>
    <body>
        <h1>Edit Post</h1>
        <form method="POST" onsubmit="return prepareSubmit()">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <label>Title:</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required><br><br>

            <label>Content:</label>
            <div id="editor"><?= $content ?></div>

            <!-- Hidden input to capture Quill content -->
            <input type="hidden" name="content" id="content">
            <br>
            <button type="submit">Update</button>
        </form>

        <!-- Quill Scripts -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            // Set Quill content to match what's stored in DB
            quill.root.innerHTML = <?= json_encode($content) ?>;

            function prepareSubmit() {
                document.getElementById('content').value = quill.root.innerHTML;
                return true;
            }
        </script>
    </body>
    </html>

    <?php
} else {
    // List all posts for selection
    $result = $conn->query("SELECT id, title FROM posts ORDER BY created_at DESC");
    echo "<h1>Select a Post to Edit</h1><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='edit_post.php?id={$row['id']}'>" . htmlspecialchars($row['title']) . "</a></li>";
    }
    echo "</ul>";
}
?>
