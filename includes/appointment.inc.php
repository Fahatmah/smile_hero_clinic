<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';

if([$_SERVER['REQUEST_METHOD'] === "POST"] && isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contactnumber'];
    $message = $_POST['message'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $location = $_POST['location'];

    require_once("dbh.inc.php");
    require_once("appointment_model.inc.php");

    $appointmentId = generateAppoinmentID($conn);


    if(haveAppointment($conn, $name)){
        echo "<script> alert('You already have Appointment') </script>";
        echo "<script>window.close()</script>";
        die();
    }

    require_once("config_session.inc.php");

    createAppointment($conn, $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime, $location);
    echo "<script>alert('Appointment is created');</script>";
    echo "<script>window.close()</script>";

    $conn->close();
    die();
}else{
    echo "<script>alert('Appointment is not created');</script>";
    echo "<script>window.location.href='../user_pages/appointment_form_page.php';</script>";
    die();
}

function haveAppointment(mysqli $conn, string $name) {
    $user = getUserid($conn, $name);
    return $user !== null;
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
