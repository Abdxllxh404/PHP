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
            
            $('#modalSQL').on('shown.bs.modal', function() {
                  var dbs = $('#select-db').html();
                  $('#modal-select-db').empty();
                  $('#modal-select-db').append(dbs);
                  $('#modal-select-db').children(':first').remove();
                  
                  var chars = $('#charset').html();
                  $('#modal-charset').empty();
                  $('#modal-charset').append(chars);
             });
             
             $('#modal-btn-submit').click(function() {
                   $('#modal-form').submit();
                   $('#modalSQL').modal('hide');
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
@session_start();
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
                  <!-- ปุ่มสำหรับเปิด Modal SQL -->
                  <button type="button" class="btn btn-danger btn-sm mb-2 px-3" data-toggle="modal" data-target="#modalSQL">
                        SQL Command
                  </button><br>
                  <label>Charset:</label>
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

<!-- Bootstap Modal สำหรับเขียนคำสั่ง SQL -->
<div id="modalSQL" class="modal fade">
<form id="modal-form" method="post" action="read-data-sql.php" target="iframe">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title">SQL</h5>
                        <button class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                              <label>ฐานข้อมูล:</label>
                              <select name="db" id="modal-select-db" class="form-control form-control-sm">
                                    <option>ฐานข้อมูล</option>
                              </select>
                        </div>
                        <div class="form-group">
                              <label>คำสั่ง SQL:</label>
                              <textarea name="sql" id="modal-textarea" rows="5" class="form-control form-control-sm" placeholder=""></textarea>
                        </div>
                  </div>
                  <div class="modal-footer d-flex justify-content-between">
                        <div>
                              <span>Charset:</span>
                             <select name="charset" id="modal-charset"  class="custom-select custom-select-sm w-auto"></select>         
                        </div>
                        <button id="modal-btn-submit" class="btn btn-primary">ตกลง</button>
                  </div>
            </div>
      </div>
</form>
</div>

</body>
</html>
