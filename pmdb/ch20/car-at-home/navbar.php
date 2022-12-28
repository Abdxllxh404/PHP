<nav class="navbar navbar-expand-lg navbar-dark fixed-top border-bottom pl-2 justify-content-between bg-light">   
<!-- Side Menu -->    
<div class="side-menu left">
      <ul>
            <li><a href="index.php"><!-- class="active" --><i class="fas fa-home"></i>หน้าแรก</a></li>
            <li><a href="car-advert.php"><i class="fas fa-car-side"></i>ประกาศขายรถ</a></li>
            <li> <a href="#"><i class="fas fa-question"></i>วิธีการใช้งาน<i class="fa fa-caret-down"></i></a>
              <ul>	<!-- Submenu -->
                      <li><a href="#"><i class="fas fa-ellipsis-v"></i>เมนูย่อย 1</a></li>
                      <li><a href="#"><i class="fas fa-ellipsis-v"></i>เมนูย่อย 2</a></li>
                      <li><a href="#"><i class="fas fa-ellipsis-v"></i>เมนูย่อย 3</a></li>
              </ul>
              </li>
              <li><a href="#"><i class="fas fa-phone"></i>ติดต่อเรา</a></li>
              <li><a href="admin-signin.php"><i class="fas fa-at"></i>admin</a></li>
      </ul>	
      <!-- ปุุ่ม menu bar เพื่อซ่อนและแสดงเมนู ไห้วางไว้ท้ายสุด -->
      <a href="#" class="side-menu-toggle mt-2"><i class="fas fa-bars"></i></a>
</div>
    
<div class="mb-1 mr-5">    
      <a href="index.php" class="navbar-brand ml-5 text-success">Car@Home</a>   
      <!-- ปุ่มที่แสดงตามสถานะการเข้าสู่ระบบ -->
      <div class="dropdown d-inline">
       <?php
       @session_start();           
       if (isset($_SESSION['admin'])) {   //ถ้าเข้าสู่ระบบในฐานะ admin
             echo <<<HTML
            <button class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">Admin</button>
            <div class="dropdown-menu">
                   <a class="dropdown-item" href="admin-signout.php">ออกจากระบบ</a>
            </div>
            HTML;
       }   else if (isset($_SESSION['member_name'])) {      //ถ้าเข้าสู่ระบบในฐานะสมาชิก
             echo <<<HTML
            <button class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">{$_SESSION['member_name']}</button>
            <div class="dropdown-menu">
                   <a class="dropdown-item" href="car-advert.php">ประกาศขายรถยนต์</a>
                   <a class="dropdown-item" href="search.php?seller={$_SESSION['member_id']}">รถที่ประกาศขายไว้แล้ว</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">แก้ไขข้อมูลสมาชิก</a>
                   <a class="dropdown-item" href="member-signout.php">ออกจากระบบ</a>
            </div>
            HTML;
       } else {         //ถ้ายังไม่เข้าสู่ระบบ
             echo '<a href="member-signin.php" class="btn btn-danger btn-sm">ลงชื่อเข้าใช้</a>';
       }
       ?>
      </div>
</div>

<!-- 
      ในส่วนของฟอร์ม หากมีการส่ง Query String เป็นชื่อยี่ห้อ และ/หรือ รุ่น เข้ามา 
      ให้นำไปเติมลงในอินพุทของฟอร์ม
-->
 <?php
$_brand = $_GET['brand'] ?? '';
$_model = $_GET['model'] ?? '';
 ?>
<form action="search.php" class="mt-2 mt-md-1">
      <div class="input-group input-group-sm">
            <div class="input-group-prepend d-none d-lg-inline">
                  <span class="input-group-text">ค้นหารถ</span>
            </div>
          <input type="text" name="brand" class="form-control" placeholder="ยี่ห้อ" value="<?= $_brand ?>">
          <input type="text" name="model" class="form-control" placeholder="รุ่น" value="<?= $_model ?>">
          <div class="input-group-append">
                  <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-danger" type="button" onclick="javascript: alert('สำหรับการค้นหาขั้นสูง\nให้ลองทำเพิ่มเติมเอาเอง')">
                      <i class="fas fa-search-plus"></i>
                  </button>
          </div>
      </div>
</form>
</nav>