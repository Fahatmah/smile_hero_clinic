<?php

require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["accept"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $appointment_id = $_POST["app_id"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $status = "accepted";
    
    require "../../vendor/autoload.php";
    
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMAiler::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    $mail->Username = "jpvillaruel02@gmail.com";
    $mail->Password = "vfng rcwc dhon tovf";
    $mail->isHTML(true);
    $mail->setFrom("jpvillaruel02@gmail.com");
    $mail->addAddress($email, $name);
    
    $mail->Subject = $subject;
    $mail->Body = $message;
    
    $mail->send();

    $query = "UPDATE appointments SET status = ? WHERE appointment_id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $status, $appointment_id);
    $stmt->execute();

    echo "<script> alert('Appointment has been confirmed.')</script>";
    echo "<script>window.location.href='../appointments.php';</script>";

    $conn->close();
    die();  
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["cancel"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $appointment_id = $_POST["app_id"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $status = "rejected";
    
    require "../../vendor/autoload.php";
    
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMAiler::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    $mail->Username = "jpvillaruel02@gmail.com";
    $mail->Password = "vfng rcwc dhon tovf";
    $mail->isHTML(true);
    $mail->setFrom("jpvillaruel02@gmail.com");
    $mail->addAddress($email, $name);
    
    $mail->Subject = $subject;
    $mail->Body = $message;
    
    $mail->send();

    $query = "UPDATE appointments SET status = ? WHERE appointment_id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $status, $appointment_id);
    $stmt->execute();

    echo "<script> alert('Appointment has been canceled.')</script>";
    echo "<script>window.location.href='../appointments.php';</script>";

    $conn->close();
    die();  
}