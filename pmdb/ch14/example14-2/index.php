<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 14-2</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
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
<body class="d-flex p-4">
<form method="post" class="m-auto">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $login = $_POST['login'];
      $pswd = $_POST['pswd'];

      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch14');

      $sql = "SELECT * FROM sql_injection 
                  WHERE login = '$login' AND password = '$pswd'";

      $result = $mysqli->query($sql);
      $num_rows = $result->num_rows;

     /*
      $sql = 'SELECT * FROM ch16_sql_injection
                  WHERE login = ? AND password = ?';

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('ss', $login, $pswd);
      $stmt->execute();
      $result = $stmt->get_result(); 
      $num_rows = $result->num_rows;
     */

      if ($num_rows > 0) {
            echo <<<HTML
            <div class="alert alert-primary m-auto" role="alert">
                  <p>ท่านเข้าสู่ระบบแล้ว</p>
                  <a href="javascript: location.href='index.php'" class="alert-link">ออกจากระบบ</a>
            </div>                  
            HTML;
            goto end_page;
      } else  {
             echo <<<HTML
            <div class="alert alert-danger mb-4" role="alert">
                 ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            HTML; 
      }           
}
?>
<h6 class="mb-3 text-center">สมาชิกเข้าสู่ระบบ</h6>
<input type="text" name="login" placeholder="ชื่อผู้ใช้" class="form-control form-control-sm mb-3">
<input type="text" name="pswd" placeholder="รหัสผ่าน"  class="form-control form-control-sm mb-3">
<button class="btn btn-primary btn-sm mt-3 d-block m-auto">เข้าสู่ระบบ</button>
</form>
<?php end_page: ?>
</body>
</html>
