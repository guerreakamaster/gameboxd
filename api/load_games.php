<?php
// Tell the browser we are sending JSON data, NOT HTML
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/db.php';


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