<?php
class Calculator {
      function showResult($num1, $num2, $op) {
            $ops = ['+', '-', '*', '/'];
            
            if (!is_numeric($num1) || !is_numeric($num2)) {
                  echo 'Not a Number';
            } else if (!in_array($op, $ops)) {
                  echo 'Operator Error!';
            } else {
                  echo "$num1 $op $num2 = ";
                  eval("echo $num1 $op $num2;"); 
                  //ฟังก์ชัน eval() ใช้ประมวลผลคำสั่ง PHP ที่เขียนในแบบสตริง
            }
      }
}

?>
