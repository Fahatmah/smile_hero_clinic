<?php

declare(strict_types=1);

function getUserid(mysqli $conn, string $name) {
    $query = "SELECT user_id FROM appointments WHERE name = ? AND (status != 'rejected') AND (status != 'canceled')";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("s", $name);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function createAppointment(mysqli $conn, string $user_id, string $appointmentId, string $name, string $email, string $contact, string $message, string $appointmentDate, string $appointmentTime,string  $dentalService, string $location, string $status) {

    $query = "INSERT INTO appointments (user_id, appointment_id, name, email, contact, message, date, time, service, location, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime,  $dentalService, $location, $status);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}