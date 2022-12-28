<?php
include 'check-signin.php';   //ตรวจสอบว่าได้เข้าสู่ระบบในฐานะ admin หรือยัง
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
       <style>
            html, body {
                  width: 100%;
                  height: 100%
            }
            
            form {
                  max-width: 800px;
                  min-width: 450px;
            }
            
            .alert {
                   max-width: 400px;
            }
      </style>
      <script>
      $(function() {
            $('#add').click(function() {
                  var el = $('[name="qualifications[]"]:last');
                  var input = el.clone();
                  input.val('');                         				
                  el.after(input);
            });
            
            $('#add').click();
            
            $('#delete').click(function() {
                  if ($('input[name="qualifications[]"]').length > 1) {
                        $('input[name="qualifications[]"]:last').remove();
                  }
            });
      });
      </script>
</head>
<body>    
<?php require 'navbar.php'; ?>
    
<form method="post" class="mx-auto text-center mt-3 mb-5">    
 <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $mysqli = new mysqli('localhost', 'root', '', 'pmdb_jobs_resume');
       $sql = 'INSERT INTO jobs VALUES(?, ?, ?, ?, ?, ?)';
       $stmt = $mysqli->stmt_init();
       $stmt->prepare($sql);
       $qualifications = [];
       foreach ($_POST['qualifications'] as $q) {
             $q = trim($q);
             if (!empty($q)) {
                  $qualifications[] = $q;
             }
       }

       $qual_str = implode(':::', $qualifications);
       
       $params = [0, $_POST['position'], $_POST['quantity'], 
                         $_POST['description'], $qual_str, date('Y-m-d')];
      
       $stmt->bind_param('isssss', ...$params);
       $stmt->execute();
       
       $msg = '';
       $contextual = '';
       if ($stmt->affected_rows == 1) {
             $msg = 'จัดเก็บข้อมูลเรียบร้อยแล้ว';
             $contextual = 'alert-success';       
       } else {
            $msg = 'เกิดข้อผิดพลาด ในการจัดเก็บข้อมูล';
             $contextual = 'alert-danger';            
       }
      echo <<<HTML
      <div class="alert $contextual mx-auto mb-4" role="alert">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
      HTML;        
      
       $stmt->close();
       $mysqli->close();
 }
 ?>
    <h6 class="text-center text-info mt-5">ประกาศรับสมัครงาน</h6>
      <input type="text" name="position" placeholder="ตำแหน่งงาน" class="form-control form-control-sm mt-3 w-50 d-inline" required>      
      <input type="text" name="quantity" placeholder="จำนวน (อัตรา)" class="form-control form-control-sm mt-3 w-25 d-inline">     
      <textarea name="description" placeholder="รายละเอียดของงาน" rows="2" class="form-control form-control-sm mt-3 w-75 mx-auto"></textarea>     
      <input type="text" name="qualifications[]" placeholder="คุณสมบัติ" class="form-control form-control-sm mt-2 w-75 mx-auto">    
      <div class="d-flex mx-auto mt-4 w-75 justify-content-between">
            <div>
                  <div type="button" id="add" class="btn btn-primary btn-sm">เพิ่มคุณสมบัติ</div>    
                  <div  type="button" id="delete" class="btn btn-warning btn-sm">ลดคุณสมบัติ</div>                 
            </div>
          <button type="submit" id="ok" class="btn btn-info btn-sm">ส่งข้อมูล</button>
      </div>
      <br><br><br><br><br>
</form>
    
<?php require 'footer.php'; ?>
</body>
</html>


