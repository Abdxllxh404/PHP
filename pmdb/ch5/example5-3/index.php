<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 5-3</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
          body {
                background: azure;
          }

          #main-container {
                max-width: 400px;  
          }
          
          form {
                max-width: 300px;
          }
      </style>
</head>
<body class="p-4">
<?php
if (isset($_POST['login'])) {
      //ตัวแปร $_POST เป็นอาร์เรย์ ดังนั้นการแทรกในสตริงจึงใส่ในวงเล็บ { }
      echo <<<HTML
      <h5>ข้อมูลที่ได้รับ:</h5>
      ล็อกอิน: {$_POST['login']} <br>
      รหัสผ่าน: {$_POST['password']} <br>
      ข้อมูลเพิ่มเติม: {$_POST['info']} <br>
      รหัส: {$_POST['code']}
      HTML;

      goto end_page;   //ถ้าไม่ต้องการแสดงฟอร์มอีก
}
?>
<form method="post" class="mx-auto">
      <h5 class="text-center">สมัครสมาชิก</h5>
      
      <label class="mt-2">ล็อกอิน:</label>
      <input type="text" name="login" class="form-control form-control-sm">
      
      <label class="mt-2">รหัสผ่าน:</label>
      <input type="password" name="password" class="form-control form-control-sm">
      
      <label class="mt-2">ข้อมูลเพิ่มเติม:</label>
      <textarea name="info" rows="2" class="form-control form-control-sm"></textarea>
      
      <input type="hidden" name="code" value="<?= mt_rand(); ?>">
      
      <button class="btn btn-primary btn-sm d-block px-4 mt-4 mx-auto">ตกลง</button>
</form>
<?php  
      end_page:
?>
</body>
</html>

