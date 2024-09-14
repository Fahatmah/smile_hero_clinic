<?php 
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['feedback'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback_type = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $query = "INSERT INTO feedback (name, email, feedback_type, feedback) VALUES (?, ?, ? ,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $feedback_type, $feedback);
    $stmt->execute();

    $conn->close();
    header("Location: ../feedback.php?success");
    die();
}else{
    header("Location: ../feedback.php?failed");
}
