<?php
session_start();
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $service_name = htmlspecialchars(ucwords($_POST['serviceName']));
    $service_price = htmlspecialchars(ucwords($_POST['servicePrice']));

    if(serviceExist($conn,$service_name)){
        header("Location: ../add-services.php?serviceExist");
        exit();
    }
    else{
        $query = "INSERT INTO services (service_name, service_price, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $service_name, $service_price);
        $stmt->execute();

        $_SESSION['service_added'] = "added";
        $conn->close();
        header("Location: ../add-services.php");
        exit();
    }
}

function serviceExist($conn, $service_name){
    $query = "SELECT * FROM services WHERE service_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $service_name);
    $stmt->execute();

    $result = $stmt->get_result();
    $resServiceName = $result->fetch_assoc();

    return $resServiceName;
}
