<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Example2-1</title>
</head>

<style>
      * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;

            /* ควร RESET ค่าเริ่มต้นก่อนทำการใช้ CSS ทุกครั้ง */
      }
      
</style>

<body>
    <h3><?php echo "PHP & MariaDB"; ?></h3>
    <h1>การเรียนรู้ php</h1>

    <div style="font-size: larger; color: red;">
        <?php echo "<b>สิ่งที่ต้องติดตั้ง:</b>"; ?>
    </div>
    <ul>
        <?php
      echo "<li>Apache</li><br>";
      echo "<li>PHP</li>";
      echo "<li>MariaDB</li>";
      echo "<li>MySql</li>";
      //!
      //!
?>
    </ul>
    
</body>

</html>