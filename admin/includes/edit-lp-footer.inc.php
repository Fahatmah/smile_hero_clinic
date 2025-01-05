<?php
session_start();
require_once '../../includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $title1 = $_POST['title1'];
    $title2 = $_POST['title2'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $socmedname = $_POST['socmedname'];
    $socmedlink = $_POST['socmedlink'];
    $address = $_POST['address'];
    $otherbranch1 = $_POST['otherbranch1'];
    $otherbranch1link = $_POST['otherbranch1link'];
    $otherbranch2 = $_POST['otherbranch2'];
    $otherbranch2link = $_POST['otherbranch2link'];
    $paragraph = $_POST['paragraph'];

    $query = "UPDATE footer_info SET title_one = ?, title_two = ?, contact = ?, email = ?, socmedname = ?, socmedlink = ?, address = ?, otherbranch_one = ?, otherbranch_one_link = ?, otherbranch_two = ?, otherbranch_two_link = ?, paragraph = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssss", $title1, $title2, $number, $email, $socmedname, $socmedlink, $address, $otherbranch1, $otherbranch1link,
                    $otherbranch2, $otherbranch2link, $paragraph);
    $stmt->execute();

    $_SESSION['footer_update'] = "success";
    $conn->close();
    header("Location: ../edit-lp-footer.php");
    exit();
}