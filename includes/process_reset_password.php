<?php 

if($_SERVER["REQUEST_METHOD"] = "POST"){

    $token = $_POST["token"];
    $password = $_POST["password"];

    $token_hash = hash("sha256", $token);


    $mysqli = require __DIR__ ."/dbh.inc.php";
    $query = "SELECT * FROM users WHERE reset_token_hash = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $token_hash);
    $stmt-> execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        echo "<script>alert('Invalid or expired token.'); window.close();</script>";
        exit;
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()){
        echo "<script>alert('Invalid or expired token.'); window.close();</script>";
        exit;
    }

    $qryUpdatePass = "UPDATE users SET pass = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE user_id = ?";

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt = $mysqli->prepare($qryUpdatePass);
    $stmt->bind_param("ss", $hashedPassword, $user["user_id"]);
    $stmt->execute();

    echo "password reset successfully";
}

