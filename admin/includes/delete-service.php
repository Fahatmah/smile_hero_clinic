<?php
require_once '../../includes/dbh.inc.php';

if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];

    // SQL query to delete the service
    $sql = "DELETE FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $service_id);
        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: ../services.php?delete=success");
            exit();
        } else {
            // Redirect with error message
            header("Location: ../services.php?delete=error");
            exit();
        }
    } else {
        echo "Error: Could not prepare statement.";
    }
} else {
    header("Location: ../services.php");
    exit();
}
?>
