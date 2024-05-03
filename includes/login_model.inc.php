<?php

declare(strict_types=1);

function getUser(mysqli $conn, string $username) {
    $query = "SELECT * FROM users WHERE username = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
}
