<?php
session_start();

// SECURITY GUARD: if not logged in - kick guest
if (!isset($_SESSION['role'])) {
    header("Location: index.php?error=unauthorised");
    exit;
}

$host = "127.0.0.1";
$user = "admin";
$password = "admin"; 
$database = "gameboxd";
$conn = new mysqli($host, $user, $password, $database);

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? 0;

// ON FIRST LOAD: Get the current review details to fill the form
if ($type === 'review') {
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reviewData = $result->fetch_assoc();
    $stmt->close();
    
    

    // If the review doesn't exist, kick them out
    if (!$reviewData) { header("Location: index.php"); exit; }
}
//get game title via review.game_id
$stmt = $conn->prepare("SELECT title from games where id = ?");
$stmt -> bind_param("i", $reviewData['game_id']);
$stmt -> execute();
$result = $stmt->get_result();
$game_title = $result->fetch_assoc();
$stmt->close();



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit review - Gameboxd</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <?php include 'header.php'; ?>  
    <div class="review-container">
        <h1>Edit review - <?php echo htmlspecialchars($game_title['title']); ?></h1>
        <div class="review-card">
        
            <form action="../api/submit_actions.php?type=review&id=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="action" value="update">
                <label>Stars</label>
                <select name="rating" id="rating" required>
                    <option value="" disabled selected>Select your rating...</option>
                    <option value="1">★☆☆☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="4">★★★★☆</option>
                    <option value="5">★★★★★</option>
                </select>
                
                <label>Played hours</label>
                <input type="number" name="played_hours" required value="<?php echo htmlspecialchars($reviewData['played_hours']); ?>">
                
                <label>Review text</label>
                <input type="text" name="rating_text" required value="<?php echo htmlspecialchars($reviewData['rating_text']); ?>">
                
                
                <button type="submit" style="background: #43a502">Update Data</button>
                
            </form>
            <form action="../api/submit_actions.php?type=review&id=<?php echo $id; ?>" method="POST">
                
                <input type="hidden" name="action" value="delete">
                <button type="submit" onclick="return confirm('Are you sure you want to delete this review? This cannot be undone.');" style="background: #9e0000">DELETE</button>
            </form>
            
                
        </div>
    </div>
</body>
</html>