<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 12-2</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>           
            form, table, div.alert {
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
            <input type="hidden" name="MAX_FILE_SIZE" value="100000"> 
            <input type="file" name="upfile" class="custom-file-input" id="file1" accept="image/*">      
            <label class="custom-file-label" for="file1">กรุณาเลือกไฟล์</label>
      </div>
      <button class="btn btn-primary btn-sm mt-4 d-block mx-auto px-4">Upload</button>
</form>
    
<?php
if (isset($_FILES['upfile'])) {     //ถ้ามีอินพุท file ส่งเข้ามา
      $upfile = $_FILES['upfile'];
      $e = $upfile['error'];
      //ถ้าเป็นเลขที่ไม่ใช่ 0 แสดงว่าเกิดข้อผิดพลาด
      if ($e > 0) {  
            $msg = '';
            if ($e == 1) {
                  $max = ini_get('upload_max_filesize');
                  $msg = "ไฟล์มีขนาดเกินกว่าขนาด upload_max_filesize ($max)";                             
            } else if ($e == 2) {
                  $max = round($_POST['MAX_FILE_SIZE'] / 1000);   //โดยประมาณ
                  $msg = "ไฟล์มีขนาดเกินกว่าค่า  MAX_FILE_SIZE ($max KB)";
            } else if ($e == 3) { 
                  $msg = 'ไฟล์ถูกอัปโหลดมาไม่ครบ';  
            } else if ($e == 4) { 
                  $msg = 'ไม่มีไฟล์อัปโหลดมา'; 
            } else { 	
                  $msg = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';  
            }
            echo <<<HTML
            <div class="alert alert-danger alert-dissmissible my-5" role="alert">
                  $msg
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            HTML;
      } else {
            //ถ้าไม่มีข้อผิดพลาดก็แสดงข้อมูลของไฟล์ดังตัวอย่างที่แล้ว ...	
            //และเพิ่มการแสดงขนาดของไฟล์เป็นแถวสุดท้ายของตารางดังนี้
            $type = $upfile['type'];
            $t = explode('/', $type);
            if ($t[0] == 'image') {   //ถ้าเป็นประเภทรูปภาพ
                  $size = getimagesize($upfile['tmp_name']);
                  $width = $size[0];
                  $height = $size[1];
                        
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
                        <tr><td>dimension (w x h)</td><td>$width x $height</td></tr>
                  </tbody>
                  </table>
                  HTML;
            }
       }
}
?>
</body>
</html>

