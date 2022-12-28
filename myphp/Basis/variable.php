<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variable</title>
</head>

<body>

<button type="button" class="btn btn-theme btn-theme-xs delcar" data-id="<?= $row['car_id'] ?>"><i style="font-size: 15px;" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" class="fa fa-trash" aria-hidden="true"></i></button>


    <?php

      //!การกำหนดตัวแปร php
        $a = 10;
        $b = 10.20;
        $c;    //!จะได้ค่าเป็นค่าว่าง--Null
        $firtname = 'Hello ADL Websit';

        echo "$a"," :", "$firtname <br>";
        echo "$a<br>";
        echo "$b<br>";
        echo "$c<br>";  //!Error เพราะยังไม่กำหนดค่าให้ตัวแปร

        echo "<hr>";
        /* ------------------------------------------------------------------ */

        define('tax',7);         //!การกำหนดค่าคงที่ไม่สามารถเปลี่ยนแปลงได้
        define('oracle',3.14);   //!การตรวจสอบค่าคงที่คืนค่าเป็น 1-2 or true-false

        $check_tax = defined('tax');

        echo "check_tax :" . "$check_tax<br>";
        echo  tax ."<br>";                  //!ค่าคงที่ไม่ต้องใส่=$นำหน้าเวลาใช้งาน
        echo  oracle."and".tax;             //!use.(dot)เพื่อใช้เชื่อมString
       

        if ($check_tax==1) {
            print '<br>คุณประกาศใช้ค่าคงที่แล้ว';
        }
        else if ($check_tax==null) {
            print '<br>คุณยังไม่ประกาศใช้ค่าคงที่';
        }
        
        echo '<hr>';
        /* ----------------------------------------------------------------------- */

        $x = '';
        $check_x = isset($x);
        echo  "<br>" . " " . "$check_x";
        print "<br>" . " " . "$check_x";
        



      ?>

</body>

</html>