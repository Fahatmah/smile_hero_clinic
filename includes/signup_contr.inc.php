<?php

declare(strict_types= 1);

function isInputEmpty(string $fullname, string $email, string $username,string $password ){
    if(empty($fullname) || empty($email) || empty($username) || empty($password)){
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid(string $email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; 
    } else { 
        return false;
    }
   }
function isUsernameTaken(object $pdo, string $username){
    if (getUsername($pdo, $username)) {
        return true; 
    } else { 
        return false;
    }
}

function isNameTaken(object $pdo, string $fullname){
    if (getName($pdo, $fullname)) {
        return true; 
    } else { 
        return false;
    }
}
function isEmailRegistered(object $pdo, string $email){
    if (getEmail($pdo, $email)) {
        return true; 
    } else { 
        return false;
    }
}
function createUser(object $pdo,string $userid, string $fullname, string $email, string $username, string $password){
    setUser( $pdo, $userid,  $fullname,  $email,  $username, $password);
}

function generateUserID() {
    return uniqid(); // You can use any method to generate a unique ID
}
