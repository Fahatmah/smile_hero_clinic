<?php
// $mysqli = new mysqli("localhost", "root", "", "smile_hero_clinic");

// if ($mysqli->connect_error) {
//     die("Connection failed: " . $mysqli->connect_error);
// }
require_once '../../includes/dbh.inc.php';

// Query to get appointment counts for each weekday
$query = "SELECT COUNT(*) AS count, DAYOFWEEK(date) AS weekday FROM appointments 
    WHERE WEEK(date, 0) = WEEK(CURDATE(), 0)  AND YEAR(date) = YEAR(CURDATE())
    GROUP BY DAYOFWEEK(date) ORDER BY DAYOFWEEK(date)";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$appointmentData = array();
while ($row = $result->fetch_assoc()) {
    $appointmentData[] = $row; // Contains 'count' and 'weekday' fields
}

echo json_encode($appointmentData);

$conn->close();
