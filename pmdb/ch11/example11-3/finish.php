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
      </style>
</head>
<body class="d-flex align-items-center text-left">
      <div class="m-auto">
      สรุปข้อมูล: <br>
      <?php
            session_start();
            if (count($_SESSION) == 0) {
                  header('location: index.php');
                  exit;
            }

            echo <<<HTML
            Login: {$_SESSION['login']} <br>
            Password: {$_SESSION['password']} <br>
            Name: {$_SESSION['name']} <br>
            Address: {$_SESSION['address']} <br>
            Payment: {$_SESSION['payment']} <br>
            HTML;
      ?>
      <button class="btn btn-primary btn-sm px-4 mt-3" onclick="location.href='index.php'">หน้าแรก</button><br>
      </div>
</body>
</html>
