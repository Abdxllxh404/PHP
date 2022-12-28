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
            body {
                  background-color: azure; 
            }
            form {
                  max-width: 300px;
            }
      </style>
</head>
<body class="p-5">
<?php
session_start();

$err = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $login = $_POST['login'];
      $pswd = $_POST['pswd'];
      //ถ้าล็อกอินและรหัสผ่านถูกต้อง
      if ($login == 'admin' && $pswd == '12345') {
            //ถ้าเลื่อน switch เป็น on ให้เก็บข้อมูลลงในคุกกี้
            if (isset($_POST['save_account'])) {
                  $expire = time() + 5 * 60;  //ให้คุกกี้มีอายุ 5 นาที
                  setcookie('login', $login, $expire);
                  setcookie('pswd', $pswd, $expire);
            } else {    //ถ้า switch เป็น off และได้เก็บค่าไว้ในคุกกี้ ก็ให้ลบออก
                  $expire = time() - 3600;
                  if (isset($_COOKIE['login'])) {
                        setcookie('login', '', $expire);
                  }
                  if (isset($_COOKIE['pswd'])) {
                        setcookie('pswd', '', $expire);
                  }
            }
            $_SESSION['login'] = $login;  //เก็บค่าอ้างอิงไว้ในเซสชัน
            //ย้ายไปยังเพจแรก
            echo '<script>location="index.php"</script>';
            exit('</body></html>');
      } else {
            //กรณีใส่ข้อมูลผิดพลาด ให้แสดงคำเตือนด้วย Alert ของ Bootstrap
            $err =<<<HTML
            <div class="alert alert-danger alert-dissmissible" role="alert">
                  ล็อกอินหรือรหัสผ่านไม่ถูกต้อง
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            HTML;
      }
}
//ถ้าเก็บคุกกี้เอาไว้ ก็อ่านค่าเพื่อนำไปเติมลงในฟอร์ม
$login = $_COOKIE['login'] ?? '';
$pswd = $_COOKIE['pswd'] ?? '';
?>
<form id="login" method="post" class="text-center m-auto">
      <?= $err ?>
      <h6>สมาชิกเข้าสู่ระบบ</h6>
      <input type="text" name="login" placeholder="ล็อกอิน" value="<?= $login ?>" class="form-control form-control-sm my-3" required>
      <input type="password" name="pswd" placeholder="รหัสผ่าน" value="<?= $pswd ?>" class="form-control form-control-sm mb-4" required>
      <div class="custom-control custom-switch">
            <input type="checkbox" name="save_account" id="check1" class="custom-control-input" >
            <label class="custom-control-label" for="check1">เก็บข้อมูลไว้ในเครื่องนี้</label>
      </div>
      <button class="btn btn-primary btn-sm px-4 my-3">เข้าสู่ระบบ</button><br>
      <a href="index.php">หน้าหลัก</a>
</form>
</body>
</html>