<?php
session_start();

// SECURITY GUARD
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?error=unauthorised");
    exit;
}

require_once __DIR__ . '/../api/db.php';

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? 0;


// ON FIRST LOAD: Get the current game details to fill the form
if ($type === 'game') {
    $stmt = $conn->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $gameData = $result->fetch_assoc();
    $stmt->close();
    
    // If the game doesn't exist, kick them out
    if (!$gameData) { header("Location: index.php"); exit; }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Game — GameBoxd</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <?php include 'header.php'; ?>  
    <div class="admin-container">
        <h1>Edit Game - <?php echo htmlspecialchars($gameData['title']); ?></h1>
        <div class="admin-card">
        
            <form action="../api/submit_actions.php?type=game&id=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="action" value="update">

                <label>Game Title</label>
                <input type="text" name="title" required value="<?php echo htmlspecialchars($gameData['title']); ?>">
                
                <label>Release Year</label>
                <input type="number" name="release_year" required value="<?php echo htmlspecialchars($gameData['release_year']); ?>">
                
                <label>Genre</label>
                <input type="text" name="genre" required value="<?php echo htmlspecialchars($gameData['genre']); ?>">

                <label>Developer</label>
                <input type="text" name="developer" required value="<?php echo htmlspecialchars($gameData['developer']); ?>">

                <label>Cover Image URL</label>
                <input type="text" name="image_url" required value="<?php echo htmlspecialchars($gameData['image_url']); ?>">
                
                <button type="submit" style="background: #43a502">Update Data</button>

            </form>
            <form action="../api/submit_actions.php?type=game&id=<?php echo $id; ?>" method="POST">
                
                <input type="hidden" name="action" value="delete">
                <button type="submit" onclick="return confirm('Are you sure you want to delete this game? This cannot be undone.');" style="background: #9e0000">DELETE</button>
            </form>
        </div>
    </div>

    <!--Sweet alert 2 widget-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../api/admin.js"></script>
</body>
</html>