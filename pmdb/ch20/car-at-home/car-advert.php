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
      <?php require 'head.php'; ?>
      <style>
            body {
                  background: azure;
            }
            
            form#main {
                  max-width: 600px;
                  margin: auto; 
            } 
            form#main input[type="text"] {
                  max-width: 250px;
            }
            
            label, input, textarea {
                  font-size: 0.9rem !important;
            }
      </style>
      <script>
            $(function() {                  
                  $(':file').change(function() { 
                         var filename = $(this).val().split('\\').slice(-1)[0];
                        $(this).next().after().text(filename);
                  });
                  //เมื่อเปลี่ยนการเลือกยี่ห้อรถ ให้ส่งค่าผ่าน AJAX ไปยังอ่านชื่อรุ่นของรถยี่ห้อนั้น
                  $('[name="select_brand"]').change(function() {
                        var b = $(this).val();
                        $.ajax({
                              url: 'ajax-car-model.php',
                              data: {'brand': b},
                              type: 'post',
                              dataType: 'text',
                              success: (result) => {       
                                    $('[name="select_model"]').empty();
                                    $('[name="select_model"]').append(result);
                              }
                        });
                  });
                  
                  $('[name="select_brand"]').change();  //ทำให้เกิดอีเวนต์ change เมื่อเปิดเพจ                
            });
      </script>
</head>
<body class="pt-5">
 <?php require 'navbar.php'; ?>

<div class="text-center my-5">   
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $num_upload_files = count($_FILES['upfile']['tmp_name']);
      $num_errs = 0;
      for ($i = 0; $i < $num_upload_files; $i++) {               
            if ($_FILES['upfile']['error'][$i] > 0) {
                  $num_errs += 1;
                  continue;
            } 
            $type = explode('/', $_FILES['upfile']['type'][$i]);
            if ($type[0] != 'image') $num_errs += 1;
      }      
      
      if ($num_errs == $num_upload_files) {
            echo '<h6 class="text-danger mb-4">มีข้อผิดพลาดในการอัปโหลดภาพ</h6>';
            goto end_post;
      }
      
      $seller_id = $_SESSION['member_id'];     
      $brand = $_POST['select_brand'];
      if (isset($_POST['check_brand'])) {
            $brand = $_POST['text_brand'];
      }

      $model = $_POST['select_model'];
      if (isset($_POST['check_model'])) {
            $model = $_POST['text_model'];
      }
      
      $year = $_POST['select_year'];
      if (isset($_POST['check_year'])) {
            $year = $_POST['text_year'];
      }
            
      $engine = $_POST['select_engine'];
      if (isset($_POST['check_engine'])) {
            $engine = $_POST['text_engine'];
      }
      
      $color = $_POST['select_color'];
      if (isset($_POST['check_color'])) {
            $color = $_POST['text_color'];
      }
      $trans = $_POST['select_trans'];
      if (isset($_POST['check_trans'])) $trans = $_POST['text_trans'];
      
      $ops = $_POST['more_options'];
      $advert = $_POST['car_advert'];
      $reg = $_POST['car_registration'];
      $price = $_POST['price'];
      $dt = date('Y-m-d');
      $img = '';
      $params = [0, $seller_id, $brand, $model, $year, $engine, $color, 
                         $trans, $ops, $reg, $price, $advert, $dt, $img];
      
      $sql = 'INSERT INTO car_advert VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
      $stmt = $mysqli->stmt_init();  
      $stmt->prepare($sql);
      $stmt->bind_param('iissiissssdsss', ...$params);
      $stmt->execute();
      $car_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close(); 
      
      require 'lib/image-sizing.class.php';
      //ต้องสร้างไดเร็กทอรีทีละชั้น
      $image_folder = "car-images";
      @mkdir("$image_folder");
      $image_folder .= "/$car_id";
      @mkdir("$image_folder");
      
      $files = [];
      $n = 1;
      for ($i = 0; $i < $num_upload_files; $i++) {
            if ($_FILES['upfile']['error'][$i] > 0) continue;
            
            $type = explode('/', $_FILES['upfile']['type'][$i]);
            if ($type[0] != 'image') continue;
            
            $image = ImageSizing::from_upload('upfile', $i);
            $image->resize_max(800, 600);
            $old_name = $_FILES['upfile']['name'][$i];
           //คัดแยกเอาส่วนขยายของไฟล์
            $ext = pathinfo($old_name, PATHINFO_EXTENSION);		
            $new_name ="$car_id-$n.$ext";   //เช่น 1-1.png, 1-2.png
            $image->save("$image_folder/$new_name");           
            $files[] = $new_name;
            $n++;
      }
  
      $img_files = implode(',', $files);
      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE car_advert SET img_files = '$img_files' 
                  WHERE id = $car_id";
              
      $mysqli->query($sql);    
      echo <<<HTML
      <h6 class="text-success">ข้อมูลถูกบันทึกแล้ว</h6><br>
      <a href="car-detail.php?id=$car_id">ดูประกาศ</a><br>
      <a href="index.php">หน้าแรก</a>
      HTML;
      
      $mysqli->close();
      include 'footer.php'; 
      exit('</div></body></html>');     
      
      end_post:
}

