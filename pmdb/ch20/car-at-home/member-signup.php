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
                  var p1 = $('[name="psw"]').val().trim();
                  var p2 = $('[name="psw2"]').val().trim();
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
<body class="d-flex pt-5">
<?php require 'navbar.php'; ?>
    
<form method="post" class="px-2 mx-auto pt-3 mt-3 mt-md-0">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
      $email = $_POST['email'];
      $psw = $_POST['psw'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $phone = $_POST['phone'];
      $province = $_POST['province'];

      //จัดเก็บข้อมูลลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');
      $sql = 'INSERT INTO member VALUES (?, ?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $p = [0, $email, $psw, $fname, $lname, $phone, $province];
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
            //header('location: member-signin.php');
            echo '<script> location.href = "member-signin.php"; </script>';
            exit;
      }          
}
?> 
<h6 class="mt-5 mb-4 text-info text-center">สมัครสมาชิก</h6>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>

<div class="input-group input-group-sm">
      <input type="password" name="psw" placeholder="รหัสผ่าน" maxlength="20" class="form-control w-auto" required>
      <input type="password" name="psw2" placeholder="ใส่รหัสผ่านซ้ำ" class="form-control w-auto" required>
</div>
<div class="input-group input-group-sm my-3">
      <input type="text" name="firstname" placeholder="ชื่อ" maxlength="20" class="form-control w-auto" required>
      <input type="text" name="lastname" placeholder="นามสกุล" class="form-control w-auto" required>
</div
<div class="d-flex justify-content-between">
      <input type="text" name="phone" placeholder="โทร"  class="form-control form-control-sm mb-3 d-inline w-auto" required>
      <div class="d-md-inline">
      <span class="small mt-1 ml-2">จังหวัด</span>
      <select name="province" class="custom-select custom-select-sm d-inline w-auto">
      <?php
            $file = fopen('provinces.txt', 'r');
            while (!feof($file)) {
                  $p = fgets($file);
                  echo <<<HTML
                  <option value="$p">$p</option>
                  HTML;
            }
            fclose($file);
      ?>  
      </select>
      </div>
</div>
<button type="button" id="ok" class="btn btn-primary btn-sm d-block w-25 mx-auto mt-4">ตกลง</button><br>

<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br> 
</form>

 <?php require 'footer.php'; ?>
    
</body>
</html>
