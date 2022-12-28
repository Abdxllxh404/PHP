<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-2</title>
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
      $(function(){
            $('button').click(function() {
                  var login = $('#login').val();
                  if (login.length == 0) { 
                        return; 
                   }
                  var d = {user: login};  
                  
                  $.ajax({
                        url: 'check-login.php',
                        type: 'post',
                        data: d,
                        success: (result) => alert(result)
                  });
            });
      });
      </script>
</head>
<body class="d-flex p-4">
<form class="m-auto">
      <div>บัญชีผู้ใช้</div>
      <input type="text" name="login" id="login" placeholder="ล็อกอิน" required class="form-control form-control-sm my-3">
      <input type="password" name="pswd" placeholder="รหัสผ่าน" required class="form-control form-control-sm mb-4">
      <button type="button" class="btn btn-primary btn-sm mt-3 d-block m-auto">ขั้นตอนถัดไป &raquo;</button>
</form>
</body>
</html>
