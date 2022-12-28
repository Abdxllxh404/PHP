<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-8</title>
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
      </style>
</head>
<body>
<?php
      $msg =<<<MSG
      ดาวน์โหลดโค้ดได้ที่ http://www.developerthai.com <br>
      และสั่งซื้อออนไลน์ได้จาก https://se-ed.com/
      MSG;
      
      echo <<<HTML
      <h4>ข้อความก่อนการแทนที่:</h4>
      <div>$msg</div>
      HTML;

      $pattern_url = '/(http(s?):\/\/)([a-z0-9\-]+\.)+[a-z]{2,4}';
      $pattern_url .= '(\.[a-z]{2,4})*(\/[^ ]+)*/i';

      $replace_pattern = '<a href="\\0">\\0</a>';
      $msg = preg_replace($pattern_url, $replace_pattern, $msg);

      echo <<<HTML
      <hr>
      <h4>ข้อความหลังการแทนที่:</h4>
      <div>$msg</div>
      HTML;
?>
</body>
</html>
