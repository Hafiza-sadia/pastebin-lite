<?php
require "db.php";
$result = $conn->query("SELECT * FROM snippets WHERE visibility='public' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pastebin Lite - Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body style="background-image: url('hero-home.jpg');">
<header>
    <i class="fas fa-code"></i> Pastebin Lite
</header>

<div class="container">
    <a class="btn" href="create.php"><i class="fas fa-plus-circle"></i> Create Snippet</a>

    <h2><i class="fas fa-globe"></i> Public Snippets</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="snippet-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="snippet-card">
                <h3>
                    <a href="view.php?slug=<?php echo $row['slug']; ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </h3>
                <p class="meta">
                    <i class="fas fa-code"></i> <?php echo $row['language']; ?> • 
                    <i class="far fa-clock"></i> <?php echo date("M d, Y H:i", strtotime($row['created_at'])); ?>
                </p>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No public snippets yet. Be the first to <a href="create.php">add one</a> 🚀</p>
    <?php endif; ?>
</div>
</body>
</html>

