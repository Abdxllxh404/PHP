<?php
/* ฟังก์ชันที่ใช้ตรวจสอบว่า ไฟล์ของเพจปัจจุบันตรงกับเมนูใด 
* เพื่อจะทำให้เมนูของเพจปัจจุบันอยู่ในสถานะ active (ถูกเลือก) */
function is_active(...$file) {
       $path = $_SERVER['PHP_SELF'];       //ห้ามใช้: __FILE__      
       foreach ($file as $f) {
             if (stripos($path, $f) != null) {
                  return ' active';
            }  
      }
      return '';
 }
?>
<!--  navbar ของ bootstrap โดยให้ขยายออกในหน้าจอขนาด md 
        และซ่อนในหน้าจอเล็กว่า md (เปิดแสดงโดยคลิกที่ไอคอน hamburger)  -->
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
<div class="navbar-brand">         
      <button class="navbar-toggler mr-1" type="button" data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon"></span>
      </button>
      <a href="index.php" class="text-warning" style="text-decoration:none">
            <i class="fas fa-gavel fa-lg mr-2"></i> <!-- fa-flip-horizontal -->
            <span class="font-weight-bold">PHP Auction</span>
      </a>
</div>

<div class="collapse navbar-collapse mt-1" id="navbarToggler">
      <ul class="navbar-nav ml-3 mr-auto mt-lg-0">
            <li class="nav-item<?= is_active('/index.php') ?>"><a class="nav-link" href="index.php">หน้าแรก</a></li>
            <li class="nav-item<?= '' ?>"><a class="nav-link" href="#">วิธีการประมูล</a></li>
            <li class="nav-item<?= ''  ?>"><a class="nav-link" href="#">ติดต่อเรา</a></li>
            <li class="nav-item mt-1 mt-lg-2 ml-0 ml-lg-2"></li>
      </ul>
</div>
    
<div class="d-flex">
<div class="dropdown d-inline mr-3 ml-3 ml-md-0">
<?php
 @session_start();
 //แสดงปุ่มตามสถานะการเข้าสู่ระบบ
 if (isset($_SESSION['member_name'])) {
      $mname = $_SESSION['member_name'];
      $mid = $_SESSION['member_id'];
       echo <<<HTML
       <div>
      <button class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">$mname</button>
      <div class="dropdown-menu">
             <a class="dropdown-item" href="new-auction.php">เปิดประมูล</a>
             <a class="dropdown-item" href="search.php?mid=$mid">รายการที่เปิดประมูล</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="#">แก้ไขข้อมูลสมาชิก</a>
             <a class="dropdown-item" href="member-signout.php">ออกจากระบบ</a>
      </div>
      </div>
     HTML;
 } else {
       echo <<<HTML
      <a href="member-signin.php" class="btn btn-danger btn-sm">
            <i class="fas fa-user mr-1"></i>ลงชื่อเข้าใช้
      </a>
      HTML;
 }
?>
</div> 
    
<!-- หากมีการส่งคีย์เวิร์ดเข้ามา ให้นำไปเติมลงในอินพุทของฟอร์ม  -->
<?php $q = (isset($_GET['q'])) ? $_GET['q'] : '';  ?>

<form method="get" action="search.php" class="form-inline"> 
      <div class="input-group input-group-sm">
            <input type="text" name="q" class="form-control" placeholder="Search..." size="12" value="<?= $q ?>">
            <div class="input-group-append">
                  <button class="btn btn-success">
                      <i class="fa fa-search"></i>
                  </button> 
            </div>
      </div>
</form>
</div>
</nav>

