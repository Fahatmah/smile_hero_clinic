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
