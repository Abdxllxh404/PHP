<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 6-3</title>
</head>
<body>
<?php
class Person {
      public $name = '';
      public $birthday = '';

      public function age() {
            $now = time();
            $birth = strtotime($this->birthday);
            $seconds_diff = $now - $birth;
            $seconds_in_year = 60 * 60 * 24 * 365; 	//จำนวนวินาทีใน 1 ปี
            $a = intval($seconds_diff / $seconds_in_year);
            return $a;
      }
}

$p1 = new Person();
$p1->name = 'Mr.Bean';
$p1->birthday = '1990/10/01';
echo "$p1->name อายุ {$p1->get_age()} ปี";
?>
</body>
</html>
