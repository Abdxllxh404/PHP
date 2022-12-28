<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 12-4</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
            form, div.alert {
                  max-width: 500px;
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
<body class="p-4">
<?php    
if (isset($_FILES['upfile'])) {
      $fi = $_FILES['upfile'];      //แทนด้วยตัวแปร ให้โค้ดสั้นลง
      $e = $fi['error'];
      
      $msg = '';
      $contextual = '';
      if ($e != 0) { 
            $msg = 'เกิดข้อผิดพลาดในการอัปโหลด';
            $contextual = 'alert-danger';
            goto end_post;
      }
      
      @mkdir('upload');       //ถ้ายังไม่มีไดเร็กทอรี ให้สร้างขึ้นใหม่
      $target = 'upload/' . $fi['name'];
      
      if (!file_exists($target)) {
            move_uploaded_file($fi['tmp_name'], $target);
      } else {
            if ($_POST['duplicate'] == 'overwrite') {
                    move_uploaded_file($fi['tmp_name'], $target);
            } else {
                  $oldname = pathinfo($fi['name'], PATHINFO_FILENAME);                   
                  $ext =  pathinfo($fi['name'], PATHINFO_EXTENSION);
                  do {
                        $r = rand();
                        $newname = "$oldname-$r.$ext";   //mypic-123.png
                        $target = "upload/$newname";
                        if (!file_exists($target)) {
                              move_uploaded_file($fi['tmp_name'], $target);
                        }				
                  } while (file_exists($target));
            }
      }   
 
      $msg = 'จัดเก็บไฟล์เรียบร้อยแล้ว';
      $contextual = 'alert-info';
      
      end_post:
      echo <<<HTML
      <div class="alert $contextual alert-dismissible">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
      HTML;     
}
?>
<form method="post" enctype="multipart/form-data" class="mx-auto">
      <div class="custom-file mb-3">
            <input type="file" name="upfile" class="custom-file-input" id="file1">
            <label class="custom-file-label" for="file1">กรุณาเลือกไฟล์</label>
      </div>
      <p class="d-inline mr-4">กรณีชื่อไฟล์ซ้ำกัน</p>
      <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" checked id="radio1" name="duplicate" value="random">
            <label class="custom-control-label" for="radio1">สร้างชื่อใหม่แบบสุ่ม</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="radio2" name="duplicate" value="overwrite">
            <label class="custom-control-label" for="radio2">เขียนทับ</label>
      </div>
      <button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-4">Upload</button>
</form>
</body>
</html>
