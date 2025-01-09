<?php
session_start();
require_once '../../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $promoTitles = $_POST['promo_title'];
    $promoDescs = $_POST['promotion_desc'];
    $startDates = $_POST['start_date'];
    $endDates = $_POST['end_date'];
    $deletedPromotions = explode(',', $_POST['deletedPromotions']);

    // Delete promotions
    foreach ($deletedPromotions as $promoId) {
        if (!empty($promoId)) {
            $stmt = $conn->prepare("DELETE FROM promotions_info WHERE id = ?");
            $stmt->bind_param("i", $promoId);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Insert or update promotions
    foreach ($promoTitles as $index => $title) {
        $desc = $promoDescs[$index];
        $startDate = $startDates[$index];
        $endDate = $endDates[$index];
        $promoId = $_POST['promo_id'][$index];

        if (empty($promoId)) {
            // Insert new promotion
            $stmt = $conn->prepare("INSERT INTO promotions_info (title, description, start_date, end_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $desc, $startDate, $endDate);
        } else {
            // Update existing promotion
            $stmt = $conn->prepare("UPDATE promotions_info SET title = ?, description = ?, start_date = ?, end_date = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $desc, $startDate, $endDate, $promoId);
        }
        $stmt->execute();
        $stmt->close();
    }

    $_SESSION['updated_promo_info'] = 'success';
    header("Location: ../edit-lp-promotions.php");
    exit();
}
?>
