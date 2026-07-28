<?php 
session_start(); 

// SECURITY CHECK 1: Are they logged in?
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php?msg=login_required");
    exit;
}

// SECURITY CHECK 2: Did they pass a game_id in the URL?
if(!isset($_GET['game_id'])) {
    header("Location: index.php");
    exit;
}

//connect to database
$host = "127.0.0.1";
$user = "admin";
$password = "admin"; 
$database = "gameboxd";
$conn = new mysqli($host, $user, $password, $database);

//get game title from game_id
$game_id = $_GET['game_id'];
$game_title_sql = "SELECT games.title
        FROM games
        WHERE games.id = ?";

$stmt = $conn->prepare($game_title_sql);
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result -> fetch_assoc();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Write a Review — GameBoxd</title>
    <link rel="stylesheet" href="styles.css" />

</head>
<body>
    <?php include 'header.php'; ?>  
    <div class="review-container">
        
        <h1>Review Game - <?php echo htmlspecialchars($row['title'])?></h1>
        <div class="review-card">
            <!-- This form sends the data to our new API script -->
            <form action="../api/submit_actions.php?type=review" method="POST">
                
                <!-- Hidden input so the server knows exactly which game is being reviewed -->
                <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($game_id); ?>">
                <input type="hidden" name="action" value="add">
                
                <label for="rating">Rating (1-5 Stars)</label>
                <select name="rating" id="rating" required>
                    <option value="" disabled selected>Select your rating...</option>
                    <option value="1">★☆☆☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="4">★★★★☆</option>
                    <option value="5">★★★★★</option>
                </select>

                <label>Played hours</label>
                <input type="number" id='played_hours' name="played_hours" required>

                <label for="rating_text">Your Review</label>
                <textarea name="rating_text" id="rating_text" placeholder="What did you think of the game?..." required></textarea>
                
                <button type="submit">Save to My Games</button>
            </form>
        </div>
    </div>
</body>
</html>