<?php
/*
form submissions bring here, does each method depending on the hidden 'action' variable
add -> inserts new game to the DB
update -> updates the data of the selected game[id]
delete -> deletes the game[id] from the database
*/
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

require_once __DIR__ . '/db.php';


$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) die("Database connection failed.");

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'game' && isset($_POST['action']) && $_POST['action'] === 'add') {


    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $developer = $_POST['developer'];
    $image_url = $_POST['image_url'];

    // Insert into the games table
    $stmt = $conn->prepare("INSERT INTO games (title, release_year, genre, developer, image_url) VALUES (?, ?, ?, ?, ?)");
    // "siiss" means: String, Integer, String, String, String
    $stmt->bind_param("sisss", $title, $release_year, $genre, $developer, $image_url);

    try {
        $stmt->execute();
        header("Location: ../web/index.php?msg=game_added");
        exit;
    } catch (mysqli_sql_exception $e) {
        // 1062 is the duplicate key error. The games table has a UNIQUE on
        // (title, release_year), so this means the game is already in the catalogue.
        $error = ($e->getCode() === 1062) ? 'duplicate' : 'save_failed';
        header("Location: ../web/add_game.php?error=" . $error);
        exit;
    }
}
//update
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'game' && isset($_POST['action']) && $_POST['action'] === 'update') {

    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $developer = $_POST['developer'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("UPDATE games SET title=?, release_year=?, genre=?, developer=?, image_url=? WHERE id=?");

    $stmt->bind_param("sisssi", $title, $release_year, $genre, $developer, $image_url, $id);

    try {
        $stmt->execute();
        header("Location: ../web/index.php?msg=game_updated");
        exit;
    } catch (mysqli_sql_exception $e) {
        // Renaming a game onto a title and year that already exist hits the same UNIQUE.
        $error = ($e->getCode() === 1062) ? 'duplicate' : 'save_failed';
        header("Location: ../web/edit_game.php?type=game&id=" . (int) $id . "&error=" . $error);
        exit;
    }
}
//delete actions
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'game' && isset($_POST['action']) && $_POST['action'] === 'delete') {

    $stmt = $conn->prepare("DELETE FROM games WHERE id = ?");
    $stmt->bind_param("i", $id);

    try {
        $stmt->execute();
        header("Location: ../web/index.php?msg=game_deleted");
        exit;
    } catch (mysqli_sql_exception $e) {
        header("Location: ../web/index.php?error=save_failed");
        exit;
    }
}

//######################################################################
//########################### REVIEWS ACTIONS ##########################
//######################################################################


//ADD NEW REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $game_id = $_POST['game_id'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $rating_text = $_POST['rating_text'] ?? '';
    $played_hours = $_POST['played_hours'] ?? '';

    // Basic validation so we don't save empty data
    if (empty($game_id) || empty($rating) || empty($rating_text)) {
        die("All fields are required.");
    }

    // save the review into the database
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, game_id, rating, rating_text, played_hours) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $user_id, $game_id, $rating, $rating_text, $played_hours);

    try {
        $stmt->execute();
        header("Location: ../web/index.php?msg=review_saved");
        exit;
    } catch (mysqli_sql_exception $e) {
        header("Location: ../web/index.php?error=save_failed");
        exit;
    }
}


// UPDATE REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review'&& isset($_POST['action']) && $_POST['action'] === 'update') {
    $rating = $_POST['rating'];
    $played_hours = $_POST['played_hours'];
    $rating_text = $_POST['rating_text'];

    $stmt = $conn->prepare("UPDATE reviews SET rating=?, played_hours=?, rating_text=? WHERE id=?");
    // "sisssi" = String, Int, String, String, String, Int (the ID)
    $stmt->bind_param("iisi", $rating, $played_hours, $rating_text, $id);
    
    try {
        $stmt->execute();
        header("Location: ../web/profile.php?msg=review_updated");
        exit;
    } catch (mysqli_sql_exception $e) {
        header("Location: ../web/profile.php?error=save_failed");
        exit;
    }
}


// DELETE REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review' && isset($_POST['action']) && $_POST['action'] === 'delete') { 
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt -> bind_param("i", $id);

    try {
        $stmt->execute();
        header("Location: ../web/profile.php?msg=review_deleted");
        exit;
    } catch (mysqli_sql_exception $e) {
        header("Location: ../web/profile.php?error=save_failed");
        exit;
    }
}