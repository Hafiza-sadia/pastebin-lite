<?php
require "db.php";

if (!isset($_GET['slug'])) {
    die("❌ Snippet not found.");
}

$slug = $conn->real_escape_string($_GET['slug']);
$result = $conn->query("SELECT * FROM snippets WHERE slug='$slug' LIMIT 1");

if ($result->num_rows == 0) {
    die("❌ Snippet not found.");
}

$snippet = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($snippet['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- Prism.js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
</head>
<body style="background-image: url('hero-view.jpg');">
<header>
    <i class="fas fa-eye"></i> View Snippet
</header>

<div class="container">
    <h1><?php echo htmlspecialchars($snippet['title']); ?></h1>
    <pre><code class="language-<?php echo htmlspecialchars($snippet['language']); ?>">
<?php echo htmlspecialchars($snippet['code']); ?>
    </code></pre>

    <button id="copyBtn">📋 Copy Code</button>
</div>

<script>
document.getElementById("copyBtn").addEventListener("click", function() {
    let code = document.querySelector("pre code").innerText;
    navigator.clipboard.writeText(code).then(() => {
        alert("✅ Code copied!");
    });
});
</script>
</body>
</html>
