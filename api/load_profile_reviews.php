<?php
session_start();
header('Content-Type: application/json');

// kick them out if not logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

$host = "127.0.0.1";
$user = "admin";
$password = "admin";
$database = "gameboxd";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed."]));
}

$user_id = $_SESSION['user_id'];

// We grab reviews.id AS review_id so the edit button knows exactly which review to edit!
$sql = "SELECT reviews.id AS review_id, games.id AS game_id, games.title, games.release_year, games.image_url, reviews.rating, reviews.rating_text, reviews.created_at, reviews.played_hours
        FROM reviews 
        JOIN games ON reviews.game_id = games.id 
        WHERE reviews.user_id = ? 
        ORDER BY reviews.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode($reviews);

$stmt->close();
$conn->close();