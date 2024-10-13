<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $admin_id = $_SESSION['adminID'];
    $fname = htmlspecialchars($_POST['firstname']);
    $lname = htmlspecialchars($_POST['lastname']);
    $email = trim($_POST['email']);
    $contact = htmlspecialchars($_POST['contactnumber']);
    $password = trim($_POST['password']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);
    
    require_once "../../includes/dbh.inc.php";
    
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($contact)){

        $query = "UPDATE admin SET first_name = ?, last_name = ?, email = ?, contact = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $fname, $lname, $email, $contact, $admin_id);
        $stmt->execute();

        if(!empty($password) && !empty($newPassword)){

            $Pass = currPassword($conn,$admin_id);
            $currPass = $Pass['password'];
            
            if(password_verify($password, $currPass)){
                if($newPassword === $confirmPassword){
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $query = "UPDATE admin SET password = ? WHERE admin_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $hashedPassword, $admin_id);
                    $stmt->execute();

                    $_SESSION['admin_process'] = 'created';
                }
            }
        }
        $_SESSION['admin_process'] = 'created';
        header("Location: ../settings.php");
        die();
    } else {
        header("Location: ../settings.php?failed");
        die();
    }
} else {
    header("Location: ../settings.php?failed");
    die();
}

function currPassword(mysqli $conn, string $admin_id){
    $query = "SELECT password FROM admin WHERE admin_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $password = $result->fetch_assoc();

    return $password;
}
