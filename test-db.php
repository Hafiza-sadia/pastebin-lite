<?php
require "db.php";

echo "<h2>🔍 Pastebin Lite Test Page</h2>";

// ✅ Check DB connection
if ($conn->ping()) {
    echo "<p style='color:green;'>✅ Database connection successful!</p>";
} else {
    die("<p style='color:red;'>❌ Database connection failed.</p>");
}

// ✅ Insert dummy snippet
$title = "Test Snippet " . rand(100,999);
$code = "<?php echo 'Hello World'; ?>";
$lang = "php";
$visibility = "public";
$slug = substr(md5(uniqid(mt_rand(), true)), 0, 8);

$sql = "INSERT INTO snippets (title, code, language, visibility, slug)
        VALUES ('$title', '$code', '$lang', '$visibility', '$slug')";

if ($conn->query($sql) === TRUE) {
    echo "<p style='color:green;'>✅ Dummy snippet inserted: <a href='view.php?slug=$slug'>View here</a></p>";
} else {
    echo "<p style='color:red;'>❌ Error inserting snippet: " . $conn->error . "</p>";
}

// ✅ Fetch latest snippets
$result = $conn->query("SELECT * FROM snippets ORDER BY created_at DESC LIMIT 5");

echo "<h3>📋 Last 5 Snippets</h3>";
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><b>{$row['title']}</b> ({$row['language']}) - <a href='view.php?slug={$row['slug']}'>View</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No snippets found.</p>";
}
?>
