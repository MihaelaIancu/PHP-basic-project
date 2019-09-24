<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] ===true){
  header("location: welcome.php");
  exit;
}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $username_err = "Introdu un nume de utilizator.";
  } else {
    $username = trim($_POST["username"]);
  }
  if(empty(trim($_POST["password"]))){
    $password_err = "Introdu o parola.";
  } else {
    $password = trim($_POST["password"]);
  }
  if(empty($username_err) && empty($password_err)){
    $sql = "SELECT id, user, pass FROM new_users WHERE user = :username";
    $sql1 = "INSERT INTO new_users (last_login) VALUES (CURRENT_TIMESTAMP)";
    if($stmt = $conn->prepare($sql)){
      $param_username = trim($_POST["username"]);
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          if($row = $stmt->fetch()){
            $id = $row["id"];
            $username = $row["username"];
            $hashed_pass = $row["password"];
            if(password_hash($password) == $hashed_pass){
              session_start();
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["username"] = $_POST["username"];
              header("location: welcome.php");
            } else {
              $password_err = "Parola introdusa nu este valida.";
            }
          }
        } else {
          $username_err = "Nu a fost gasit niciun cont cu acest nume de utilizator.";
        }
      } else{
        echo "Ceva a mers prost. Incearca mai tarziu.";
        die();
      }
    }
    unset($stmt);
  }
  if(empty($username_err) && empty($password_err)){
    $sql = "UPDATE new_users SET last_login = :last_login WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
      $stmt->bindParam("last_login", $param_last_login);
      $stmt->bindParam("id", $_SESSION["id"]);
      $param_last_login = strtotime(date('Y-m-d h:i:s'));
      $stmt->execute();
      header("location: welcome.php");
    }
    unset($stmt);
  }
  unset($conn);
}
include('./background-login.php');
?>
