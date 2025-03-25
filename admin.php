<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Post</h1>
    <form action="process.php" method="POST">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Write your post here..." required></textarea><br>
        <button type="submit">Post</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
