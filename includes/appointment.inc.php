<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contactnumber'];     
    $message = $_POST['message'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $location = $_POST['location'];
    $dentalService = $_POST['dentalService'];
    $status = 'request';

    require_once("dbh.inc.php");
    require_once("appointment_model.inc.php");

    $appointmentId = generateAppoinmentID($conn);

    if (haveAppointment($conn, $name)) {
        $_SESSION['appointment_status'] = 'exists';
        header("Location: ../user_pages/appointment_form_page.php");
        die();
    }
    else{
        createAppointment($conn, $user_id, $appointmentId, $name, $email, $contact, $message, $appointmentDate, $appointmentTime, $dentalService, $location, $status);
        $_SESSION['appointment_status'] = 'created';
        
        $conn->close();
        header("Location: ../user_pages/appointment_form_page.php");
        die();
    }
    } else {
        $_SESSION['appointment_status'] = 'failed';
        header("Location: ../user_pages/appointment_form_page.php");
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
        $randString = strval(mt_rand());
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
