<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date and Today</title>
</head>

<body>
    <?php
    echo "Today is :" . " " . date("Y/m/d") . "<br>";
    echo "Today is :" . " " . date("Y.M.D") . "<br>";
    echo "Today is :" . " " . date("Y-M-D") . "<br>";
    echo "Today is :" . " " . date("Y*M*D") . "<br>";
    echo "Today is :" . " " . date("l") . "<br>";

    //เมื่อ("Y/M/D") เมื่อเขียนพิมพ์ใหญ่จะแสดงวันที่แบบตัวเขียน
    //เมื่อใช้พิมพ์เล็ก-PHP-จะแสดงวันที่เดือนแบบตัวเลข
    echo "<hr>";
    ?>

    © 2010- <?php echo date("Y"); ?>
    <?php echo "<hr>"; ?>

    <?php
    date_default_timezone_set("Asia/Bangkok");
    echo "The time is :" . date("H:i:sa");
    //SettingTimeZone-Bangkok-Thailand
    echo "<hr>";
    ?>

    <?php
    date_default_timezone_set("Asia/Bangkok");
    $d = mktime(11, 11, 12, 13, 5, 30, 2020);
    echo "Creat date is :" . date("Y/m/d h:i:sa", $d);

    ?>
</body>

</html>