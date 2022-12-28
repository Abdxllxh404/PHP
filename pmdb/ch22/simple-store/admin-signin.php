<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            html, body {
                  width: 100%;
                  height: 100%;
                  background: azure;
            }
          
            #main-form {
                  min-width: 270px;
                  max-width: 350px;
            }
      </style>
</head>
<body class="d-flex pt-5 px-3">
<?php require 'navbar.php'; ?> 

<form id="main-form" method="post" class="m-auto pt-4">
<?php     
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $login = $_POST['login'];
      $pswd = $_POST['pswd'];

      if ($login = 'admin' && $pswd == '12345') {
            $_SESSION['admin'] = '1';
      } else  {
             echo <<<HTML
            <div class="alert alert-danger mb-4" role="alert">
                  ชื่อหรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            HTML; 
      }
}

if (!isset($_SESSION['admin'])) {
     echo <<<HTML
      <h6 class="text-info text-center mb-4">ชื่อและรหัสผ่านของผู้ดูแลเว็บไซต์</h6>
      <input type="text" name="login" placeholder="ชื่อ" class="form-control form-control-sm mb-3">
      <input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-4">   
      <button class="btn btn-primary btn-sm d-block m-auto px-5">ตกลง</button>
     HTML;
} else {
      echo <<<HTML
      <h6 class="text-success text-center mb-3">สำหรับผู้ดูแลเว็บไซต์</h6>
      <a href="admin-order-list.php" class="btn btn-success btn-sm mb-2 d-block mx-auto px-5">ตรวจสอบรายการสั่งซื้อ</a>
      <a href="admin-add-product.php" class="btn btn-info btn-sm mb-5 d-block mx-auto px-5">เพิ่มรายการสินค้า</a>
      <a href="admin-signout.php" class="btn btn-danger btn-sm mb-3 d-block mx-auto px-5">ออกจากระบบ</a> 
      HTML;
}
?>      
<br><br><br>
</form>
    
<?php require 'footer.php'; ?> 
</body>
</html>