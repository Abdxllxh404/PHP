<?php
@session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['password'])) {
      //header('location: signin.php');
      echo "<script>window.top.location.href='signin.php'</script>";
      exit;
}
?>     
