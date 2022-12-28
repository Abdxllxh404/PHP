<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 5-1</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
</head>
<body class="p-5 text-center">
      <?php  
      $kw = $_GET['kw']; 
      ?>
      <h6>ผลการค้นหา: <?=  $kw ?></h6>
      <div class="text-danger">ไม่พบข้อมูล</div>
</body>
</html>
