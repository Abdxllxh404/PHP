<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-3</title>
</head>
<body>
<?php
      $str = 'การตัดคำที่เป็นภาษาไทย';
      echo "ข้อความเดิม: $str<br>";

      $substr = substr($str, 0, 10);
      echo "ใช้ substr(): $substr <br>";

      $mb_substr = mb_substr($str, 0, 10, 'utf-8');
      echo "ใช้ mb_substr(): $mb_substr";      
?>
</body>
</html>
