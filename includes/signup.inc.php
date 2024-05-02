<?php

if($_SERVER['REQUEST_METHOD'] === "POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once("dbh.inc.php");
        require_once("signup_model.inc.php");
        require_once("signup_contr.inc.php");

        $user_id = generateUserID($pdo);

        // ERROR HANDLERS
        $errors = [];

       if(isInputEmpty($fullname, $email, $username, $password)) {
        // $errors["emptyInput"] = "Fill in all fields!";
       }
       if(isNameTaken($pdo, $fullname)) {
        $errors["nameTaken"] = "name is already taken";
       }
       if(isEmailInvalid($email)) {
        $errors["invalidEmail"] = "Email is invalid!";
       }
       if(isUsernameTaken($pdo, $username)) {
        $errors["usernameTaken"] = "Username is already taken";
       }
       if(isEmailRegistered($pdo, $email)) {
        $errors["emailRegistered"] = "Email is already registered";
       }

       require_once("config_session.inc.php");

       if($errors) {
        $_SESSION["errors_signup"] = $errors;

        // to not erase the input if have errors in signup
        // $signupData = [
        //     "name" => $name,
        //     "email" => $email,
        //     "username" => $username
        // ];

        // $_SESSION["signup_data"] = $signupData;

        header("Location: ../signup.php");
        die();
       }
       
       createUser($pdo, $user_id, $fullname, $email, $username, $password);
       header("Location: ../login.php?signup=sucess");

       $pdo = null;
       $stmt = null;
       
       die();
    } catch (PDOException $e) {
        die('Query failed'. $e->getMessage());
    }
} else {
    header("Location: ../signup.php");
    die();
}