<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-3</title>
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
      <script>
      $(function() {
            $('button').click(function() {
                  var data = $('form').serializeArray();
                  $.ajax({
                        url: 'login.php', 
                        type: 'post', 
                        data: data,
                        success: ajaxCallback
                  });
            });
      });

      function ajaxCallback(result) {
            //ถ้าส่งคำว่า "success" กลับมาให้แสดงข้อความว่าเข้าสู่ระบบ
            //และลิงก์สำหรับออกจากระบบ จากนั้นให้ซ่อนฟอร์ม
            if (result == 'success') {
                  $('#container').removeClass('text-danger');
                  $('#container').html(
                        '<b>ท่านเข้าสู่ระบบแล้ว</b><br>' + 
                        '<a href="javascript: location.reload()">ออกจากระบบ</a>'
                  );              
                  $('form').css('display', 'none');
            } else if (result == 'error') {	//ถ้าส่งคำว่า "error" กลับมาให้แสดงข้อผิดพลาด
                  $('#container').html('ท่านใส่ล็อกอินหรือรหัสผ่านไม่ถูกต้อง');
                  $('#container').addClass('text-danger');
            }
      }
      </script>
</head>
<body class="d-flex flex-column align-content-center p-4">
      <div id="container" class="text-center"></div>
      <form class="m-auto">
            <input type="text" name="login" id="login" placeholder="Login" required class="form-control form-control-sm my-3">
            <input type="password" name="pswd" placeholder="Password" required class="form-control form-control-sm mb-4">
            <button type="button" class="btn btn-primary btn-sm mt-3 d-block m-auto">เข้าสู่ระบบ</button>
      </form>
</body>
</html>

