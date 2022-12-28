<?php
/* ฟังก์ชันที่ใช้ตรวจสอบว่า ไฟล์ของเพจปัจจุบันตรงกับเมนูใด 
* เพื่อจะทำให้เมนูของเพจปัจจุบันอยู่ในสถานะ active (ถูกเลือก) */
 function is_active(...$file) {
       $path = $_SERVER['PHP_SELF'];   //ห้ามใช้: __FILE__
       foreach ($file as $f) {
             if (stripos($path, $f) != null) {
                  return ' active';         //คลาส active ของ Bootstrap
            }  
       }
       return '';
 }
?>

<!--  navbar ของ bootstrap โดยให้ขยายออกในหน้าจอขนาด md 
        และซ่อนในหน้าจอเล็กว่า md (เปิดแสดงโดยคลิกที่ไอคอน hamburger)  -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand text-warning" href="index.php">Web Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon"></span>
      </button>            
      <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-2  mt-md-0">
                  <li class="nav-item<?= is_active('/index.php') ?>">
                        <a class="nav-link" href="index.php">หน้าแรก</a>
                  </li>
                  <li class="nav-item"><a class="nav-link" href="#">การสั่งซื้อและจัดส่ง</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">แจ้งชำระเงิน</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">ติดต่อเรา</a></li>
            </ul>
      </div>
</nav>