<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once("dbh.inc.php");
    require_once("signup_model.inc.php");
    require_once("signup_contr.inc.php");

    $user_id = generateUserID($conn);

    // ERROR HANDLERS
    $errors = [];

    if (isInputEmpty($fullname, $email, $username, $password)) {
        // $errors["emptyInput"] = "Fill in all fields!";
    }
    if (isNameTaken($conn, $fullname)) {
        $errors["nameTaken"] = "Name is already taken";
    }
    if (isEmailInvalid($email)) {
        $errors["invalidEmail"] = "Email is invalid!";
    }
    if (isUsernameTaken($conn, $username)) {
        $errors["usernameTaken"] = "Username is already taken";
    }
    if (isEmailRegistered($conn, $email)) {
        $errors["emailRegistered"] = "Email is already registered";
    }

    require_once("config_session.inc.php");

    if ($errors) {
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

    createUser($conn, $user_id, $fullname, $email, $username, $password);
    echo "<script>alert('Account is created');</script>";
    echo "<script>window.location.href='../login.php?signup=success';</script>";

    $conn->close();
    die();
} else {
    echo "<script>alert('Account is not created');</script>";
    echo "<script>window.location.href='../signup.php';</script>";
    die();
}