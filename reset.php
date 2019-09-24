<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once "config.php";

$new_pass = $confirm_pass = "";
$new_pass_err = $confirm_pass_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["new_pass"]))){
    $new_pass_err = "Introdu noua parola.";
  } elseif (strlen(trim($_POST["new_pass"])) <= 3){
    $new_pass_err = "Parola trebuie sa aiba min 3 caractere.";
  } else{
    $new_pass = trim($_POST["new_pass"]);
  }
if(empty(trim($_POST["confirm_pass"]))){
  $confirm_pass_err = "Confirma parola.";
} else {
  $confirm_pass = trim($_POST["confirm_pass"]);
  if(empty($new_pass_err) && ($new_pass != $confirm_pass)){
    $confirm_pass_err = "Parolele nu se potrivesc.";
  }
}
if(empty($new_pass_err) && empty($confirm_pass_err)){
  $sql = "UPDATE new_users SET pass = :password WHERE id = :id";
  if($stmt = $conn->prepare($sql)){
    $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $param_password = password_hash($new_pass, PASSWORD_DEFAULT);
    $param_id = $_SESSION["id"];
    if($stmt->execute()){
      session_destroy();
      header("location: login.php");
      die();
    } else {
      echo "Ceva a mers prost. Incearca mai tarziu.";
      die();
    }
  }
  unset($stmt);
}
unset($conn);
}
include('./background-reset.php');
?>
