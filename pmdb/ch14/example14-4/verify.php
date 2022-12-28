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
      </style>
</head>
<body class="d-flex flex-column p-4">
<form method="post" class="m-auto">
<?php
session_start();
//ถ้าไม่ได้เห็บอีเมลไว้ในเซสชัน แสดงว่ายังไม่ผ่านขั้นตอนของเพจ signin.php
//ดังนั้น ก็ให้ย้ายไปยังเพจ index
if (!isset($_SESSION['email'])) {
      header('location: index.php');
      exit;
}

//กรณีที่เป็นการโพสต์ข้อมูลกลับเข้ามา ก็นำรหัสการยืนยันไปตรวจสอบกับฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_SESSION['email'];
      $verify = $_POST['verify'];

      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch14');
      $sql = "UPDATE  member SET verify = '' WHERE email = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('s', $email);
      $stmt->execute();
      $aff_rows = $stmt->affected_rows;
      //ถ้าอัปเดตแล้วมีการเปลี่ยนแปลง แสดงใส่รหัสยืนยันได้ถูกต้อง
      //ก็จัดเก็ยสถานะการเข้าสู่ระบบแล้วย้ายไปยังเพจ index
      if ($aff_rows == 1) {
            $_SESSION['signed_in'] = 1;
            header('location: index.php');
            exit;              
      } else {
            echo <<<HTML
            <div class="alert alert-danger mb-4" role="alert">
                  รหัสยืนยันไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>                  
            HTML;                      
      }
}
?>
<h6 class="text-center mb-3">รหัสยืนยันที่ได้รับทางอีเมล </h6>
<input type="text" name="verify" placeholder="รหัส"  class="form-control form-control-sm mb-3" required>   
<button class="btn btn-primary btn-sm d-block m-auto px-4 my-4">ส่งรหัส</button>
<div class="text-center">
      <a href="index.php">ยกเลิก</a>
</div>
</form>
</body>
</html>
