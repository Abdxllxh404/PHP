<?php
session_start();

if (!isset($_SESSION['member_id'])) {
      echo 0;
      exit;
}

$mid = $_SESSION['member_id'];
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
$sql = "SELECT SUM(quantity) FROM cart WHERE member_id = $mid";
$result = $mysqli->query($sql);
list($count) = $result->fetch_row();
echo $count;        
$mysqli->close();
?>



