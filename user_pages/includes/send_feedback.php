<?php 
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['rating'])){

    $name = $_SESSION['fullname'];
    $email = $_SESSION['email'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $query = "INSERT INTO feedback (name, email, feedback, rating, created_at) VALUES (?, ?, ? ,?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $feedback, $rating);
    $stmt->execute();

    $conn->close();
    header("Location: ../feedback.php?success");
    die();
}else{
    header("Location: ../feedback.php?failed");
}
