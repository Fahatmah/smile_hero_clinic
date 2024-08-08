<?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];

      require_once 'dbh.inc.php';
      require_once 'login_model.inc.php';
      require_once 'login_contr.inc.php';

      // ERROR HANDLERS
      $errors = [];

      $result = getUser($conn, $email);

      if (isUsernameWrong($result)) {
          $errors["login_incorrect"] = "Incorrect Username or Password";
      }

      if (!isUsernameWrong($result) && isPasswordWrong($password, $result["pass"])){
          $errors["login_incorrect"] = "Incorrect Username or Password";
      }

      if ($result["account_activation_hash"] !== NULL) {
        $errors["account_inactive"] = "Acount activation is needed";
      }

      require_once("config_session.inc.php");

      if(getAdminEmail($conn, $email) && getAdminpass($conn, $password)) {
        $_SESSION["adminEmail"] = getAdminEmail($conn, $email);
        $conn->close();
        Header("Location: ../admin/dashboard.php");
        die();
      }


      if ($errors) {
          $_SESSION["errors_login"] = $errors;
          header("Location: ../login.php");
          die();
      }

      // to create a new session id using the user id to match session id and user session id
      session_regenerate_id(true);

      $_SESSION["user_id"] =  $result["user_id"];
      $_SESSION["fullname"] =  $result["fullname"];
      $_SESSION["email"] =  $result["email"];
      $_SESSION["contact"] =  $result["contact"];
      $_SESSION["user_username"] = htmlspecialchars($result["username"]);
      $_SESSION["last_regeneration"] = time();

      $conn->close();
      Header("Location: ../user_pages/profile.php?login=success");
      die();
    } else {
      header("Location: ../login.php");
      die();
    }