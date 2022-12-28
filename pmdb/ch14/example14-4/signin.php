<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
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
          form {
                min-width: 250px;
          }
      </style>
</head>
<body class="d-flex p-4">
<form method="post" class="m-auto">
<?php
//ถ้าเป็นการโพสต์ข้อมูลกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();
      $email = $_POST['email'];
      $pswd = $_POST['pswd'];

      //นำอีเมลและรหัสผ่านไปตรวจสอบกับฐานข้อมูลว่าตรงกับของสมาชิกรายใดหรือไม่
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch14');
      $sql = 'SELECT * FROM member 
                  WHERE email = ? AND password = ?';

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('ss', $email, $pswd);
      $stmt->execute();
      $result = $stmt->get_result();      
      $num_rows = $result->num_rows;

      //ถ้ามีข้อมูลของสมาชิกรายนั้นอยู่จริง ก็ให้ตรวจสอบต่อไปว่าได้ยืนยันรหัสหรือยัง
      //ถ้ายังให้เก็บอีเมลในเซสชัน แล้วย้ายไปยังเพจ verify.php
      //แต่ถ้ายืนยันแล้ว ก็ให้เก็บสถานะการเข้าสู่ระบบในเซสชันแล้วย้ายไปยัง index.php
      if ($num_rows == 1) {
            $data = $result->fetch_row();
            if (!empty($data[4])) {       //คอลัมน์ verify
                  $_SESSION['email'] = $email;
                  header('location: verify.php');
                  exit;
            } else {
                  $_SESSION['signed_in'] = '1';
                  header('location: index.php');
                  exit; 
            }

      //ถ้าไม่ตรงกับของสมาชิกรายใด ก็ให้แจ้งข้อผิดพลาด
      } else if ($num_rows == 0) {
             echo <<<HTML
            <div class="alert alert-danger mb-4" role="alert">
                 อีเมลหรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" 
                        aria-hidden="true">&times;</button>
            </div>             
            HTML; 
      }           
}
?>
<h6 class="text-center mb-3">สมาชิกเข้าสู่ระบบ</h6>
<input type="text" name="email" placeholder="อีเมล" class="form-control form-control-sm mb-3" required>
<input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-3" required>   
<button class="btn btn-primary btn-sm d-block m-auto px-4 mt-4">เข้าสู่ระบบ</button>
<div class="text-center mt-4">
      <a href="index.php">หน้าหลัก</a>
</div>
</form>
</body>
</html>