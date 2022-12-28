<!doctype html>
<html>
<head>
      <meta charset='utf-8'>
      <title>Example 11-1</title>
</head>
<body>
<?php
require '../../lib/pagination-v2.class.php';
$page = new PaginationV2();     
$mysqli = new mysqli('localhost', 'root', '');

if (!$mysqli->select_db('pmdb_ch10')) {
      $mysqli->query('CREATE DATABASE IF NOT EXISTS pmdb_ch10');
}

$mysqli->select_db('pmdb_ch10');

$sql = 'CREATE TABLE IF NOT EXISTS pagination (
            id INT PRIMARY KEY AUTO_INCREMENT,
            item VARCHAR(150))';

$mysqli->query($sql);

$result = $mysqli->query('SELECT COUNT(*) FROM pagination');
list($count) = $result->fetch_row();
if ($count >= 123) {
      $mysqli->close();
      die('การสร้างตารางและเพิ่มข้อมูลเสร็จเรียบร้อย</body></html>');
}

$sql = 'INSERT INTO pagination VALUES ';
for ($i = 1; $i <= 123; $i++) {
      if ($i > 1) {
            $sql .= ',';
      }
      $sql .= "(0, 'รายการลำดับที่ $i')";
}

$mysqli->query($sql);

echo 'การสร้างตารางและเพิ่มข้อมูลเสร็จเรียบร้อย';

$mysqli->close();
?>
</body>
</html>