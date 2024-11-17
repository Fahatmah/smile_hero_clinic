<?php
// session_start(); // Initialize session at the start

$mysqli = new mysqli("localhost", "root", "", "smile_hero_clinic");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

date_default_timezone_set('Asia/Manila');

// Check if we should refresh data
$lastFetch = $_SESSION['last_fetch'] ?? null; // Get the last fetch time from the session
$currentTime = time(); // Get the current timestamp
$oneWeekInSeconds = 7 * 24 * 60 * 60; // 1 week in seconds

if ($lastFetch === null || ($currentTime - $lastFetch) > $oneWeekInSeconds) {
    // Fetch data from the database
    $query = "SELECT WEEKDAY(created_at) + 1 as weekday, COUNT(*) as count
              FROM appointments
              GROUP BY WEEKDAY(created_at)
              ORDER BY weekday";

    if ($result = $mysqli->query($query)) {
        $appointmentData = array();
        while ($row = $result->fetch_assoc()) {
            $appointmentData[] = $row;
        }

        $result->free(); // Free the result set

        // Update the last fetch time
        $_SESSION['last_fetch'] = $currentTime; // Store the current time in session

        // Return the new appointment data
        echo json_encode($appointmentData);
    } else {
        // Log or handle query error
        echo json_encode(["error" => "Error executing query: " . $mysqli->error]);
    }
} else {
    // Optionally, return cached data or an empty array if the data is not expired
    echo json_encode([]);
}

$mysqli->close();