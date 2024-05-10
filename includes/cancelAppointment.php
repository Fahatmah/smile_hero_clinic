<?php

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["appointment_id"])){

    $appointmentid = $_POST["appointment_id"];

    require_once("dbh.inc.php");

    $query = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $appointmentid);
    $stmt->execute();

    echo "<script> alert('Your Appointment is now canceled') </script>";
    echo"<script> window.location.href='../user_pages/appointment_page.php' </script>";
    $conn->close();
}