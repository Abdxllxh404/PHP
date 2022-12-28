<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Example2-2</title>
</head>

<body>
    <?php
      $q = "php mariadb";
      $b = 10;
      $n = 10;
      $t = 1000;
      $x = 1200;

      echo '<b>Single Quotes</b><br> ค้นหา: $q ผลลัพธ์ลำดับที่ $b - $n จากทั้งหมด $t';
      echo "<br><br>";
      echo "<b>Double Quotes</b><br> ค้นหา: $q ผลลัพธ์ลำดับที่ $b - $n จากทั้งหมด  $t";

      //!/*  ! หากเป็น Single Quotes จะไม่สามารถเรียกใช้ตัวแปร $ ใน ' ' ได้ ต้องใช้เป็น Double Quotes" " เท่านั้น */

      $a = 10;
      $b = 100;
      $c = 1000;
      $z = 10000;

      echo "<br><br>เริ่มนับจาก $a จนไปถึง $b จึงจะสามารถ $c ได้<br>"
      
?>
</body>

</html>