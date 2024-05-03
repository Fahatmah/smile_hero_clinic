<?php

function createAppointment(mysqli $conn, string $user_id, string $appointmentId, string $name, string $email, int $contact, string $message, string $appointmentDate, string $appointmentTime, string  $location) {

    $query = "INSERT INTO appointments (user_id, appointment_id, name, email, contact, message, date, time, location, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,  NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssissss", $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime, $location);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}