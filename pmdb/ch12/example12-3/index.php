<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 12-3</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
            html, body { height: 100%; }
            form, table {
                  max-width: 500px;
                  margin: auto;
            }
            caption {
                  caption-side: top;
                  text-align: center;
            }
      </style>
      <script>
            $(function() {
                   $(':file').change(function() { 
                         var filename = $(this).val().split('\\').slice(-1)[0];
                        $(this).next().after().text(filename);
                  }); 
            });
      </script>
</head>
<body class="p-3">
<form method="post" enctype="multipart/form-data">
      <div class="custom-file mb-3">
            <input type="file" name="upfile[]" class="custom-file-input" id="file1">
            <label class="custom-file-label" for="file1">กรุณาเลือกไฟล์</label>
      </div>
      <div class="custom-file mb-3">
            <input type="file" name="upfile[]" class="custom-file-input" id="file2">  
            <label class="custom-file-label" for="file2">กรุณาเลือกไฟล์</label>
      </div>
      <div class="custom-file mb-4">
            <input type="file" name="upfile[]" class="custom-file-input" id="file3">      
            <label class="custom-file-label" for="file3">กรุณาเลือกไฟล์</label>
      </div>
      <button class="btn btn-primary btn-sm d-block px-4 mx-auto">Upload</button>
</form>
    
<?php
if(isset($_FILES['upfile'])) {     
      $count = count($_FILES['upfile']['name']);      
      
      for ($i = 0; $i < $count; $i++) {
            if ($_FILES['upfile']['error'][$i] > 0) {
                  continue;
            }
            $n = $_FILES['upfile']['name'][$i];
            $t = $_FILES['upfile']['type'][$i];
            $s = $_FILES['upfile']['size'][$i];
            $x = $i + 1;
            echo <<<HTML
                  <table class="table table-sm table-striped table-bordered mt-2">
                  <caption>ข้อมูลของไฟล์ที่ $x</caption>
                  <thead class="thead-dark">
                        <tr><th>ข้อมูล</th><th>ค่า</th></tr>
                  </thead>
                  <tbody>
                        <tr><td>name</td><td>$n</td></tr>
                        <tr><td>type</td><td>$t</td></tr>
                        <tr><td>size</td><td>$s</td></tr>
                  </tbody>
                  </table>
            HTML;            
      }
}
?>
</body>
</html>
