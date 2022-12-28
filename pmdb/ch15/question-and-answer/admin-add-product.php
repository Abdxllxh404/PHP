<?php
@session_start();
if (!isset($_SESSION['admin'])) {
      header('location: admin.php');
      exit;
}
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            html, body {
                  width: 100%;
                  height: 100%;
                  background: azure;             
            }
            form {
                  max-width: 600px;
                  min-width: 400px;
                  margin: auto;
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
<body class="d-flex pt-5 px-3">
 <?php require 'navbar.php'; ?>
 
<form method="post" enctype="multipart/form-data" class="mt-5">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $type = explode('/', $_FILES['upfile']['type']);
      if ($_FILES['upfile']['error'] > 0 ||  $type[0] != 'image') {
            $msg = 'เกิดข้อผิดพลาดในการอัปโหลด';
            $bs_class = 'alert-danger';
            goto end;
      }

      //เพิ่มชื่อสินค้าลงในตาราง ยกเว้นชื่อภาพให้ใส่สตริงว่างไปก่อน
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_question_answer');
      $sql = 'INSERT INTO product VALUES (?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();        
      $stmt->prepare($sql);
      $params = [0, $_POST['name'], $_POST['detail'], ' '];
      $stmt->bind_param('isss', ...$params);
      $stmt->execute();
      $product_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close();

      require 'lib/image-sizing.class.php';
      $image_folder = 'product-images';
      @mkdir($image_folder);

      $image = ImageSizing::from_upload('upfile');
      $image->resize_max(200, 200);

      $old_name = $_FILES['upfile']['name'];
      //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
      $ext = pathinfo($old_name, PATHINFO_EXTENSION);
      $new_name ="$product_id.$ext";   //เช่น 1.png, 2.png
      $image->save("{$image_folder}/$new_name");

      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE product  
                  SET img_file = '$new_name' 
                  WHERE id = $product_id";

      $mysqli->query($sql);
      $mysqli->close(); 

      $msg = 'ข้อมูลถูกบันทึกแล้ว';
      $bs_class = 'alert-info';

      end:
      echo <<<HTML
     <div class="alert $bs_class mb-4" role="alert">
            $msg
            <button class="close" data-dismiss="alert" 
                  aria-hidden="true">&times;</button>
     </div>
     HTML; 
}
?>
<h6 class="text-info text-center mb-4">เพิ่มรายการสินค้า</h6>
<div class="form-group mt-3">
      <label>ชื่อสินค้า</label>
      <input type="text" id="text1" name="name" class="form-control form-control-sm" required>
</div>
<div class="form-group mt-3">
      <label>รายละเอียด</label>
      <textarea name="detail" class="form-control  form-control-sm" rows="3" required></textarea>
</div>
<div class="mb-2">ภาพประกอบ</div>
<div class="custom-file mb-3">
      <input type="file" name="upfile" class="custom-file-input" id="file1" accept="image/*" required>
      <label class="custom-file-label" for="file1">เลือกไฟล์</label>
</div>
<button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>
</form>
    
<?php require 'footer.php'; ?>    
</body>
</html>