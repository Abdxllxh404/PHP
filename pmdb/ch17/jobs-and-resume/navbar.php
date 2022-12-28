 <?php
 function is_active(...$file) {
      $path = $_SERVER['PHP_SELF'];   //ห้ามใช้: __FILE__
      foreach ($file as $f) {
            if (stripos($path, $f) != null) {
                  return ' active';     //คลาส active ของ Bootstrap		
            }
      }
      return '';
 }
?>
<header class="p-2" style="background: url('bg-tile.jpg')">
      <h2 class="text-success">My Company</h2>
      <div>Lorem Ipsum is simply dummy text of the printing...</div>      
</header>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
      <a href="#" class="navbar-brand text-warning">DeveloperThai</a>
      <button class="navbar-toggler" type="button" 
              accesskey=""data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon"></span>
      </button>
       <div class="collapse navbar-collapse" id="navbarToggler">     
      <ul class="navbar-nav">
            <li class="nav-item<?= is_active('/index.php') ?>">
                <a class="nav-link" href="index.php">หน้าหลัก</a></li>
            <li class="nav-item<?= is_active('/product.php') ?>">
                  <a class="nav-link" href="#">สินค้า</a></li>
            <li class="nav-item<?= is_active('/contact.php') ?>">
                  <a class="nav-link" href="#">ติดต่อ</a></li>
            <li class="nav-item<?= is_active('/jobs.php') ?>">
                <a class="nav-link" href="jobs.php">รับสมัครงาน</a></li>
      </ul>
      </div>
</nav>

