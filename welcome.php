<?php
ob_start();
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; text-align: center; }
    </style>
  </head>
  <body>
    <div class="page-header">
      <h3>Buna, <?php echo $_SESSION["username"]; ?>. Bine ai venit!.</h3>
    </div>
    <p>
      <a href="reset.php" class="btn btn-warning">Reseteaza-ti parola aici</a>
      <a href="logout.php" class="btn btn-danger">Iesi din cont</a>
    </p>
  </body>
</html>
