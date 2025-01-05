<?php
session_start();
require_once '../../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $subheader1 = $_POST['subheader1'];
    $subheader2 = $_POST['subheader2'];
    $address = $_POST['address'];
    $workdays = $_POST['Workdays'];
    $number = $_POST['number'];
    $services = json_decode(stripslashes($_POST['services']), true); // Decode JSON string and remove slashes

    // Ensure services are properly formatted
    $services = array_map('trim', $services);
    $services = json_encode($services);

    // Update query
    $sql = "UPDATE homepage_info SET 
            title = ?, 
            subheader1 = ?, 
            subheader2 = ?, 
            address = ?, 
            workdays = ?, 
            number = ?, 
            services = ? 
            WHERE id = 1"; // Assuming there's only one row to update

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $title, $subheader1, $subheader2, $address, $workdays, $number, $services);

    if ($stmt->execute()) {
        $_SESSION['updated-homepage'] = 'success';
        header("Location: ../edit-user-homepage.php?update=success");
    } else {
        header("Location: ../edit-user-homepage.php?update=failed");
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../edit-user-homepage.php");
    exit();
}
?>
