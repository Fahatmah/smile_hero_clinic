<?php 
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $hId = 1;
    $header = $_POST['header'];
    $subheading = $_POST['subheading'];
    $imagePath = '';

    if (isset($_FILES['homepage-image']) && $_FILES['homepage-image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['homepage-image']['tmp_name'];
        $fileName = $_FILES['homepage-image']['name'];
        $fileSize = $_FILES['homepage-image']['size'];
        $fileType = $_FILES['homepage-image']['type'];
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

    $query = "UPDATE home_info SET header = ?, subheading = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $header, $subheading, $imagePath, $hId);
    $stmt->execute();
    
    $_SESSION['updated_home_info'] = 'success';
    $conn->close();
    header("Location: ../edit-lp-home.php");
    exit();
}