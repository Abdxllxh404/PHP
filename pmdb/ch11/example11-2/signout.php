<!doctype html>
<html>
<head>
</head>
<body>
<?php
session_start();
session_destroy();
echo '<script> location = "index.php" </script>';
?>
</body>
</html>