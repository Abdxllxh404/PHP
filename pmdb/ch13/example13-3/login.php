<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($_POST['login'] == 'jquery' && $_POST['pswd'] == 'ajax') {
          echo 'success';
      } else { 
            echo 'error';
      }
}
?>