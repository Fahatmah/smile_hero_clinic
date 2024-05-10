<?php

declare(strict_types=1);

function getUserid(mysqli $conn, string $name) {
    $query = "SELECT user_id FROM appointments WHERE name = ?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("s", $name);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function createAppointment(mysqli $conn, string $user_id, string $appointmentId, string $name, string $email, string $contact, string $message, string $appointmentDate, string $appointmentTime, string  $location) {

    $query = "INSERT INTO appointments (user_id, appointment_id, name, email, contact, message, date, time, location, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,  NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime, $location);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}