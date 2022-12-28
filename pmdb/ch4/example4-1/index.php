<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-1</title>
</head>
<body>
<?php
      $thai_text = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด',  'แปด', 'เก้า'];
      $num = '0814563972';
      $len = strlen($num);
      $text = '';
      for ($i = 0; $i < $len; $i++) {
            $n = $num[$i];
            $text .= $thai_text[$n];
      }
      echo "$num => $text";    
?>
</body>
</html>
