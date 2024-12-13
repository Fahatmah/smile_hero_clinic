<?php 
session_start();
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    $service_id = $_POST['service_id'];
    $service_name = $_POST['serviceName'];
    $service_price = $_POST['servicePrice'];

    $query = "UPDATE services SET service_name = ?, service_price = ? WHERE service_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $service_name, $service_price, $service_id);
    $stmt->execute();

    $_SESSION['service_updated'] = "updated";
    $conn->close();
    header("Location: ../update-service.php?service_id=$service_id");
    exit();
    
}