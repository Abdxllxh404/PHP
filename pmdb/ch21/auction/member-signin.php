<!DOCTYPE html>
<html>
<head>
      <?php include 'head.php'; ?>
      <style>
            html, body {
                  widh: 100%;
                  height: 100%;
                  padding-top: 4rem;
                  background: azure;
            }
            * {
                  font-size: 0.95rem;
           }
          #main-form {
                max-width: 300px;
                min-width: 250px;
          }
      </style>
</head>
<body class="d-flex">
<?php include 'navbar.php'; ?>
    
<form id="main-form" method="post" class="m-auto">
<?php      
@session_start();
if (isset($_SESSION['member_id'])) {
      echo <<<HTML
      <a href="new-auction.php" class="btn bt-sm btn-info d-block mb-2 mx-auto">เปิดประมูล</a>
      <a href="search.php?mid={$_SESSION['member_id']}" class="btn bt-sm btn-success d-block mb-4 mx-auto">รายการที่เปิดประมูล</a>

      <a href="#" class="btn bt-sm btn-secondary d-block mb-2 mx-auto">แก้ไขข้อมูลสมาชิก</a>
      <a href="member-signout.php" class="btn bt-sm btn-danger d-block mb-2 mx-auto">ออกจากระบบ</a>
      HTML;

      include 'footer.php';
      exit ('</form></body></html>');
}
//ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {           
      $email = $_POST['email'];
      $pswd = $_POST['pswd'];

      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');
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
            header('location: ' . $_SERVER['PHP_SELF']);
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
<h6 class="mb-3 text-info text-center">สมาชิกเข้าสู่ระบบ</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>
<input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-4" required>   
<button type="submit" class="btn btn-sm btn-primary d-block mx-auto mb-4 w-50">เข้าสู่ระบบ</button>
<a href="member-signup.php" class="btn btn-sm btn-info d-block mx-auto w-50">สมัครสมาชิก</a>      
<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br> 
</form>

 <?php include 'footer.php'; ?>
 
</body>
</html>