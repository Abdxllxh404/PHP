<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 9-1</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch9');
//คำสั่ง SQL สำหรับเพิ่มข้อมูลพร้อมกันหลายแถว (รายละเอียดอยู่ในบทที่ 8)
$sql = "INSERT INTO people VALUES
            (0, 'สมชาย พายเรือ', 'บางขุนเทียน กรุงเทพ', 'somchai@example.com', '1975-01-10'),
            (0, 'สมหญิง ยิงเรือ', 'บางบัวทอง นนทบุรี', 'somying@example.com', '1976-10-01'),
            (0, 'สมศรี ขี่เรือ', 'บางละมุง ชลบุรี', 'somsri@example.com', '1977-12-21'),	
            (0, 'สมศักดิ์ รักเรือ', 'บางพลี สมุทรปราการ', 'somsak@example.com', '1978-11-11'),
            (0, 'สมหวัง นั่งเรือ', 'บางปะอินทร์ อยุธยา',  'somwang@example.com', '1979-10-10'),	
            (0, 'สมพร นอนเรือ', 'บางระจันทร์ สิงห์บุรี', 'somporn@example.com', '1980-03-30'),
            (0, 'สมปอง มองเรือ', 'บางปะกง ฉะเชิงเทรา', 'sompongmong@example.com', '1981-02-20'),
            (0, 'สมพงษ์ ลงเรือ', 'บางเลน นครปฐม',  'sompong@example.com', '1982-06-06')";

$insert = $mysqli->query($sql);

if($insert) {
      echo 'การเพิ่มข้อมูล เกิดข้อผิดพลาด'; 
} else { 
      echo 'การเพิ่มข้อมูล เสร็จเรียบร้อย'; 
}
$mysqli->close();
?>

</body>
</html>
