<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-13</title>
</head>
<body>
<?php
$v = 0;
$file= "counter.txt";  //ชื่อไฟล์สำหรับเก็บข้อมูล

if (file_exists($file)) {  //ถ้ามีไฟล์อยู่แล้ว ให้ค่ามาใช้
      $v = file_get_contents($file);
} else { 
      $v = 1000;  //กำหนดค่าเริ่มต้นที่ต้องการ 
}

$v = intval($v) + 1;		//เพิ่มค่าจากเดิมไปอีก 1
$visitor = number_format($v);
echo "<div>ผู้เยี่ยมชมลำดับที่: $visitor </div>";
//อัปเดตโดยเขียนทับจำนวนเดิม (ถ้าไม่มีไฟล์อยู่ก่อน ไฟล์จะถูกสร้างให้เอง)
file_put_contents($file, $v); 
?>
</body>
</html>
