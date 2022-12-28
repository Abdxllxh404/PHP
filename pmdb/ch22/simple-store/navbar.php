<?php
/* ฟังก์ชันที่ใช้ตรวจสอบว่า ไฟล์ของเพจปัจจุบันตรงกับเมนูใด 
* เพื่อจะทำให้เมนูของเพจปัจจุบันอยู่ในสถานะ active (ถูกเลือก) */
function is_active(...$file) {
      $path = $_SERVER['PHP_SELF'];   //ห้ามใช้: __FILE__
      foreach ($file as $f) {
            if (stripos($path, $f) != null) {
                 return ' active';
           } 
      }
      return '';
}
?>
<!--  navbar ของ bootstrap โดยให้ขยายออกในหน้าจอขนาด lg
         และซ่อนในหน้าจอเล็กว่า lg (เปิดแสดงโดยคลิกที่ไอคอน hamburger)  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0 pr-2 justify-content-start" style="min-width: 600px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon"></span>
      </button>    
       
      <div class="navbar-brand text-warning">
            <i class="fa fa-shopping-bag fa-1x mr-2 d-none d-lg-inline"></i>
            <a href="index.php" style="text-decoration: none"><span class="navbar-brand text-warning">Simple Store</span></a>
      </div>
    
      <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav">
                  <li class="nav-item<?= is_active('/index.php') ?>"><a class="nav-link" href="index.php">หน้าแรก</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">การสั่งซื้อและจัดส่ง</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">วิธีชำระเงิน</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">ติดต่อเรา</a></li>
            </ul>         
      </div>
    
      <div class="col text-right my-2 pr-2">
      <?php
      @session_start();
      if (!isset($_SESSION['member_name'])) {
            echo  '<a href="member-signin.php" class="btn btn-sm btn-danger">ลงชื่อเข้าใช้</a>';
      } else {
            $name = mb_substr($_SESSION['member_name'], 0, 16);

            echo <<<HTML
            <div class="dropdown d-inline">
                  <a href=# class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" style="max-width: 160px">$name</a>
                  <div class="dropdown-menu mt-2 bg-light" style="max-width: 300px">
                        <a class="dropdown-item w-auto" href="cart.php">ตรวจสอบรถเข็นและสั่งซื้อ</a>
                        <a class="dropdown-item w-auto" href="member-order-list.php">ประวัติการสั่งซื้อและแจ้งชำระเงิน</a>
                        <a class="dropdown-item" href="#">รายการที่ชอบ</a>    
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="member-signin.php">ข้อมูลส่วนตัว</a>              
                        <a class="dropdown-item" href="member-signout.php">ออกจากระบบ</a>
                  </div>
            </div>                    
            HTML;
      }
      ?>
      </div>
    
      <!-- หากมีการส่งคีย์เวิร์ดเข้ามา ให้นำไปเติมลงในอินพุทของฟอร์ม  -->
      <?php $q = $_GET['q'] ?? '';  ?>
      
      <form class="form-inline mr-2 my-2" method="get" action="search.php"> 
            <div class="input-group input-group-sm">
                  <input type="text" name="q" class="form-control" placeholder="Search..." size="12" value="<?= $q ?>">
                  <div class="input-group-append">
                        <button class="btn btn-success">
                              <i class="fa fa-search"></i>
                        </button> 
                  </div>
            </div>
      </form>

      <a href="cart.php" class="btn bg-primary btn-sm text-white my-2">
            <i class="fas fa-lg fa-shopping-cart"></i>
            <span class="badge badge-pill badge-danger"></span>
      </a>
</nav>

<script>    
//เนื่องจาก Navbar และปุ่มรถเข็นจะปรากฏในทุกเพจ ซึ่งเมื่อเปิดเพจใด เราต้องอัปเดต
//จำนวนสินค้าในรถเข็นมาแสดงใหม่ทกครั้ง โดยฟังก์ชันต่อไปนี้ จะใช้ในการส่ง request
//ไปอ่านจำนวนสินค้าที่หยิบใส่รถเข็น เพื่อนำตัวเลขมาแสดงที่ปุ่มบน Navbar
function updateCart() {
     $.ajax({
           url: 'ajax-update-cart.php', 
           success: (result) => {  
                  if (result == 0) {
                        result = '';
                  }               
                  $('span.badge').text(result);
           }                 
      });
}

//ให้เรียกฟังก์ชัน updateCart() เมื่อองค์ประกอบต่างๆ ภายในเพจ
//ถูกโหลดมาจนครบหมดแล้ว เพื่อให้ปุ่ม Navbar พร้อมแสดงข้อมูลได้
$(function() {
     updateCart();     
});
</script>