<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 6-1</title>
</head>
<body>
<?php
require 'calculator.class.php';

$cal = new Calculator();
$cal->showResult(10, 20, '*');
?>
</body>
</html>
