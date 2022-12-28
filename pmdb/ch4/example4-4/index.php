<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-4</title>
</head>
<body>
<?php
      $rudes = ['xxx', 'yyy', 'zzz'];	//สมมติว่าเป็นคำหยาบ
      $msg = 'I want zzz but she needs Xxx!';
      $a = [];	//อาร์เรย์ว่างสำหรับเก็บคำหยาบที่พบ
      foreach ($rudes as $r) {
            if (stripos($msg, $r) != null) {     //ถ้ามีหยาบในสตริง
                  $a[] = $r;                                //ถ้าพบ ให้เก็บไว้ในอาร์เรย์
            }
      }
      
      if (count($a) > 0) {
            //รวมอาร์เรย์เป็นสตริงเดียวกันโดยคั่นด้วย  <br> เพื่อให้ขึ้นบรรทัดใหม่
            $str = implode('<br>', $a);
            echo "พบคำที่ไม่เหมาะสมคือ: <br>$str";
      }
?>
</body>
</html>
