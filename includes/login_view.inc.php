<?php

declare(strict_types= 1);

function outputUserId(){
    if(isset($_SESSION["user_id"])){
      $userid = $_SESSION["user_id"];
      echo $userid;
        // Header("Location: ../userpage.php?login=success");

    }else{
        Header("Location: ../login.php?login=failed");
        // echo"you are not logged in";
    }
}
function outputFullName(){
    if(isset($_SESSION["fullname"])){
      $fullname = $_SESSION["fullname"];
      echo $fullname;
        // Header("Location: ../userpage.php?login=success");

    }else{
        Header("Location: ../login.php?login=failed");
        // echo"you are not logged in";
    }
}
function outputEmail(){
    if(isset($_SESSION["email"])){
      $email = $_SESSION["email"];
      echo $email;
        // Header("Location: ../userpage.php?login=success");

    }else{
        Header("Location: ../login.php?login=failed");
        // echo"you are not logged in";
    }
}
function outputAdminEmail(){
    if(isset($_SESSION['adminEmail'])){
      $email = $_SESSION['adminEmail'];
      echo $email;
        // Header("Location: ../userpage.php?login=success");

    }else{
        Header("Location: ../login.php?login=failed");
        // echo"you are not logged in";
    }
}

function outputContact(){
    if(isset($_SESSION["contact"])){
      $contact = $_SESSION["contact"];
      echo $contact;
        // Header("Location: ../userpage.php?login=success");

    }else{
        Header("Location: ../login.php?login=failed");
        // echo"you are not logged in";
    }
}

function checkLoginErrors(){
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

         foreach ($errors as $error) {
            echo '<p class="form_error">'.$error .'</p>';
        }   

        unset($_SESSION["errors_login"]);
    }
    elseif (isset($_GET["login"]) && $_GET["login"] === "success") {
        
    }
}