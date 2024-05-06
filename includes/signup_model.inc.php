<?php

declare(strict_types=1);

function getUsername(mysqli $conn, string $username) {
    $query = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
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

function getName(mysqli $conn, string $fullname) {
    $query = "SELECT user_id FROM users WHERE fullname = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function setUser(mysqli $conn, string $userid, string $fullname, string $email, string $username, string $password) {
    $query = "INSERT INTO users (user_id, fullname, email, username, pass, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("sssss", $userid, $fullname, $email, $username, $hashedPassword);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}
