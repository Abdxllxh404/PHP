<footer class="text-center fixed-bottom text-white bg-dark py-1">
      &copy;developerthai.com&nbsp;&nbsp;&nbsp;
<?php
//ถ้า admin ล็อกอินเข้าสู่ระบบแล้ว ให้แสดงปุ่มแบบ dropdown พร้อมทางเลือกสำหรับ admin
@session_start();
if (isset($_SESSION['admin'])) {
      echo <<<HTML
      <div class="dropup d-inline">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle small" data-toggle="dropdown">admin</button>
            <div class="dropdown-menu">
                  <a class="dropdown-item" href="admin-add-product.php">เพิ่มรายการสินค้า</a>
                  <a class="dropdown-item" href="admin-signout.php">ออกจากระบบ</a>
            </div>
      </div>                  
      HTML;
} else {          //ถ้ายังไม่เข้าสู่ระบบ ให้แสดงลิงก์เพื่อเชื่อมโยงไปยังเพจ signin
      echo '[<a href="admin-signin.php" class="text-warning">admin</a>]';
}
?>
</footer>

