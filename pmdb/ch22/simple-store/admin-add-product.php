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
      <link href="js/summernote/summernote-bs4.css" rel="stylesheet">
      <style>
            html, body {
                  width: 100%;
                  height: 100%;
                  background:  azure;
                  padding-top:  1rem;
            }
            
            * {
                font-size: 0.93rem;
            }
            
            form {
                  max-width: 500px;
                  margin: auto;
            }
            
            [name="price"], [name="remain"], [name="delivery_cost"] {
                  max-width: 150px;
            }
      </style> 
      <script src="js/summernote/summernote-bs4.min.js"></script>
      <script src="js/summernote/lang/summernote-th-TH.js"></script>
      <script>
      $(function() {
            $('[name="detail"]').summernote({lang: 'th-TH'});

            $(':file').change(function() { 
                   var filename = $(this).val().split('\\').slice(-1)[0];
                  $(this).next().after().text(filename);
            });              
      });
      </script>
</head>
<body class="p-3">
 <?php require 'navbar.php'; ?> 
    
<form method="post" enctype="multipart/form-data" class="mt-5">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $num_upload_files = count($_FILES['upfile']['tmp_name']);
      $num_errs = 0;
      for ($i = 0; $i < $num_upload_files; $i++) {               
            if ($_FILES['upfile']['error'][$i] > 0) {
                  $num_errs += 1;
                  continue;
            } 

            $type = explode('/', $_FILES['upfile']['type'][$i]);
            if ($type[0] != 'image') {
                  $num_errs += 1;
            }
      }      
      
      if ($num_errs == $num_upload_files) {    
            $msg = 'มีข้อผิดพลาดในการอัปโหลดภาพ';
            $contextual = 'alert-danger';
            goto end_post; 
      }     
      
      //เพิ่มชื่อสินค้าลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
      $sql = 'INSERT INTO product VALUES (?, ?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();        
      $stmt->prepare($sql);
      $params = [0, $_POST['name'], $_POST['detail'], $_POST['price'], 
                         $_POST['remain'], $_POST['delivery_cost'], ''];
      
      $stmt->bind_param('issdiis', ...$params);
      $stmt->execute();
      $product_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close(); 

      require 'lib/image-sizing.class.php';
      
      //ต้องสร้างโฟลเดอร์เข้าไปทีละชั้น
      $image_folder = 'product-images';
      @mkdir($image_folder);
      $image_folder .= "/$product_id";
      @mkdir($image_folder);

      $img_files = [];
      $n = 1;
      for ($i = 0; $i < $num_upload_files; $i++) {
            if ($_FILES['upfile']['error'][$i] > 0) {
                  continue;
            } 

            $type = explode('/', $_FILES['upfile']['type'][$i]);
            if ($type[0] != 'image') {
                  continue;
            }
            //เปลี่ยนขนาดของภาพ
            $image = ImageSizing::from_upload('upfile', $i);
            $image->resize_max(600, 600);  //wxh สูงสุดไม่เกิน 600

            $old_name = $_FILES['upfile']['name'][$i];
            //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
            $ext = pathinfo($old_name, PATHINFO_EXTENSION);	
            //เอา id ของสินค้า, เลขลำดับภาพ และส่วนขยายมาเชื่อมต่อกัน
            $new_name ="$product_id-$n.$ext";   //เช่น 1-1.png, 1-2.png
            $image->save("$image_folder/$new_name");           
            $img_files[] = $new_name;
            $n++;
      }

      $img_file = implode(',', $img_files);
      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE product SET img_files = '$img_file' 
                  WHERE id = $product_id";

      $mysqli->query($sql);     
      $msg = 'ข้อมูลถูกบันทึกแล้ว';
      $contextual = 'alert-success';
      
      end_post:             
      echo  <<<HTML
      <div class="alert $contextual mb-4" role="alert">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>    
      HTML;
      
      $mysqli->close();     
}
?>
<h6 class="text-info text-center">เพิ่มรายการสินค้า</h6>
<div class="form-group mt-3">
      <label>ชื่อสินค้า</label>
      <input type="text" name="name" class="form-control form-control-sm" required>
</div>
<div class="form-group mt-2">
      <label>รายละเอียด</label>
      <textarea name="detail" class="form-control form-control-sm" rows="3" required></textarea>
</div>
<div class="d-flex justify-content-between flex-wrap">
      <div class="form-group mt-2">
            <label>ราคา</label>
            <input type="text" name="price" class="form-control form-control-sm w-auto" required>
      </div>
      <div class="form-group mt-2">
            <label>คงเหลือ</label>
            <input type="text" name="remain" class="form-control form-control-sm w-auto" required>
      </div>
      <div class="form-group mt-2">
            <label>ค่าจัดส่ง</label>
            <input type="text" name="delivery_cost" class="form-control form-control-sm w-auto" required>
      </div>
</div>
<div class="mt-2 mb-2">ภาพสินค้า (1 - 4 ภาพ)</div>
<?php
for ($i = 1; $i <= 4; $i++) {       //สร้างอินพุท file จำนวน 4 อัน
      echo <<<HTML
      <div class="custom-file mb-2">
      <input type="file" name="upfile[]" class="custom-file-input" accept="image/*">
      <label class="custom-file-label">เลือกไฟล์</label>
      </div>               
      HTML;
}
?>
</div>
<button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>
<br><br><br><br>
</form>

<?php require 'footer.php'; ?>     
</body>
</html>