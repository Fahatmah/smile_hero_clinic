<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST"){

    $fname = ucfirst($_POST['firstname']);
    $lname = ucfirst($_POST['lastname']);
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];

    require_once "../../includes/dbh.inc.php";
    $doctor_id = generateAppoinmentID($conn);

    if(isEmailInvalid($email)){
        header("Location: ../new-doctor.php");
        exit();
    }

    $query = "INSERT INTO doctors (doctor_id, first_name, last_name, phone_number, email, created_at) VALUES (?, ?, ?, ?, ?, Now())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssis", $doctor_id, $fname, $lname, $contactnumber, $email);
    $stmt->execute();

    $_SESSION['doctors_process'] = 'created';
    $conn->close();
    header("Location: ../new-doctor.php");
    die();
}else{
    echo "<script>alert('Adding Doctor : Failed');</script>";
    echo "<script>window.location.href='../new-doctor';</script>";
}

function isEmailInvalid(string $email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
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


