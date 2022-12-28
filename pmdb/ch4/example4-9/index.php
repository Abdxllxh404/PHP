<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-9</title>
</head>
<body>
<?php
function rand_a_z() {
      $a = ord('a');    //เลขรหัสของตัว a
      $z = ord('z');    //เลขรหัสของตัว z
      $n = rand($a, $z);      //สุ่มเลขระหว่างรหัสของ a-z
      return chr($n);   //แปลงจากตัวเลขกลับไปเป็นอักขระ a-z
}

function rand_A__Z() {
      $n = rand(ord('A'), ord('Z'));
      return chr($n);
}

function create_pswd($length) {
      $ps = '';
      for ($i = 0; $i < $length; $i++) {
            $x = rand(0, 9);  
            if ($x >= 7) {   //ได้เลข 7 ขึ้นไป ให้ตำแหน่งดังกล่าวเป็นตัว A-Z      
                  $ps .= rand_A__Z();
            } else if ($x >= 4) {  //ได้เลข 4 ขึ้นไป ให้ตำแหน่งดังกล่าวเป็นตัว a-z
                  $ps .= rand_a_z();
            } else {          //ได้เลขอื่นๆ ให้ตำแหน่งดังกล่าวเป็นเลข 0 - 9
                  $ps .= rand(0, 9);    
            }
      }   
      return $ps;
}

echo 'Your Password: ' . create_pswd(8);
?>
</body>
</html>
