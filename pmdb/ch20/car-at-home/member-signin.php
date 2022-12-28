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
                  min-width: 300px;
            }
      </style>
</head>
<body class="d-flex pt-5">
<?php require 'navbar.php'; ?>
    
<form method="post" class="mx-auto pt-5 mt-4 mt-md-0">
<?php      
if (isset($_SESSION['member_id'])) {
      echo <<<HTML
      <h6 class="mb-4 text-info text-center">สำหรับสมาชิก</h6>
      <a href="car-advert.php" class="btn bt-sm btn-info d-block w-75 mb-2 mx-auto">ประกาศขายรถยนต์</a>
      <a href="search.php?seller={$_SESSION['member_id']}" class="btn bt-sm btn-success d-block w-75 mb-2 mx-auto">รถที่ประกาศขายไว้แล้ว</a>
      <a href="#" class="btn bt-sm btn-secondary d-block w-75 mb-2 mx-auto">แก้ไขข้อมูลสมาชิก</a>         
      <a href="member-signout.php" class="btn bt-sm btn-danger d-block w-75 mt-4 mb-2 mx-auto">ออกจากระบบ</a>
      HTML;

      include 'footer.php';
      exit ('</form></body></html>');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {   //ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
      $email = $_POST['email'];
      $pswd = $_POST['pswd'];

      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');
      $sql = 'SELECT * FROM member 
                  WHERE email = ? AND password = ?';

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('ss', $email, $pswd);
      $stmt->execute();
      $result = $stmt->get_result();
      $num_rows = $result->num_rows;
      if ($num_rows == 1) {
            $data = $result->fetch_object();
            $_SESSION['member_id'] = $data->id;
            $_SESSION['member_name'] = $data->firstname;
            $mysqli->close();
            echo '<script> location = "member-signin.php" </script>';
            exit();
      } else if ($num_rows == 0) {
             echo <<<HTML
            <div class="alert alert-danger mb-4" role="alert">
                  อีเมลหรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>     
            HTML; 
      }         
}
?>
<h6 class="mb-4 text-info text-center">สมาชิกเข้าสู่ระบบ</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>
<input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-4" required>   
<button type="submit" class="btn btn-sm btn-primary d-block mx-auto mb-4 w-50">เข้าสู่ระบบ</button>
<a href="member-signup.php" class="btn btn-sm btn-info d-block mx-auto w-50">สมัครสมาชิก</a>

<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br> 
</form>

 <?php require 'footer.php'; ?>
</body>
</html>