<?php
require 'check-signin.php';

if (!isset($_POST['db'])) {
      exit;
}
$db = $_POST['db'];

@session_start();
$user = $_SESSION['user'];
$pswd = $_SESSION['password'];

$mysqli = new mysqli('localhost', $user, $pswd);
//อ่านรายชื่อตารางในฐานข้อมูลที่ระบุ
$sql = "SHOW TABLES FROM $db";
$result = $mysqli->query($sql);
$text = '';
//ส่งผลลัพธ์กลับเป็นรายการ (option) ของอินพุท select
while ($tb = $result->fetch_row()) {
      $text .= "<option value=\"{$tb[0]}\">{$tb[0]}</option>";
}
echo $text;
$mysqli->close();
?>

