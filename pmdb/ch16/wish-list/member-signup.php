<?php 
      @session_start();
      if (isset($_SESSION['member_id'])) {
            header('location: member-signin.php');
            exit;
      }
?>
<!doctype html>
<html>
<head>
      <?php require 'head.php'; ?>
       <style>
            html, body { 
                  width: 100%;
                  height: 100%; 
                  background: azure;
            }
      </style>
      <script>
      $(function() {
            $('button#ok').click(function() {
                  var p1 = $('[name="password"]').val().trim();
                  var p2 = $('[name="password2"]').val().trim();
                  if (p1 == '' || p2 == '') {
                        alert('กรุณาใส่ password ให้ครบทั้ง 2 ช่อง');
                  } else if (p1 != p2) {
                        alert('กรุณาใส่ password ให้ตรงกันทั้ง 2 ช่อง');
                  } else {
                        $('form').submit();
                  }
            })
      });     
      </script>
</head>
<body class="d-flex pt-5 px-3">
<?php require 'navbar.php'; ?>
    
<form method="post" class="mt-5 m-auto">
<?php
//ถ้ามีข้อมูลถูกโพสต์เข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
      $email = $_POST['email'];
      $pswd = $_POST['password'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];

      //จัดเก็บข้อมูลลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_wish_list');
      $sql = 'INSERT INTO member VALUES (?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $p = [0, $email, $pswd, $fname, $lname];
      $stmt->bind_param('issss', ...$p);
      $stmt->execute();           
      $aff_rows = $stmt->affected_rows;
      $insert_id = $mysqli->insert_id;

      $stmt->close();
      $mysqli->close();

      //ถ้าสมัครสมาชิกสำเร็จ ให้จัดเก็บข้อมูลบางอย่างไว้ในเซสชัน 
      //แล้วย้ายไปที่เพจ signin เพื่อให้เข้าสู่ระบบทันที
      if ($aff_rows == 1) {                  
            $_SESSION['member_id'] = $insert_id;
            $_SESSION['member_name'] = $fname;               
            echo '<script>location="member-signin.php"</script>';
            exit;
      } else {
            echo <<<HTML
            <div class="alert alert-danger alert-dismissible">
                  การสมัครสมาชิกเกิดข้อผิดพลาด หรือมีผู้ใช้อีเมลดังกล่าวแล้ว
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div> 
            HTML;   
      }
}
?> 
<h6 class="text-info text-center mt-4 mb-3">สมัครสมาชิก</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm" required>
<div class="input-group input-group-sm mt-2 mb-4"> 
<input type="password" name="password" placeholder="รหัสผ่าน" maxlength="20" class="form-control" required>
<input type="password" name="password2" placeholder="ใส่รหัสผ่านซ้ำ" class="form-control" required>
</div>
<div class="input-group input-group-sm mt-1 mb-4">          
      <input type="text" name="firstname" placeholder="ชื่อ" class="form-control" required>
      <input type="text" name="lastname" placeholder="นามสกุล" class="form-control" required>
</div>
<button type="button" id="ok" class="btn btn-primary btn-sm d-block w-25 mx-auto mt-5">ตกลง</button>

<br><br><br><br><br>
</form>
    
<?php require 'footer.php'; ?>
</body>
</html>
