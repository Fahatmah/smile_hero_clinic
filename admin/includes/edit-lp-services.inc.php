<?php 
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $id = 1;
    $service1 = $_POST['service1'];
    $service2 = $_POST['service2'];
    $service3 = $_POST['service3'];
    $service4 = $_POST['service4'];
    $service5 = $_POST['service5'];

    $query = "UPDATE service_info SET service_one = ?, service_two = ?, service_three = ?, service_four = ?, service_five = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $service1, $service2, $service3, $service4, $service5, $id);
    $stmt->execute();

    $_SESSION["updated_service_info"] = "success";
    $conn->close();

    header("Location: ../edit-lp-services.php");
    exit();
}