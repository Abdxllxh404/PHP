<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 6-4</title>
</head>
<body>
<?php
class Visitor {
      private static $num_visitor = 0;

      function __construct() {
            self::$num_visitor++;
      }

      public static function num_visitors() {
            return self::$num_visitor;
      }
}

$v1 = new Visitor();
echo "ผู้เยี่ยมชมลำดับที่: {$v1->num_visitors()} <br>";

$v2 = new Visitor();
echo "ผู้เยี่ยมชมลำดับที่: {$v2->num_visitors()} <br>";

$v3 = new Visitor();
echo "ผู้เยี่ยมชมลำดับที่: {$v3->num_visitors()} <br>";
?>

</body>
</html>
