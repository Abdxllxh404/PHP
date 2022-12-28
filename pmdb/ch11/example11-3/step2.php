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
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['address'] = $_POST['address'];
      header('location: step3.php');
      exit;
}
?>
<form method="post" class="m-auto">
      <h6>ชื่อและที่อยู่</h6>
      <input type="text" name="name" placeholder="ชื่อและนามสกุล" required class="form-control form-control-sm my-3">
      <textarea name="address" placeholder="ที่อยู่" rows="3" class="form-control form-control-sm"></textarea>
      <button class="btn btn-primary btn-sm px-4 mt-3">ขั้นตอนถัดไป &raquo;</button><br>
</form>
</body>
</html>
