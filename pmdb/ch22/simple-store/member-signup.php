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
            * {
                  font-size: 0.93rem;
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
                        $('#main-form').submit();
                  }
            })
      });
      </script>
</head>
<body class="d-flex pt-5 px-3">
<?php require 'navbar.php'; ?> 
    
<form id="main-form" method="post" class="mx-auto pt-5">
<?php
//ถ้ามีข้อมูลถูกโพสต์เข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
      $email = $_POST['email'];
      $pswd = $_POST['password'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];

      $address = $_POST['address'];
      $phone = $_POST['phone'];

      //จัดเก็บข้อมูลลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
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
            echo '<script>location="member-signin.php"</script>';
            exit;
      }
}
?> 
<h6 class="mb-4 text-center text-info">สมัครสมาชิก</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-2" required>
<div class="input-group input-group-sm">
      <input type="password" name="password" placeholder="รหัสผ่าน" maxlength="20" class="form-control w-auto" required>
      <input type="password" name="password2" placeholder="ใส่รหัสผ่านซ้ำ" class="form-control w-auto" required>
</div>
<div class="input-group input-group-sm mt-4 mb-2">
      <input type="text" name="firstname" placeholder="ชื่อ" maxlength="20" class="form-control w-auto" required>
      <input type="text" name="lastname" placeholder="นามสกุล" class="form-control w-auto" required>
</div>
<textarea name="address" rows="3" class="form-control form-control-sm mb-2" placeholder="ที่อยู่" required></textarea>
<input type="text" name="phone" placeholder="โทร"  class="form-control form-control-sm mb-4" required>

<button type="button" id="ok" class="btn btn-primary btn-sm d-block w-25 mx-auto mt-4">ตกลง</button>
<br><br><br><br>    
</form>

<?php require 'footer.php'; ?> 
</body>
</html>
