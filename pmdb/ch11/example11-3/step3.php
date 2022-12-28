<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <title>Example 11-3</title>
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
                  max-width: 400px;
            }
      </style>
</head>
<body class="d-flex align-items-center text-left">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();
      $_SESSION['payment'] = $_POST['payment'];
      header('location: finish.php');
      exit;
}
?>
<form method="post" class="m-auto">
      <h6>วิธีการชำระเงิน</h6>
      <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" 
                        id="radio1" name="payment" value="credit card">
            <label class="custom-control-label" for="radio1">บัตรเครดิต</label>
      </div>
      <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" 
                        id="radio2" name="payment"  value="bank transfer">
            <label class="custom-control-label" for="radio2">โอนผ่านธนาคาร</label>
      </div>
       <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" 
                        id="radio3" name="payment" value="cod (ชำระเงินปลายทาง)">
            <label class="custom-control-label" for="radio3">ชำระเงินปลายทาง</label>
      </div>    
      <button class="btn btn-primary btn-sm px-4 mt-3">ขั้นตอนถัดไป &raquo;</button><br>
</form>
</body>
</html>

