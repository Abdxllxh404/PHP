<?php
session_start();
//session_destroy();
unset($_SESSION['member_id'], $_SESSION['member_name']);
header('location: member-signin.php');
exit;
?>
