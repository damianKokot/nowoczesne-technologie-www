<?php
$db_host = "db";
$db_user = "portfolio";
$db_pass = "portfolio";
$db_name = "portfolio";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}
?>
