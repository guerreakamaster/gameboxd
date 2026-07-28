<?php
session_start();

// SECURITY GUARD: Admin only!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?error=unauthorised");
    exit;
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Add New Game</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <?php include 'header.php'; ?>  
    <div class="admin-container">
        <h1>Add New Game</h1>
        <div class="admin-card">

            <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

            <form action="../api/submit_actions.php?type=game" method="POST">
            <input type="hidden" name="action" value="add">

                <label>Game Title</label>
                <input type="text" name="title" required placeholder="e.g. Dark Souls 3">
                
                <label>Release Year</label>
                <input type="year" name="year" required placeholder="e.g. 2016">
                
                <label>Genre</label>
                <input type="text" name="genre" required placeholder="e.g. Souls-like">

                <label>Developer</label>
                <input type="text" name="developer" required placeholder="e.g. FromSoftware">

                <label>Cover Image URL</label>
                <input type="text" name="image_url" required placeholder="e.g. www.images/darksouls3.jpg">
                
                <button type="submit">Save to Database</button>
            </form>
        </div>
    </div>
</body>
</html>