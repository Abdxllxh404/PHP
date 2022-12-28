<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <title>Example 11-3</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
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
                  max-width: 400px;
            }
      </style>
</head>
<body class="d-flex align-items-center text-center">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();
      $_SESSION['login'] = $_POST['login'];
      $_SESSION['password'] = $_POST['pswd'];
      header('location: step2.php');
      exit;
}
?>
<form method="post" class="m-auto">
      <h6>บัญชีผู้ใช้</h6>
      <input type="text" name="login" placeholder="ล็อกอิน" required class="form-control form-control-sm my-3">
      <input type="password" name="pswd" placeholder="รหัสผ่าน" required class="form-control form-control-sm mb-4">
      <button class="btn btn-primary btn-sm px-4 mt-3">ขั้นตอนถัดไป &raquo;</button>
</form>
</body>
</html>
