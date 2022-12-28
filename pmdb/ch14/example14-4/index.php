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
            a.btn { 
                  width: 250px; 
            }
      </style>
</head>
<body class="d-flex flex-column align-items-center justify-content-center p-4">
<?php
session_start();
if (!isset($_SESSION['signed_in'])) {   //ถ้าไม่มีข้อมูลในเซสชั่นแสดงว่ายังไม่เข้าสู่ระบบ
      echo <<<HTML
      <a href="signin.php" class="btn btn-primary mb-4">เข้าสู่ระบบ</a><br>
      <a href="signup.php" class="btn btn-primary">สมัครสมาชิก</a>
      HTML;
} else {          //ถ้ามีข้อมูลในเซสชั่นแสดงว่าเข้าสู่ระบบแล้ว
      echo <<<HTML
      <div class="alert alert-primary m-auto" role="alert">
            <p>ท่านเข้าสู่ระบบแล้ว</p>
            <a href="signout.php">ออกจากระบบ</a>
      </div>                  
      HTML;
}
?>
</body>
</html>


