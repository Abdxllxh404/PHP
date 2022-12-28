<?php @session_start();  ?>
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
          form {
                min-width: 250px;
                max-width: 400px;
          }
      </style>
</head>
<body class="d-flex pt-5">
<?php require 'navbar.php'; ?>
<form method="post" class="m-auto mt-5">
<?php     
//ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $login = $_POST['login'];
      $pswd = $_POST['pswd'];

      if ($login = 'admin' && $pswd == '12345') {
            $_SESSION['admin'] = '1';
      } else  {
             echo <<<HTML
            <div class="alert alert-danger mt-5 mb-4" role="alert">
                  ชื่อหรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            HTML; 
      }           
}

if (!isset($_SESSION['admin'])) {
     echo <<<HTML
      <h6 class="text-info text-center mt-5 mb-3">ผู้ดูแลเว็บไซต์เข้าสู่ระบบ</h6>
      <input type="text" name="login" placeholder="ชื่อ" class="form-control form-control-sm mb-3">
      <input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm">   
      <button class="btn btn-primary btn-sm d-block mt-4 mx-auto  px-5">ตกลง</button>
     HTML;
} else {
      echo <<<HTML
      <h6 class="text-info text-center mt-5 mb-3">สำหรับผู้ดูแลเว็บไซต์</h6>            
      <a href="admin-add-product.php" class="btn btn-info btn-sm d-block mx-auto">เพิ่มรายการสินค้า</a>                    
      <a href="admin-signout.php" class="btn btn-danger btn-sm d-block mx-auto mt-4">ออกจากระบบ</a> 
      HTML;
}
?>      
<br><br><br><br><br>
</form>
<?php require 'footer.php'; ?>
</body>
</html>