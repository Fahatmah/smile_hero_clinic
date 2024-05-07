<?php

if([$_SERVER['REQUEST_METHOD'] === "POST"]){

    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contactnumber'];
    $contactnumber = intval($contact);
    $message = $_POST['message'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $location = $_POST['location'];

    require_once("dbh.inc.php");
    require_once("appointment_model.inc.php");

    $appointmentId = generateAppoinmentID($conn);

    // ERROR HANDLERS
    $errors = [];

    if(isAppointmentInputEmpty($name, $email, $contactnumber)){
        $errors["emptyInput"] = "Fill in all fields!";
    }

    if(isAppointmentEmailInvalid($email)){
        $errors["invalidEmail"] = "Email is invalid!";
    }

    require_once("config_session.inc.php");

    if ($errors) {
        $_SESSION["errors_appointment"] = $errors;
        Header("Location: ../user_pages/appointment_form_page.php");
        die();
    }

    createAppointment($conn, $user_id, $appointmentId, $name, $email, $contactnumber, $message, $appointmentDate, $appointmentTime, $location);
    echo "<script>alert('Appointment is created');</script>";
    echo "<script>window.location.href='../user_pages/appointment_page.html';</script>";

    $conn->close();
    die();
}else{
    echo "<script>alert('Appointment is not created');</script>";
    echo "<script>window.location.href='../user_pages/appointment_form_page.php';</script>";
    die();
}

function isAppointmentEmailInvalid(string $email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}


function isAppointmentInputEmpty(string $name, string $email, int $contactnumber ) {
    return empty($name) || empty($email) || empty($contactnumber);
}

function generateAppoinmentID(mysqli $conn) {
    $unique = false;
    $appointmentID = '';
    while (!$unique) {
        $randString = strval(mt_rand()); // Convert integer to string
        $appointmentID = 'SHC' . substr(md5(uniqid($randString, true)), 0, 4);
        $query = "SELECT appointment_id FROM appointments WHERE appointment_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $appointmentID);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            $unique = true;
        }
    }
    return $appointmentID;
}
