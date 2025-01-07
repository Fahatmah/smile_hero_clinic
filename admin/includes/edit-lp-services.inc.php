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
    $imagePath = '';

    if (isset($_FILES['servicespage-image']) && $_FILES['servicespage-image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['servicespage-image']['tmp_name'];
        $fileName = $_FILES['servicespage-image']['name'];
        $fileSize = $_FILES['servicespage-image']['size'];
        $fileType = $_FILES['servicespage-image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 2000000) {
            $uploadFileDir = '../../assets/landing-page/';
            $dest_path = $uploadFileDir . $fileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = './assets/landing-page/' . $fileName;
            }
        }
    }

    $query = "UPDATE service_info SET service_one = ?, service_two = ?, service_three = ?, service_four = ?, service_five = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $service1, $service2, $service3, $service4, $service5, $imagePath, $id);
    $stmt->execute();

    $_SESSION["updated_service_info"] = "success";
    $conn->close();

    header("Location: ../edit-lp-services.php");
    exit();
}