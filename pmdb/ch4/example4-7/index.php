<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-7</title>
      <style>
         * :not(h4) {
                font-size: 0.9rem;
          }
          
          h4 {
                margin: 4px 0px;
                clear: left;
          }
          
          hr {
                width: 90%;
                float: left;
          }
          .red {
                color: red;
          }
      </style>
</head>
<body>
<?php
$str1 = 'Regular Expression หรือ RegEx เป็นวิธีการตรวจสอบข้อมูลที่เริ่มใช้ในภาษา Perl 
              แต่ปัจจุบันภาษาคอมพิวเตอร์อื่นๆ เช่น PHP, .NET, JavaScript ก็ได้นำรูปแบบของ RegEx ไปใช้ด้วย';

//ค้นหาคำว่า 'regex' หรือ 'regular expression' (ไม่สนใจความแตกต่างของตัวพิมพ์)
$find_pattern = '/(regex)|(regular expression)/i';

/* \\0 ใช้อ้างถึงสตริงที่ตรงกับทั้งแพตเทิร์นย่อยๆ อันใดอันหนึ่ง   */
$replace_pattern = '<b class="red">\\0</b>';
$str2 = preg_replace($find_pattern, $replace_pattern, $str1);
			
echo "<h4>สตริงก่อนการแทนที่:</h4>
            $str1
            <hr>
            <h4>สตริงหลังการแทนที่:</h4>
            $str2";
?>
</body>
</html>
