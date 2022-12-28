<?php
      session_start();
      session_destroy();
      header('location: member-signin.php');
      exit;
?>
