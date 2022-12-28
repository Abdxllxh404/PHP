<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 14-4</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
       <style>
            html, body { 
                  width: 100%;
                  height: 100%; 
            }
            body { 
                  background-color: azure; 
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
<body class="d-flex flex-column p-4">
<form method="post" class="m-auto">
<?php
//ถ้ามีข้อมูลถูกโพสต์เข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['fname'] . '  ' . $_POST['lname'];
      $email = $_POST['email'];
      $pswd = $_POST['password'];
      $verify = mt_rand(1000, 99999);
      //จัดเก็บข้อมูลลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch14');
      $sql = 'INSERT INTO member VALUES (?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $p = [0, $email, $pswd, $name, $verify];
      $stmt->bind_param('issss', ...$p);
      $stmt->execute();

      $aff_rows = $stmt->affected_rows;
      $msg = '';
      $contextual = '';

      //ถ้าไม่มีข้อผิดพลาดในการบันทึกข้อมูล
      //ให้ส่งรหัสยืนยันไปทางอีเมล
      if ($aff_rows == 1) {
            require '../../lib/PHPMailer/PHPMailer.php';
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->setFrom('admin@example.com', 'Admin');
            $mail->addAddress("$email");
            $mail->Subject = 'รหัสยืนยัน';
            $mail->Body = "รหัสยืนยันการสมัครสมาชิก: $verify";
            $mail->CharSet = 'utf-8';
            $mail->send();

            $msg = 'การสมัครสมาชิกเสร็จเรียบร้อย<br>
                         และเราได้ส่งรหัสยืนยันไปทางอีเมลแล้ว<br>
                         กรุณานำรหัสดังกล่าวมายืนยันในขั้นตอนการเข้าสู่ระบบ';

            $contextual = 'alert-success';
      } else {
            $msg = 'การสมัครสมาชิกเกิดข้อผิดพลาด';
            $contextual = 'alert-danger';
      }

      //แจ้งผลการบันทึกข้อมูลด้วย Alert ของ Bootstrap
      echo <<<HTML
      <div class="alert $contextual alert-dismissible">
              $msg
              <button class="close" data-dismiss="alert" 
                              aria-hidden="true">&times;</button>
      </div> 
      HTML;

      $stmt->close();
      $mysqli->close();
}
?> 
<h6 class="text-center mb-3">สมัครสมาชิก</h6>
<div class="input-group mb-3">
      <input type="text" name="fname" placeholder="ชื่อ"  class="form-control form-control-sm" required>
      <input type="text" name="lname" placeholder="นามสกุล"  class="form-control form-control-sm" required>
</div>
<input type="email" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>
<div class="input-group mb-3">
      <input type="password" name="password" placeholder="รหัสผ่าน" class="form-control form-control-sm" required>
      <input type="password" name="password2" placeholder="ใส่รหัสผ่านซ้ำ" class="form-control form-control-sm" required>
</div>
<button type="button" id="ok" class="btn btn-primary btn-sm d-block mx-auto px-4 my-4">ตกลง</button>
<div class="text-center">
    <a href="index.php">หน้าหลัก</a>
</div>
</form>
</body>
</html>
