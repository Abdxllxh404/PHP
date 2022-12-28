<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 5-2</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
          body {
                background: azure;
          }
      </style>
</head>
<body class="p-5 text-center">
<form method="get">
      <div class="input-group input-group-sm">
            <input type="text" name="kw" class="form-control">
            <div class="input-group-append">
                  <button class="btn btn-success">ค้นหา</button> 
            </div>
      </div>
</form>  
<?php  
if (isset($_GET['kw'])) {
      $kw = $_GET['kw']; 
      echo <<<HTML
      <h6 class="mt-4">ผลการค้นหา: $kw</h6>
      <div class="text-danger">ไม่พบข้อมูล</div>      
      HTML;
}
?>
</body>
</html>
