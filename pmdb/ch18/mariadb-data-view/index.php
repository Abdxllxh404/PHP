<?php
require 'check-signin.php';
 ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            html, body {
                  margin: 0;            
                  overflow: hidden;
            }
            iframe {
                display: block;
                border: none; 
                margin-top: 100px;
                height: auto;
                width: 100%;
            }
            label {
                  width: 80px;
            }
            div#col-right > button,  div#col-right > select {
                  width: 130px;
            }
      </style>
      <script>
      $(function() {
            //เมื่อเปลี่ยนแปลงการเลือกฐานข้อมูล 
            //ให้ส่งชื่อฐานข้อมูลที่ถูกเลือกผ่าน AJAX ไปยังเพจปลายทาง
            //เพื่ออ่านชื่อตารางที่มีในฐานข้อมูลนั้น
            $('#select-db').change(function() {
                  var db = $(this).val(); 
                  $.ajax({
                        url: 'ajax-list-table.php',
                        data: {'db': db},
                        type: 'post',
                        dataType: 'text',
                        success: result => {
                              //เมื่อได้รับผลลัพธ์ (รายชื่อตาราง) กลับมา
                              //ก็นำไปอัปเดต (แทนที่) อินพุท select ที่แสดงชื่อตาราง
                              $('#select-tb').empty();
                              $('#select-tb').append(result);
                              //สั่งให้เกิดอีเวนต์ change เพื่อโหลดข้อมูลในตารางนั้นมาแสดงทันที
                              $('#select-tb').change();  
                        }
                  });
            }); 
            
            $('#select-tb').change(function() {
                  $('#form1').submit();
            });
            
            $('#reload').click(function() {
                  $('#form1').submit();
            });
             
             calcHeight();
      });
      
      var calcHeight = function() {
            $('#iframe').height($(window).height()-100);
      }

      $(window).resize(function() {
            calcHeight();
      }).load(function() {
            calcHeight();
      });
      </script>
</head>
<body>
<?php
      $user = $_SESSION['user'];
      $pswd = $_SESSION['password'];
      
      $mysqli = new mysqli('localhost', $user, $pswd);
      if ($mysqli->connect_error) {
            header('location:  signin.php');
            exit;
      }
      $sql = 'SHOW DATABASES';
      $result = $mysqli->query($sql);
?>
<div class="bg-info text-white fixed-top py-2">
<form id="form1" action="read-data.php" method="get" target="iframe">
      <div class="container-fluid">
      <div class="row">
            <div class="col-auto lead mr-3 pt-1 d-none d-md-block text-center" style="color: aqua">MariaDB<br>Data View</div>
            <div class="col-auto">            
                  <div>
                        <label>ฐานข้อมูล:</label>
                        <div class="d-inline-block">    
                              <select name="db" id="select-db" class="custom-select custom-select-sm">
                                    <option>--- เลือก ---</option>
                                     <?php
                                           while (list($db) = $result->fetch_row()) {
                                                 echo "<option value=\"$db\">$db</option>";
                                           }
                                     ?>
                              </select> 
                        </div>
                  </div>  
                  <div class="mt-2">
                        <label>ตาราง:</label>
                        <div class="d-inline-block">
                              <select name="tb" id="select-tb" class="custom-select custom-select-sm">
                                    <option>-----</option>
                              </select>
                        </div>
                        <a href="#"><img id="reload" src="reload.png" title="Reload" class="ml-3"></a>
                  </div>
            </div> 
            
            <div class="col text-right d-none d-sm-block" id="col-right">
                  <label>Charset</label><br>
                  <select name="charset" id="charset"  class="custom-select custom-select-sm">
                        <option value="">Default</option>
                        <option value="utf8">UTF-8</option>
                        <option value="windows-874">Windows-874</option>
                        <option value="tis620">TIS-620</option>
                  </select>                    
            </div>
      </div>
      </div>
</form>
</div>
 
<!--  IFrame สำหรับแสดงตารางผลลัพธ์  -->    
<iframe name="iframe" id="iframe"></iframe>

</body>
</html>
