<?php

$host = 'localhost';
$dbname = 'smile_hero_clinic';
$dbusername = 'root';
$dbpassword = '';


$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}