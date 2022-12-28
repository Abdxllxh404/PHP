<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-5</title>
</head>
<body>
<?php
      $symbols = [':('=>'cry', ':)'=>'laugh', ':)'=>'happy', ':('=>'sad', 
                              'X('=>'angry', ':-S'=>'worry', ':P'=>'tongue', ':D'=>'biggrin', 
                              ';)'=>'wink',  ':x'=>'love', ':-B'=>'nerd', ':-*'=>'kiss', ':-/'=>'confuse', 
                              ':-O'=>'surprise', '(:|'=>'yawn'];

      $msg = 'ลืมเรื่องราวที่ทำคุณต้องเสียใจ :(:-S ร้องให้ :( 
                   จงยิ้มและหัวเราะเยาะมัน :):):D:D:):) <br>
                   เด็กเนิร์ดคนนี้ :-B:-O  พร้อมเป็นกำลังใจให้คุณเสมอ :P;)
                  รักนะจุ๊บจุ๊บ :-*:x:x:-* <br>... (:|(:| ราตรีสวัสดิ์ (:|(:| ...';

      echo "<h4>ข้อความเดิม</h4>$msg<hr>";

      foreach($symbols as $sym =>$icn) {
            //นำค่าของสัญลักษณ์นั้นมากำหนดเป็นชื่อภาพ (ทุกภาพเป็นชนิด gif)
            $img = "<img src=\"emoticons/$icn.gif\">";
            //นำแท็ก <img> ไปแทนที่สัญลักษณ์นั้น
            $msg = str_replace($sym, $img, $msg);
      }
      echo "<h4>ข้อความหลังแทนที่</h4>$msg";
?>
</body>
</html>
