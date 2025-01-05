<?php
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    $aId = 1;
    $address = $_POST['address'];
    $clinicname = $_POST['clinicname'];

    $query = "UPDATE about_info SET address = ?, clinicname = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $address, $clinicname, $aId);
    $stmt->execute();

    $_SESSION["updated_about_info"] = 'success';
    $conn->close();
    header("Location: ../edit-lp-about.php");
    exit();
}