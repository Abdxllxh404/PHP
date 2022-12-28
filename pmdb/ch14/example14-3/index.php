<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 14-3</title>
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

            #simplecaptcha {
                  display: block;
                  margin-bottom: 5px;                 
            }
      </style>
</head>
<body class="d-flex p-4">
<form method="post" class="m-auto">
<?php
@session_start();
//ถ้าเป็นการส่งข้อมูลจากฟอร์มกลับขึ้นมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $msg = '';
      $contextual = '';
      if ($_POST['captcha'] == $_SESSION['captcha']) {
            $msg = 'คุณใส่อักขระ CAPTCHA ถูกต้อง';
            $contextual = 'success';
      } else {
             $msg = 'คุณใส่อักขระ CAPTCHA ไม่ถูกต้อง';
            $contextual = 'danger';            
      }
       //แสดงข้อความว่าใส่แคปต์ชาถูกหรือไม่
      echo <<<HTML
      <div class="alert alert-$contextual alert-dismissible mt-4">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
      HTML;      
}

require '../../lib/SimpleCaptcha/captcha.class.php';       
$captcha = new SimpleCaptcha();
$captcha->text_length(6);
$captcha->text_color('brown', 'green', 'navy');
$captcha->show();
 ?>
<div class="form-group d-inline-block clear-left">
      <label>อักขระที่ปรากฏในภาพ:</label>
      <input type="text" name="captcha" class="form-control form-control-sm" required>
</div>
<button class="btn btn-primary btn-sm d-block mt-2 px-4 mx-auto">ตกลง</button>
</form>
</body>
</html>

