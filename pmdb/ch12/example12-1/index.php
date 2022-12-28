<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 12-1</title>
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
<body class="pt-4 px-3">
<form method="post" enctype="multipart/form-data">
      <div class="custom-file">
            <input type="file" name="upfile" class="custom-file-input" id="file1">
            <label class="custom-file-label" for="file1">กรุณาเลือกไฟล์</label>
      </div>
      <button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-4">Upload</button>
</form>
    
<?php
if (isset($_FILES['upfile'])) {      //ถ้ามีอินพุท file ส่งเข้ามา   
      echo <<<HTML
            <table class="table table-sm table-striped table-bordered mt-4">
            <caption>ข้อมูลของไฟล์ที่อัปโหลด</caption>
            <thead class="thead-dark">
                  <tr><th>ข้อมูล</th><th>ค่า</th></tr>
            </thead>
            <tbody>
                  <tr><td>name</td><td>{$_FILES['upfile']['name']}</td></tr>
                  <tr><td>type</td><td>{$_FILES['upfile']['type']}</td></tr>
                  <tr><td>size</td><td>{$_FILES['upfile']['size']}</td></tr>
                  <tr><td>tmp_name</td><td>{$_FILES['upfile']['tmp_name']}</td></tr>
                  <tr><td>error</td><td>{$_FILES['upfile']['error']}</td></tr>
            </tbody>
            </table>
      HTML;
}
?>
</body>
</html>