$sql = 'SELECT * FROM car_brand';
$result = $mysqli->query($sql);
$mysqli->close();
?>
</div>   
<form id="main" method="post" enctype="multipart/form-data" class="mt-3 mt-md-0">
<div class="container">
      <div class="row mb-3">
            <div class="col-12"><h6 class="text-info text-center">ประกาศขายรถ</h6></div>
      </div>
    
      <div class="row">
            <div class="col-12 col-md-6">
                  <label>ยี่ห้อ</label>
                  <select name="select_brand" class="custom-select custom-select-sm d-block w-auto">
                  <?php
                  while (list($i, $b, $m) = $result->fetch_row()) {
                        echo "<option value=\"$b\">$b</option>";
                  }
                  ?>
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_brand"></span>
                        </div>
                        <input type="text" name="text_brand" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div>                      
            </div>         
          
            <div class="col-12 col-md-6">
                  <label>รุ่น</label>
                  <select name="select_model" class="custom-select custom-select-sm d-block w-auto">
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_model"></span>
                        </div>
                        <input type="text" name="text_model" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div>
            </div>          
      </div>            
    
      <div class="row">
            <div class="col-12 col-md-6">
                  <label>ปี</label>
                  <select name="select_year" class="custom-select custom-select-sm d-block w-auto">
                  <?php
                  $cur_year = date('Y');
                  $start = $cur_year - 15;                              
                  for ($i = $cur_year; $i >= $start ; $i--) {
                        echo "<option value=\"$i\">$i</option>";
                  }
                  ?>
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_year"></span>
                        </div>
                        <input type="number" name="text_year" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div>
            </div>
          
            <div class="col-12 col-md-6">
                  <label>เครื่องยนต์</label>
                  <select name="select_engine" class="custom-select custom-select-sm d-block w-auto">
                  <?php                              
                  for ($i = 1200; $i <= 3000; $i += 100) {
                        echo "<option value=\"$i\">$i</option>";
                  }
                  ?>
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_engine"></span>
                        </div>
                      <input type="number" name="text_engine" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div>
            </div>
      </div>          
 
       <div class="row">
            <div class="col-12 col-md-6">
                  <label>สี</label>
                  <select name="select_color" class="custom-select custom-select-sm d-block w-auto">
                  <?php
                  $colors = ['ขาว', 'เขียว', 'เงิน', 'ดำ', 'แดง', 'ทอง', 'เทา', 'น้ำเงิน', 'น้ำตาล', 'ฟ้า', 'ส้ม', 'เหลือง'];
                  $count = count($colors);
                  for ($i = 0; $i < $count; $i++) {
                        $c = $colors[$i];
                        echo "<option value=\"$c\">$c</option>";
                  }
                  ?>
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_color"></span>
                        </div>
                        <input type="text" name="text_color" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div>
            </div>
            <div class="col-12 col-md-6">
                  <label>เกียร์</label>
                  <select name="select_trans" class="custom-select custom-select-sm d-block w-auto">
                      <option value="อัตโนมัติ">อัตโนมัติ</option>
                      <option value="ธรรมดา">ธรรมดา</option>
                  </select>
                  <div class="input-group input-group-sm mt-2 mb-3">
                        <div class="input-group-prepend">
                              <span class="input-group-text"><input type="checkbox" name="check_trans"></span>
                        </div>                        
                        <input type="text" name="text_trans" class="form-control form-control-sm w-auto" placeholder="หรือระบุ...">
                  </div> 
            </div>
      </div>     

       <div class="row">
            <div class="col-12">
                  <label>ออปชันเพิ่มเติมอื่นๆ</label>
                  <textarea name="more_options" class="form-control" rows="2" placeholder="เช่น ถุงลมคู่หน้า, เบรค ABS, ไฟตัดหมอก..."></textarea>
            </div>
      </div>     
 
      <div class="row mt-3">
            <div class="col-12">             
                  <label>คำโฆษณาเกี่ยวกับรถ</label>
                  <textarea name="car_advert" class="form-control" rows="2" placeholder="เช่น สภาพนางฟ้า ดูแลรักษาอย่างดี..."></textarea>
            </div>
      </div>      
     
      <div class="row mt-3">
            <div class="col col-md-6">
                 <label>ทะเบียนรถ (ไม่ระบุก็ได้)</label>
                 <input id="car-registration" name="car_registration" class="form-control form-control-sm w-auto">
            </div>
            <div class="col-12 col-md-6">
                  <label>ราคาที่ต้องการขาย</label>
                  <input type="number" id="price" name="price" class="form-control form-control-sm w-auto" required>
            </div>
      </div>
      
      <div class="row mt-3">
            <div class="col-12">
                  <label class="mb-2">ภาพรถ (1 - 6 ภาพ และจะใช้ภาพแรกเป็นหลัก)</label>
                  <?php
                  for ($i = 1; $i <= 6; $i++) {
                        echo <<<HTML
                        <div class="custom-file custom-file-sm mb-2">
                              <input type="file" name="upfile[]" class="custom-file-input" id="file$i" accept="image/*">
                              <label class="custom-file-label" for="file$i">เลือกไฟล์</label>
                        </div>
                        HTML;
                  }
                  ?>
            </div>
      </div> 
          
       <div class="row">
            <div class="col-12">
                  <button class="btn btn-primary btn-sm d-block mx-auto mt-4 px-5">ตกลง</button>    
            </div>
      </div>          
          
</div>   <!-- container -->          
</form>
    
<?php require 'footer.php'; ?>    
</body>
</html>