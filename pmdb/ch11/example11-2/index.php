<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 11-2</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
            html, body { 
                  width: 100%;
                  height: 100%; 
            }
      </style>
</head>
<body class="d-flex">
<?php
session_start();

if (!isset($_SESSION['login'])) {   //ถ้าไม่มีข้อมูลในเซสชั่นแสดงว่ายังไม่เข้าสู่ระบบ
      echo <<<HTML
      <div class="alert alert-warning text-center m-auto">
            <h6 class="mb-4">ท่านยังไม่เข้าสู่ระบบ</h6>
            <a href="signin.php">เข้าสู่ระบบ</a>
      </div>
      HTML;
} else {          //ถ้ามีข้อมูลในเซสชั่นแสดงว่าเข้าสู่ระบบแล้ว
      echo <<<HTML
      <div class="alert alert-primary text-center m-auto">
            <h6 class="mb-4">ท่านเข้าสู่ระบบแล้ว</h6>
            <a href="signout.php">ออกจากระบบ</a>
      </div>                  
      HTML;
}
?>
</body>
</html>