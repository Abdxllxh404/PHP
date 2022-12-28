<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-11</title>
</head>
<body>
<?php
function thai_datetime_friendly($timestamp) {
      $now = strtotime('now');
      if (!$timestamp || $timestamp > $now) { 
            exit; 
      }
      $diff = $now - $timestamp;

      $second = 1;
      $minute = 60 * $second;
      $hour = 60 * $minute;
      $day = 24 * $hour;
      $yesterday = 48 * $hour;
      $month = 30 * $day;
      $year = 365 * $day;
      $dtf = '';

      if ($diff >= $year) {
              $dtf = round($diff/$year).' ปี ที่แล้ว';
      } else if ($diff >= $month) {
              $dtf = round($diff/$month).' เดือน ที่แล้ว';
      } else if ($diff > $yesterday) {
              $dtf = intval($diff/$day).' วัน ที่แล้ว';
      } else if ($diff <= $yesterday && $diff >= $day) {
              $dtf = ' เมื่อวานนี้';
      } else if ($diff >= $hour) {
              $dtf = intval($diff/$hour).' ชั่วโมง ที่แล้ว';
      } else if ($diff >= $minute) {
              $dtf = intval($diff/$minute).' นาที ที่แล้ว';
      } else if ($diff >= 5*$second) {
              $dtf = intval($diff/$second).' วินาที ที่แล้ว';
      } else {
              $dtf = 'เมื่อสักครู่';
      }
      
      return $dtf;
}

date_default_timezone_set('Asia/Bangkok');
echo 'วันเวลาปัจจุบัน: ' . date('Y/m/d H:i') . '<br>';

$datetime = strtotime('-1 days');  //แก้ไขส่วนต่างของวันเวลาได้ที่นี่
$post = date('Y/m/d H:i', $datetime);

$dtf = thai_datetime_friendly($datetime);
echo "วันเวลาที่โพสต์:  $post &raquo; $dtf";
?>
</body>
</html>
