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
            $uploadFileDir = '../../assets/';
            $dest_path = $uploadFileDir . $fileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = './assets/' . $fileName;
            }
        }
    }

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
            services = ?, 
            image_path = ? 
            WHERE id = 1"; // Assuming there's only one row to update

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $title, $subheader1, $subheader2, $address, $workdays, $number, $services, $imagePath);

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
