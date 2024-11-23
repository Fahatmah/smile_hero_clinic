<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["Set Doctor"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $appointment_id = $_POST["app_id"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $status = "accepted";

    // Mail setup
    $mail = require __DIR__ . "/../../mailer.php"; 
    $mail->setFrom("jpvillaruel02@gmail.com");
    $mail->addAddress($email, $name);

    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        // Update appointment status to accepted
        $query = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $status, $appointment_id);
        $stmt->execute();

        $_SESSION['pending_appointment'] = 'accept';
        header("Location: ../appointments.php");
    } else {
        echo "<script>alert('Failed to send confirmation email.')</script>";
    }

    $conn->close();
    die();
}
