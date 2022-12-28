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
            [name="text_country"] {
                  max-width: 320px;
            }
            [name="team"] {
                  max-width: 350px;
            }
            .custom-file {
                  max-width: 350px;
            }
            
           label, span, [type="text"] {
                  font-size: 0.88rem;
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
<body class="d-flex pt-5">
 <?php require 'navbar.php'; ?>
    
<form id="main" method="post" enctype="multipart/form-data" class="mx-auto">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $msg = '';
      $bs_class = 'alert-danger';
      if ($_FILES['upfile']['error'] > 0) {
              $msg = 'มีข้อผิดพลาดในการอัปโหลดภาพ';
              goto end_post;
      } 

      $type = explode('/', $_FILES['upfile']['type']);
      if ($type[0] != 'image') {
            $msg = 'ไฟล์ที่อัปโหลดไม่ใช่ชนิดรูปภาพที่รองรับ';
            goto end_post;
      } 

      $team = $_POST['team'];
      $country = $_POST['country'];
       //ถ้าเช็คตรงช่องระบุชื่อประเทศเอง ให้อ่านค่านั้นมาใช้งาน
      if (isset($_POST['check_country'])) {
            $country = $_POST['text_country'];
      }
       //รูปภาพ ให้เป็นค่าว่างไว้ก่อน เพราะต้องนำค่า id ของทีมไปตั้งชื่อภาพ
       //หลังจากการตั้งชื่อและจัดเก็บในไดเร็กทอรั ค่อยอัปเดตอีกครั้ง
      $img = '';       
      $sql = 'INSERT INTO team VALUES (?,?,?,?)';
      $stmt = $mysqli->stmt_init();  
      $stmt->prepare($sql);
      $params = [0, $team, $country, $img];
      $stmt->bind_param('isss', ...$params);
      $stmt->execute();
      $team_id = $stmt->insert_id;     //ค่า id ของทีม (แถวล่าสุด)
      $stmt->close(); 
      
      require 'lib/image-sizing.class.php';     //ใช้ย่อภาพโลโก้
      
      $image_folder = 'logo';
      @mkdir("$image_folder");       
      $image = ImageSizing::from_upload('upfile');
      $image->resize_max(96, 96);

      $old_name = $_FILES['upfile']['name'];
      //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
      $ext = pathinfo($old_name, PATHINFO_EXTENSION);		
      $new_name ="$team_id.$ext";   //เช่น 1.png, 2.png
      $image->save("$image_folder/$new_name");           

      //แก้ไขชื่อไฟล์ในตาราง  
      $sql = "UPDATE team  SET logo_file = '$new_name' 
                  WHERE id = $team_id";
              
      $mysqli->query($sql);
      $msg = 'ข้อมูลถูกบันทึกแล้ว';
      $bs_class = 'alert-info';
      
      end_post:
      echo <<<HTML
      <div class="alert $bs_class alert-dismissible mt-5">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div> 
      HTML;
}

//อ่านชื่อประเทศของทีมที่เคยบันทึกไว้แล้ว แบบไม่ซ้ำกัน เพื่อเติมในอินพุท select
$sql = 'SELECT DISTINCT(country) FROM team';
$result = $mysqli->query($sql);
$mysqli->close();
?>
      <h6 class="text-info text-center mt-5 mb-4">เพิ่มทีมใหม่</h6>
      
      <div class="form-group mt-4">
            <label for="team">ชื่อทีม</label>
            <input type="text" id="team" name="team" class="form-control form-control-sm" required>
      </div>
      
      <div class="form-group">
            <label for="contry">ประเทศ</label><br>
            <select id="country" name="country" class="custom-select custom-select-sm">
            <?php
                  while (list($t) = $result->fetch_row()) {
                        echo "<option value=\"$t\">$t</option>";
                  }
            ?>
            </select>
            <div class="input-group input-group-sm mt-2">
                  <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="check_country"></span>
                  </div>
                  <input type="text" name="text_country" class="form-control form-control-sm" placeholder="หรือระบุ...">
            </div>
      </div>

      <span class="d-block mb-2 mt-4">ภาพโลโก้ของทีม</span>
      <div class="custom-file custom-file-sm mb-3">
            <input type="file" name="upfile" class="custom-file-input" accept="image/*">
            <label class="custom-file-label">เลือกไฟล์</label>
      </div>

      <button class="btn btn-primary btn-sm d-block mt-4 mx-auto px-5">ตกลง</button>    

      <br><br><br><br><br>                  
</form>
    
<?php require 'footer.php'; ?>    
</body>
</html>