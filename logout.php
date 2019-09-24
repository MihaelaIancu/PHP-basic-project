<?php
session_start();
//unset all of the session variables
$_SESSION  = array();
session_destroy();
header("location:login.php");
exit;
?>
