<?php
require "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST["title"]);
    $code  = $conn->real_escape_string($_POST["code"]);
    $lang  = $conn->real_escape_string($_POST["language"]);
    $visibility = $conn->real_escape_string($_POST["visibility"]);

    $slug = substr(md5(uniqid(mt_rand(), true)), 0, 8);

    $sql = "INSERT INTO snippets (title, code, language, visibility, slug)
            VALUES ('$title', '$code', '$lang', '$visibility', '$slug')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Snippet saved! <a href='view.php?slug=$slug'>View here</a>";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Snippet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url('hero-create.jpg');">
<header>
    <i class="fas fa-pen"></i> Create Snippet
</header>

<div class="container">
    <?php if ($message) echo "<p>$message</p>"; ?>

    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Code:</label>
        <textarea name="code" rows="8" required></textarea>

        <label>Language:</label>
        <input type="text" name="language" placeholder="php, js, html..." required>

        <label>Visibility:</label>
        <select name="visibility">
            <option value="public">Public</option>
            <option value="unlisted">Unlisted</option>
        </select>

        <button type="submit">Save Snippet</button>
    </form>
</div>
</body>
</html>
