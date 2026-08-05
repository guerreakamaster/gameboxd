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
                <input type="text" name="title" required placeholder="Dark Souls 3">
                
                <label>Release Year</label>
                <input type="number" name="release_year" required placeholder="2016">
                
                <label>Genre</label>
                <input type="text" name="genre" required placeholder="Souls-like">

                <label>Developer</label>
                <input type="text" name="developer" required placeholder="FromSoftware">

                <label>Cover Image URL</label>
                <input type="text" name="image_url" required placeholder="www.images/game_image.jpg">
                
                <button type="submit">Save to Database!</button>
            </form>
        </div>
    </div>

    <!--Sweet alert 2 widget-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../api/admin.js"></script>
</body>
</html>