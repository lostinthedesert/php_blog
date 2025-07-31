<!-- post_form.php -->
<form method="POST" onsubmit="return prepareSubmit()">
    <?php if (isset($editing) && $editing): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <?php endif; ?>

    <label>Title:</label><br>
    <input type="text" class="new_post" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required><br><br>

    <label>Content:</label>
    <div id="editor-container">
        <div id="editor" style="height: 400px;"><?= $content ?? '' ?></div>

        <input type="hidden" name="content" id="content">
        <br>
        <button type="submit"><?= $editing ? 'Update' : 'Publish' ?></button>
    </div>
</form>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    const quill = new Quill('#editor', { theme: 'snow' });
    quill.root.innerHTML = <?= json_encode($content ?? '') ?>;

    function prepareSubmit() {
        document.getElementById('content').value = quill.root.innerHTML;
        return true;
    }
</script>
