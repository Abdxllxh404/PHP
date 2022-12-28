<?php
      @session_start();
      if (!isset($_SESSION['member_id'])) {
            header('location: member-signin.php');
            exit;
      }
?>
<!DOCTYPE html>
<html>
<head>
      <?php include 'head.php'; ?>
      <style>
            html, body {
                  widh: 100%;
                  height: 100%;
                  background: azure;
                  padding-top: 4rem;
            }
            * {
                  font-size: 0.95rem;
            }
            form {
                  max-width: 400px;
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
<body class="px-3">
 <?php include 'navbar.php'; ?>

<div class="text-center mx-auto px-3 mt-3 mt-sm-0">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $num_upload_files = count($_FILES['upfile']['tmp_name']);
      $num_errs = 0;
      //ตรวจสอบจำนวนข้อผิดพลาดของไฟ์ที่อัปโหลดขึ้นมา
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
      //ถ้าทุกไฟล์ผิดพลาดหมด ไม่ต้องบันทึกข้อมูล
      if ($num_errs == $num_upload_files) {
            goto end_post;
      }   
      //เพิ่มชื่อสินค้าลงในตาราง
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');
      $sql = 'INSERT INTO item VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->stmt_init();        
      $stmt->prepare($sql);
      $mid = $_SESSION['member_id'];
      $now = strtotime('now');
      $end = strtotime($_POST['end_date']);
      if ($end < $now) {
            $end = $now;
      }
      $start_date = date("Y-m-d", $now);
      $end_date = date("Y-m-d", $end);
      $img = '';
      $params = [0, $mid, $_POST['name'], $_POST['detail'], $_POST['price'], $start_date, $end_date, $img];
      $stmt->bind_param('iississs', ...$params);
      $stmt->execute();
      $item_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close(); 
      
      include 'lib/image-sizing.class.php';
      //การสร้างโฟลเดอร์ ต้องทำทีละชั้น
      $img_folder = 'item-images';
      @mkdir("$img_folder");     
      $item_folder = "$img_folder/$item_id"; //เช่น item-images/1, item-images/2
      @mkdir($item_folder);
      
      $files = [];
      $n = 1;
      for ($i = 0; $i < $num_upload_files; $i++) {
            if ($_FILES['upfile']['error'][$i] > 0) {
                  continue;
            } 
            
            $type = explode('/', $_FILES['upfile']['type'][$i]);
            if ($type[0] != 'image') {
                  continue;   //ถ้าภาพลำดับใดมีข้อผิดพลาด ให้ข้ามไป
            }            
            //เปลี่ยนขนาดของภาพ
            $image = ImageSizing::from_upload('upfile', $i);
            $image->resize_max(300, 300);
            $old_name = $_FILES['upfile']['name'][$i];
            //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
            $ext = pathinfo($old_name, PATHINFO_EXTENSION);
            $new_name ="$item_id-$n.$ext";   //เช่น 1-1.png, 1-2.png
            $image->save("$item_folder/$new_name");           
            $files[] = $new_name;
            $n++;
      }      
      $img_files = implode(',', $files);  //รวมชื่อไฟล์เป็นสตริงเดียวกัน
      
      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE item SET img_files = '$img_files' 
                  WHERE id = $item_id";
              
      $mysqli->query($sql);
      $mysqli->close();   
      echo <<<HTML
      <h6 class="text-success">ข้อมูลถูกบันทึกแล้ว</h6><br>
      <a href="item-detail.php?id=$item_id">ดูรายละเอียด</a><br><br>
      <a href="index.php">กลับหน้าแรก</a>   
      HTML;
      
       include 'footer.php';
      echo'</div></form></body></html>';
      exit;
      
      end_post:
      echo '<div class="text-danger mb-3">มีข้อผิดพลาดในการอัปโหลดภาพ</div>';
}
?>
</div>
    
<form method="post" enctype="multipart/form-data">
      <h6 class="text-info text-center">เพิ่มรายการที่จะประมูล</h6>
      <div class="form-group mt-3">
            <label>ชื่อ</label>
            <input type="text" name="name" class="form-control form-control-sm" required>
      </div>
      <div class="form-group mt-2">
            <label>รายละเอียด</label>
            <textarea name="detail" class="form-control form-control-sm" rows="3" required></textarea>
      </div>
      <div class="d-flex justify-content-between">
            <div class="form-group mt-2">
                  <label>ราคาเริ่มต้น</label>
                  <input type="text" name="price" class="form-control form-control-sm w-auto" required>
            </div>
            <div class="form-group mt-2">
                  <label>วันสิ้นสุดการประมูล</label>
                  <input type="date" name="end_date" class="form-control form-control-sm" required>
            </div>
      </div>
      <div class="mb-2 mt-3">ภาพสิ่งของที่จะประมูล (1 - 3 ภาพ)</div>
      <div class="custom-file mb-2">
            <input type="file" name="upfile[]" class="custom-file-input" accept="image/*">
            <label class="custom-file-label">เลือกไฟล์</label>
      </div>
      <div class="custom-file mb-2">
            <input type="file" name="upfile[]" class="custom-file-input" accept="image/*">
            <label class="custom-file-label">เลือกไฟล์</label>
      </div>
      <div class="custom-file mb-2">
            <input type="file" name="upfile[]" class="custom-file-input" accept="image/*">
            <label class="custom-file-label">เลือกไฟล์</label>
      </div>
      <button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>
</form>
    
<br><br><br>
<?php include 'footer.php'; ?>    
</body>
</html>