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
      <?php include 'head.php'; ?>
       <style>
            html, body { 
                  width: 100%;
                  height: 100%; 
                  padding-top: 4rem;
                  background: azure;
            }
            * {
                  font-size: 0.95rem;
            }
           form {
                  
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
<body class="d-flex">
<?php include 'navbar.php'; ?>
    
<form method="post" class="px-2 m-auto">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //ถ้ามีข้อมูลถูกโพสต์เข้ามา
      $email = $_POST['email'];
      $pswd = $_POST['password'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];

      //จัดเก็บข้อมูลลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');
      $sql = 'INSERT INTO member VALUES (?, ?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $p = [0, $email, $pswd, $fname, $lname, $address, $phone];
      $stmt->bind_param('issssss', ...$p);
      $stmt->execute();

      $err = $stmt->error;
      $aff_rows = $stmt->affected_rows;
      $insert_id = $mysqli->insert_id;                       
      $stmt->close();
      $mysqli->close();

      if ($err || $aff_rows != 1) {           
            $msg = 'การสมัครสมาชิกเกิดข้อผิดพลาด<br>อีเมลที่ระบุอาจถูกใช้แล้ว';
            $contextual = 'alert-danger';
            echo <<<HTML
            <div class="alert $contextual alert-dismissible">
                  $msg
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div> 
            HTML;  
      } else {
            $_SESSION['member_id'] = $insert_id;
            $_SESSION['member_name'] = $fname;
            echo '<script> location.href = "member-signin.php"; </script>';
            exit;
      }           
}
?> 
<h6 class="mb-3 text-info text-center">สมัครสมาชิก</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>

<div class="input-group input-group-sm">
      <input type="password" name="password" placeholder="รหัสผ่าน" class="form-control w-auto" required>
      <input type="password" name="password2" placeholder="ใส่รหัสผ่านซ้ำ" class="form-control w-auto" required>
</div>
<div class="input-group input-group-sm my-3">
      <input type="text" name="firstname" placeholder="ชื่อ" class="form-control w-auto" required>
      <input type="text" name="lastname" placeholder="นามสกุล" class="form-control w-auto" required>
</div>
<textarea name="address" rows="2" class="form-control form-control-sm mb-3" placeholder="ที่อยู่" required></textarea>
<input type="text" name="phone" placeholder="โทร"  class="form-control form-control-sm mb-3" required>
<button type="button" id="ok" class="btn btn-primary btn-sm d-block w-25 mx-auto mt-4">ตกลง</button><br>
<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br> 
</form>

<?php include 'footer.php'; ?>    
</body>
</html>
