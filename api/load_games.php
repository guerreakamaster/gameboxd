<?php
// Tell the browser we are sending JSON data, NOT HTML
header('Content-Type: application/json; charset=utf-8');

$host = "127.0.0.1";
$user = "admin";
$password = "admin"; // Make sure your XAMPP password is correct here!
$database = "gameboxd";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed."]);
    exit;
}

$sql = "SELECT * FROM games";
$result = $conn->query($sql);

$gamesArray = [];

if ($result->num_rows > 0) {
    // Instead of drawing a table, we push each game into an invisible array
    while ($row = $result->fetch_assoc()) {
        $gamesArray[] = $row;
    }
}

// Finally, we convert that array into pure JSON and send it to your app.js!
echo json_encode($gamesArray, JSON_UNESCAPED_UNICODE);

$conn->close();
?>