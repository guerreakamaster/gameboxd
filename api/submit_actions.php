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

$host = "127.0.0.1";
$user = "admin";
$password = "admin";
$database = "gameboxd";


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

    if ($stmt->execute()) {
        header("Location: ../web/index.php?msg=game_added");
        exit;
    } else {
        $error = "Error adding game: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
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
    
    if ($stmt->execute()) {
        header("Location: ../web/index.php?msg=game_updated");
        exit;
    }
    $stmt->close();
}
//delete actions
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'game' && isset($_POST['action']) && $_POST['action'] === 'delete') { 
    
    $stmt = $conn->prepare("DELETE FROM games WHERE id = ?");
    $stmt -> bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../web/index.php?msg=game_deleted");
        exit;
    }
    $stmt->close();
}

//######################################################################
//########################### REVIEWS ACTIONS ##########################
//######################################################################


//ADD NEW REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review' && isset($_POST['action']) && $_POST['action'] === 'add') { 
    $user_id = $_SESSION['user_id'];
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

    if ($stmt->execute()) {
        header("Location: ../web/index.php?msg=review_saved");
    } else {
        echo "Error saving review: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}


// UPDATE REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review'&& isset($_POST['action']) && $_POST['action'] === 'update') {
    $rating = $_POST['rating'];
    $played_hours = $_POST['played_hours'];
    $rating_text = $_POST['rating_text'];

    $stmt = $conn->prepare("UPDATE reviews SET rating=?, played_hours=?, rating_text=? WHERE id=?");
    // "sisssi" = String, Int, String, String, String, Int (the ID)
    $stmt->bind_param("iisi", $rating, $played_hours, $rating_text, $id);
    
    if ($stmt->execute()) {
        header("Location: ../web/profile.php?msg=review_updated");
        exit;
    }
    $stmt->close();
}


// DELETE REVIEW
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'review' && isset($_POST['action']) && $_POST['action'] === 'delete') { 
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt -> bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../web/profile.php?msg=review_deleted");
        exit;
    }
    $stmt->close();
}