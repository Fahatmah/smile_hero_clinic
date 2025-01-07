<?php
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    $aId = 1;
    $address = $_POST['address'];
    $clinicname = $_POST['clinicname'];
    $imagePath = '';

    if (isset($_FILES['aboutpage-image']) && $_FILES['aboutpage-image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['aboutpage-image']['tmp_name'];
        $fileName = $_FILES['aboutpage-image']['name'];
        $fileSize = $_FILES['aboutpage-image']['size'];
        $fileType = $_FILES['aboutpage-image']['type'];
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

    $query = "UPDATE about_info SET address = ?, clinicname = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $address, $clinicname, $imagePath, $aId);
    $stmt->execute();

    $_SESSION["updated_about_info"] = 'success';
    $conn->close();
    header("Location: ../edit-lp-about.php");
    exit();
}