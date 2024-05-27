<?php

declare(strict_types=1);

function getUser(mysqli $conn, string $email) {
    $query = "SELECT * FROM users WHERE email = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

function getAdminEmail(mysqli $conn, string $email) {
    $query = "SELECT email FROM admin WHERE email = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}
function getAdminPass(mysqli $conn, string $password) {
    $query = "SELECT password FROM admin WHERE password = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}