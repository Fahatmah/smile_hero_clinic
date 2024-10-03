<?php
$mysqli = new mysqli("localhost", "root", "", "smile_hero_clinic");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);    
}

// User registrations per month
$query = "SELECT MONTH(created_at) as month, COUNT(*) as count
            FROM appointments
            GROUP BY MONTH(created_at)";

$result = $mysqli->query($query);

$registrationData = array();
while($row = $result->fetch_assoc()) {
    $registrationData[] = $row;
}

echo json_encode($registrationData);

$mysqli->close();

