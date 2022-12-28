<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-1</title>
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
                  $.ajax({
                        url: 'random-num.php', 
                        success: (result) => {
                              alert('เลขสุ่มที่ได้คือ: ' + result);
                        }
                  });
            });
      });
      </script>
</head>
<body class="d-flex p-4">
      <button class="btn btn-primary d-block m-auto">แสดงค่าเลขสุ่มจากเซิร์ฟเวอร์</button>
</body>
</html>

