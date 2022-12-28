<?php
      @session_start();
      if (!isset($_SESSION['admin'])) {
            header('location: admin-signin.php');
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
                  max-width: 500px;
                  margin: auto;
            }
            
            [name="price"], [name="remain"] {
                  width: 150px;
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
<body class="pt-5 px-3">
 <?php require 'navbar.php'; ?>
<form method="post" enctype="multipart/form-data" class="mt-5">  
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $type = explode('/', $_FILES['upfile']['type']);
      $msg = '';
      $class = '';
       if ($_FILES['upfile']['error'] > 0 ||  $type[0] != 'image') {
            $msg = 'เกิดข้อผิดพลาดในการอัปโหลด';
            $class = 'alert-danger';
            goto end_post;
      }

      //เพิ่มชื่อสินค้าลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_wish_list');
      $sql = 'INSERT INTO product VALUES (?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();        
      $stmt->prepare($sql);
      $p = [0, $_POST['name'], $_POST['detail'], $_POST['price'], $_POST['remain'], ''];
      $stmt->bind_param('issdis', ...$p);
      $stmt->execute();
      $product_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close(); 

      require 'lib/image-sizing.class.php';

      $image_folder = 'product-images';
      @mkdir($image_folder);

      $image = ImageSizing::from_upload('upfile');
      $image->resize_max(600, 600);

      $old_name = $_FILES['upfile']['name'];
      //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
      $ext = pathinfo($old_name, PATHINFO_EXTENSION);	

      $new_name ="{$product_id}.$ext";   //เช่น 1.png, 2.png
      $image->save("{$image_folder}/$new_name");

      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE product  SET img_file = '$new_name' 
                  WHERE id = $product_id";

      $mysqli->query($sql);

      $msg = 'ข้อมูลถูกบันทึกแล้ว';
      $class = 'alert-info';
      $mysqli->close(); 

      end_post:
      echo <<<HTML
      <div class="alert $class mb-4 mt-5" role="alert">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>             
      HTML;     
}
?>
<h6 class="text-info text-center mb-3">เพิ่มรายการสินค้า</h6>
<div class="form-group mt-3">
      <label for="text1">ชื่อสินค้า</label>
      <input type="text" id="text1" name="name" class="form-control form-control-sm" required>
</div>
<div class="form-group mt-3">
      <label for="texta1">รายละเอียด</label>
      <textarea name="detail" id="texta1" class="form-control form-control-sm"  rows="2" required></textarea>
</div>
<div class="d-flex justify-content-between">
      <div class="form-group mt-3">
            <label for="tex2">ราคา</label>
            <input type="text" id="text2" name="price" class="form-control form-control-sm" required>
      </div>
      <div class="form-group mt-3">
            <label for="text3">จำนวนคงเหลือ</label>
            <input type="text" id="text3" name="remain" class="form-control form-control-sm" required>
      </div>
</div>
<div class="mb-2">ภาพสินค้า</div>
<div class="custom-file mb-3">
      <input type="file" name="upfile" class="custom-file-input" id="file1" accept="image/*" required>
      <label class="custom-file-label" for="file1">เลือกไฟล์</label>
</div>
<button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>
<br><br><br><br><br>
</form>

<?php require 'footer.php'; ?>    
</body>
</html>