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

          form {
                min-width: 150px;
                max-width: 250px;
          }
          
          form a.btn {
                width: 200px;
          }
      </style>
</head>
<body>
<?php require 'navbar.php'; ?>
<form method="post" class="mx-auto mt-5">
<?php     
//ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
      $login = $_POST['login'];
      $pswd = $_POST['pswd'];          
      if ($login = 'admin' && $pswd == '12345') {
            $_SESSION['admin'] = '1';
      } else  {
             echo <<<HTML
            <div class="alert alert-danger mt-4 mb-4" role="alert">
                  ชื่อหรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            HTML; 
      }           
}

if (!isset($_SESSION['admin'])) {
     echo <<<HTML
      <h6 class="text-info text-center mt-3 mb-4">ชื่อและรหัสผ่านของผู้ดูแลเว็บไซต์</h6>
      <input type="text" name="login" placeholder="ชื่อ" class="form-control form-control-sm mb-3">
      <input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-3">   
      <button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>
     HTML;
} else {
      echo <<<HTML
      <h6 class="text-info text-center mt-3 mb-4">สำหรับผู้ดูแลเว็บไซต์</h6>
      <a href="admin-add-jobs.php" class="btn btn-primary btn-sm mb-3 d-block mx-auto">ประกาศรับสมัครงาน</a>
      <a href="applicant.php" class="btn btn-success btn-sm d-block mx-auto mb-5">ตรวจสอบผู้สมัครงาน</a>                           
      <a href="admin-signout.php" class="btn btn-danger btn-sm d-block mx-auto">ออกจากระบบ</a> 
      HTML;
}
?>      
<br><br><br><br><br>
</form>
<?php require 'footer.php'; ?>
</body>
</html>