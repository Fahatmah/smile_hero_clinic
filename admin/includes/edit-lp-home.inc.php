<?php 
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $hId = 1;
    $header = $_POST['header'];
    $subheading = $_POST['subheading'];


    $query = "UPDATE home_info SET header = ?, subheading = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $header, $subheading, $hId);
    $stmt->execute();
    
    $_SESSION['updated_home_info'] = 'success';
    $conn->close();
    header("Location: ../edit-lp-home.php");
    exit();
}