<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Include&Require</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="#">
</head>

<body>
    <h1>Wellcome to My WEB PAGES</h1>
    <?php
            require 'NoFileExisits.php';
            echo "I have a $color $car.";
            echo "<hr>";

            include 'NoFileExisits.php';
            echo "I have a $color $car.";
            echo "<hr>";
        ?>
    <script src="#" async defer></script>
</body>

</html>