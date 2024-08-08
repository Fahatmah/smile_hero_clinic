<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/dbh.inc.php";
$sql = "SELECT * FROM users WHERE account_activation_hash = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Invalid or expired token.");
}

$sql = "UPDATE users SET account_activation_hash = NULL WHERE user_id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $user["user_id"]);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation</title>
</head>
<body>
    <h1>Account Activated</h1>
    <p>You can now <a href="../login.php">login</a>.</p>
</body>
</html>
