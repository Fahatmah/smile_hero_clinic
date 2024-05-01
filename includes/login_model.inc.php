<?php

declare(strict_types= 1);

function getUser(object $pdo,string $username){

    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query); // to prevent sql injection by separating data to query
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

