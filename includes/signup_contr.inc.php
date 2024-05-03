<?php

declare(strict_types=1);

function isInputEmpty(string $fullname, string $email, string $username, string $password) {
    return empty($fullname) || empty($email) || empty($username) || empty($password);
}

function isEmailInvalid(string $email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isUsernameTaken(mysqli $conn, string $username) {
    $user = getUsername($conn, $username);
    return $user !== null;
}

function isNameTaken(mysqli $conn, string $fullname) {
    $user = getName($conn, $fullname);
    return $user !== null;
}

function isEmailRegistered(mysqli $conn, string $email) {
    $user = getEmail($conn, $email);
    return $user !== null;
}

function createUser(mysqli $conn, string $userid, string $fullname, string $email, string $username, string $password) {
    setUser($conn, $userid, $fullname, $email, $username, $password);
}

function generateUserID(mysqli $conn) {
    $unique = false;
    $userID = '';
    while (!$unique) {
        $randString = strval(mt_rand()); // Convert integer to string
        $userID = 'SHC' . substr(md5(uniqid($randString, true)), 0, 4) . 'TCU';
        $query = "SELECT user_id FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $userID);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            $unique = true;
        }
    }
    return $userID;
}

