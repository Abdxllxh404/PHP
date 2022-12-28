<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
          html, body {
                width: 100%;
                height: 100%;
          }
          body { background-color: azure; }
          form {
                min-width: 150px;
          }
      </style>
</head>
<body class="d-flex flex-column p-4">
<form method="post" class="m-auto">
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $user = $_POST['user'];
            $pswd = $_POST['pswd'];
            
            //เชื่อมต่อกับฐานข้อมูลด้วยชื่อผู้ใช้และรหัสผ่านที่ถูกส่งเข้ามา
            $mysqli = @(new mysqli("localhost", "$user", "$pswd"));
            
           if ($mysqli->connect_error) {        //หากเชื่อมต่อไม่ได้ ให้แสดงข้อผิดพลาด   
	echo '<h6 class="text-danger text-center">' . 
                              $mysqli->connect_error . '</h6>';
            } else {          //หากเชื่อมต่อได้ ให้เก็บค่าไว้ในเซสชันเพื่อใช้งานในเพจอื่นๆ                 
                  $_SESSION['user'] = $user;
                  $_SESSION['password'] = $pswd;
                  header('location:  index.php');     //ย้ายไปยังเพจหลัก
                  exit;
            }    
      }
      ?>
      <div class="mb-2 mt-4">ชื่อผู้ใช้และรหัสผ่านของฐานข้อมูล MariaDB</div>
      <input type="text" name="user" placeholder="ชื่อผู้ใช้" value="root" class="form-control form-control-sm mb-3" required>
      <input type="password" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm"> 
      <label class="mb-4">*** ถ้าไม่มีรหัสผ่าน ให้เว้นว่างเอาไว้ ***</label>
      <button class="btn btn-primary btn-sm d-block m-auto px-5">ตกลง</button>
</form>
</body>
</html>