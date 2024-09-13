<?php

declare(strict_types=1);

function getUserid(mysqli $conn, string $name) {
    $query = "SELECT user_id FROM appointments WHERE name = ? AND (status = 'accepted')";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("s", $name);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function createAppointment(mysqli $conn, string $user_id, string $appointmentId, string $name, string $email, string $contact, string $message, string $appointmentDate, string $appointmentTime, string $location, string $status) {

    $query = "INSERT INTO appointments (user_id, appointment_id, name, email, contact, message, date, time, location, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,  NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssss", $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime, $location, $status);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}