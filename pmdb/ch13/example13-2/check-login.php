<?php
$login = strtolower($_POST['user']);
if(in_array(substr($login, 0, 1), range('a', 'f'))){
      echo "Login: $login \nมีผู้ใช้แล้ว";
} else{ 
      echo "Login: $login \nสามารถใช้ได้"; 
}
?>


