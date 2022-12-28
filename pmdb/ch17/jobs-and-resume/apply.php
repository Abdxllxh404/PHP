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
            }
            
           label, input {
                  font-size: 0.9rem !important;
            }
      </style>
      <script>
      $(function() {
            $(':file').change(function() {
                  var filename = $(this).val().split('\\').slice(-1)[0];
                  $(this).next().after().text(filename);
            });
            
            $('#submit').click(function() {
                  if ($(':checkbox:checked').length == 0) {
                        alert('ต้องเลือกสมัครงานอย่างน้อย 1 ตำแหน่ง');
                  } else {
                        $('form').submit();
                  }     
            });
  
      });
      </script>
</head>
<body> 
<?php require 'navbar.php'; ?>
    
<?php
function show_alert($msg, $contextual) {
      echo <<<HTML
      <div class="text-center mt-4 mb-5">
      <span class="alert $contextual alert-dismissible">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </span>
      </div>
      HTML;
}
?>      
    
<form method="post" enctype="multipart/form-data" class="mx-auto p-3">  
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_jobs_resume');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {            
      $file = $_FILES['resume'];      //แทนด้วยตัวแปร ให้โค้ดสั้นลง
      if ($file['error'] != 0) { 
            show_alert('เกิดข้อผิดพลาดในการอัปโหลด', 'alert-danger');
      } else if ($file['type'] != 'application/pdf') {
            show_alert('ไฟล์ Resume ต้องเป็นชนิด PDF เท่านั้น', 'alert-danger');
      } else {
            $sql = 'INSERT INTO applicant VALUES(?, ?, ?, ?)';       
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql);
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $positions = implode(':::', $_POST['positions']);
            $params = [0, $name, $positions, ''];
            $stmt->bind_param('isss', ...$params);
            $stmt->execute();             
            $id = $stmt->insert_id;
             $stmt->close();

             //นำ id ของผู้สมัครงานมาตั้งชื่อไฟล์ resume 
             //แล้วย้ายไปจัดเก็บไว้ในไดเร็กทอรีปลายทาง
            $file_name = "$id.pdf";
            @mkdir('resume');
            move_uploaded_file($file['tmp_name'], "resume/$file_name");

            //อัปเดตชื่อไฟล์ resume ในตารางให้ตรงกับไฟล์ที่จัดเก็บเอาไว้
            $sql = "UPDATE applicant SET resume_file = '$file_name'
                        WHERE id = $id";
            $mysqli->query($sql);
            $mysqli->close();

            show_alert('ข้อมูลการสมัครงานถูกจัดเก็บแล้ว', 'alert-success');
            include 'footer.php';
            exit ('</form></body></html>');
      }
}

//อ่านชื่อตำแหน่งงานมาแสดงเป็นตัวเลือกในฟอร์ม
$sql = 'SELECT id, position FROM jobs';
$result = $mysqli->query($sql);
if ($result->num_rows == 0) {
      echo '<h6 class="text-center text-danger mt-3 mb-5">ไม่มีตำแหน่งงานที่เปิดรับสมัคร</h6>';
      $mysqli->close();
      include 'footer.php';
      exit('</form></body></html>');
}
?>
<h6 class="my-3 text-info text-center">สมัครงาน</h6>    
<label>ชื่อ - นามสกุล</label>
<div class="input-group input-group-sm mb-4">          
      <input type="text" name="firstname" placeholder="ชื่อ" class="form-control" required>
      <input type="text" name="lastname" placeholder="นามสกุล" class="form-control" required>
</div>

<label>ตำแหน่งงานที่สมัคร</label>
<div>
 <?php
      while (list($id, $position) = $result->fetch_row()) {
      echo <<<HTML
      <div class="custom-control custom-checkbox">
            <input type="checkbox" name="positions[]" id="c$id" class="custom-control-input" value="$position">
            <label class="custom-control-label" for="c$id">$position</label>
      </div>        
      HTML;
  }
 ?>
</div>

<label class="mt-4 mb-1">ไฟล์ Resume (PDF เท่านั้น)</label>
<div class="custom-file mb-4">
      <input type="file" name="resume" accept="application/pdf" class="custom-file-input" required>     
      <label class="custom-file-label">เลือกไฟล์</label>
</div>
<button type="submit" id="submit" class="btn btn-primary btn-sm d-block mx-auto px-5">สมัคร</button>

<br><br><br><br><br>
</form>   
    
<?php require 'footer.php'; ?>
</body>
</html>

