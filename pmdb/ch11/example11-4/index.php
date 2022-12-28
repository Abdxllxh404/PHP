<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <title>Example 11-4</title>
</head>
<body class="p-5">
<?php
$title = "รายการบทความ";
echo <<<HTML
      <p>$title</p>
      <ul>
            <li><a href="html.php">HTML</a></li>
            <li><a href="css.php">CSS</a></li>
            <li><a href="bootstrap.php">Bootstrap</a></li>
            <li><a href="js.php">JavaScript</a></li>
            <li><a href="jquery.php">jQuery</a></li>
            <li><a href="php.php">PHP</a></li>
      </ul>
HTML;

include "recently-viewed.php";
?>
</body>
</html>
