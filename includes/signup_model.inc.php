<?php

declare(strict_types= 1);

function getUsername(object $pdo, string $username){

    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query); // to prevent sql injection by separating data to query
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getEmail(object $pdo, string $email){

    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query); // to prevent sql injection by separating data to query
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getName(object $pdo, string $fullname){

    $query = "SELECT username FROM users WHERE fullname = :fullname;";
    $stmt = $pdo->prepare($query); // to prevent sql injection by separating data to query
    $stmt->bindParam(":fullname", $fullname);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function setUser( object $pdo,string $userid, string $fullname, string $email, string $username,string $password){
    $query = "INSERT INTO users (id, fullname, email, username, pass, created_at) VALUES (:userid, :fullname, :email, :username, :pass, NOW())";
    $stmt = $pdo->prepare($query); // to prevent sql injection by separating data to query

    $options = [    
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":userid", $userid);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pass", $hashedPassword);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}