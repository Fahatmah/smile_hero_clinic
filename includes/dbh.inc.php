<?php

date_default_timezone_set('Asia/Manila');

$host = 'localhost';
$dbname = 'smile_hero_clinic';
$dbusername = 'root';
$dbpassword = '';

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Set timezone for MySQL
$conn->query("SET time_zone = '+08:00'");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
