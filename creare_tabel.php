<?php
$servername = "localhost:8889";
$username = "root1";
$password = "";
$dbname = "myphpdb";

try {
  $conn = new PDO("mysql:host = $servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql1 = "CREATE TABLE new_users(
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(32) NOT NULL UNIQUE,
    pass VARCHAR(32) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_login DATE
  )";
  $conn->exec ($sql1);
  echo "Tabelul NEW_USERS creat cu succes<br>";

} catch (PDOException $e) {
  echo $sql1 . "<br>" . $e->getMessage();
}
$conn = null;
 ?>
