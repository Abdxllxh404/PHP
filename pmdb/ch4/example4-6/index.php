<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-6</title>
</head>
<body>
<b>การใช้ nl2br():</b>
<?php
      $str = 'บรรทัดที่ 1
                  บรรทัดที่ 2
                  บรรทัดที่ 3';	

      echo "<p>เขียนสตริงลงไปโดยตรง:<br> $str</p>";
      
      $s = nl2br($str);
      echo "<p>เขียนสตริงหลังจากใช้ nl2br():<br>$s</p>";
      
      echo '<hr><b>การใช้ฟังก์ชันเกี่ยวกับ HTML</b><br><br>';
      $str = '<b>ใช้เปลี่ยนข้อความให้เป็นตัวหนา และแท็ก <br> ใช้สำหรับขึ้นบรรทัดใหม่</b>';
      echo '<u>เขียนสตริงลงไปตรงๆ:</u><br>' . $str;

      $sp_char = htmlspecialchars($str, ENT_QUOTES);
      echo '<br><br><u>ใช้ฟังก์ชัน htmlspecialchars(): </u><br>' . $sp_char;

      $strip = strip_tags($str, '<b>');
      echo '<br><br><u>ใช้ฟังก์ชัน strip_tags(): </u><br>' . $strip;
?>
</body>
</html>
