<?php  @session_start();  ?>
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
          
          form .btn {
                width: 200px;
                margin: auto;
          }
      </style>
</head>
<body class="d-flex pt-5 px-3">
<?php require 'navbar.php'; ?>
    
<form method="post" class="m-auto">
<?php      
if (isset($_SESSION['member_id'])) {
      goto signed_in;
}
//ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {         
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_wish_list');
      $sql = 'SELECT * FROM member 
                  WHERE email = ? AND password = ?';

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('ss', $_POST['email'], $_POST['pswd']);
      $stmt->execute();
      $result = $stmt->get_result();      
      $num_rows = $result->num_rows;
      if ($num_rows == 1) {
            $data = $result->fetch_object();
            $_SESSION['member_id'] = $data->id;
            $_SESSION['member_name'] = $data->firstname;
            $mysqli->close();
            echo '<script>location = "member-signin.php"; </script>' ;
            exit;
      } else if ($num_rows == 0) {
            goto error;
      } 

      //หลังการเข้าสู่ระบบ ให้แสดงทางเลือกสำหรับสมาชิก
      signed_in:
      echo <<<HTML
      <h6 class="text-info text-center mb-3 mt-3">สำหรับสมาชิก</h6>
      <a href="index.php" class="btn btn-sm btn-primary d-block mb-2">กลับไป Shopping</a>
      <a href="wish-list.php" class="btn btn-sm btn-info d-block mb-2">รายการที่ชอบ</a>
      <a href="#" class="btn btn-sm btn-secondary d-block">แก้ไขข้อมูลสมาชิก</a>
      <a href="member-signout.php" class="btn btn-sm btn-danger d-block mt-4">ออกจากระบบ</a>
      HTML;
      include 'footer.php';
      exit ('</form></body></html>');
      
      error:                  //กรณีเกิดข้อผิดพลาด
      echo <<<HTML
      <div class="alert alert-danger mb-4 mt-5" role="alert">
            อีเมลหรือรหัสผ่านไม่ถูกต้อง
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
      HTML;
}
?>
<h6 class="text-info text-center mt-4 mb-3">สมาชิกเข้าสู่ระบบ</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>
<input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-4" required>   
<button type="submit" class="btn btn-sm btn-primary d-block mx-auto mb-4 w-50">เข้าสู่ระบบ</button>
<a href="member-signup.php" class="btn btn-sm btn-info d-block mx-auto w-50">สมัครสมาชิก</a>

<br><br><br><br><br>
</form>
    
  <?php  require 'footer.php';   ?>
</body>
</html>