<?php
$mysqli = new mysqli("localhost", "root", "", "smile_hero_clinic");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Appointments per month
$query = "SELECT WEEKDAY(created_at) + 1 as weekday, COUNT(*) as count
        FROM appointments
        GROUP BY WEEKDAY(created_at)
        ORDER BY weekday";
        
$result = $mysqli->query($query);

$appointmentData = array();
while($row = $result->fetch_assoc()) {
    $appointmentData[] = $row;
}

echo json_encode($appointmentData);

$mysqli->close();
