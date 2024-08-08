<?php

declare(strict_types=1);

function getcontact(mysqli $conn, string $contact) {
    $query = "SELECT user_id FROM users WHERE contact = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $contact);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function getEmail(mysqli $conn, string $email) {
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function isEmailUnique($dbConnection, $email, $currentEmail ) {
    $query = "SELECT COUNT(*) AS total FROM users WHERE email = ? AND email != ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("ss", $email, $currentEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = $row['total'];
    
    return $total == 0; // Return true if email is unique, false otherwise
}

function getName(mysqli $conn, string $fullname) {
    $query = "SELECT user_id FROM users WHERE fullname = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function setUser(mysqli $conn, string $userid, string $fullname, string $email, string $contact, string $password, string  $activation_token_hash) {
    $query = "INSERT INTO users (user_id, fullname, email, contact, pass, account_activation_hash, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("ssssss", $userid, $fullname, $email, $contact, $hashedPassword,  $activation_token_hash);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}
