<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title></title>
</head>
<body>
<?php
class Random {
      private function char($from_char, $to_char) {
            $start = ord($from_char);  //ฟังก์ชัน ord() ใช้หาเลขรหัสของอักขระ
            $end = ord($to_char);
            $r = rand($start, $end);
            return chr($r);		//ฟังก์ชัน chr() ใช้แปลงเลขรหัสเป็นอักขระ
      }

      public function lowercase_letter() {
            $char = $this->char('a', 'z');
            return $char;
      }

      public function uppercase_letter() {
            $char = $this->char('A', 'Z');
            return $char;
      }

      public function password(int $length) {                 
            $password = "";
            for ($i = 0; $i < $length; $i++) {
                  $r = rand(1, 3);
                  if ($r == 1 ) {
                        $password .= rand(0, 9);
                  } else if ($r == 2) {
                        $password .= $this->lowercase_letter();
                  } else if ($r == 3) {
                        $password .= $this->uppercase_letter();
                  }
            }                       
            return $password;
      }
}

$rand = new Random();
echo $rand->lowercase_letter() . '<br>';        //OK
echo $rand->password(6) . '<br>';                  //OK
//echo $rand->char('A', 'F');       //Error เพราะ char() เป็น private method
?>
</body>
</html>
