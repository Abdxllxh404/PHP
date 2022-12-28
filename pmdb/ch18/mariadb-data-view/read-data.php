<?php
require 'check-signin.php';
 ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            html, body {
                 width: 100%;
                 height: 100%;
            }
            body {
                 padding-left: 10px;
            }
            table {
                  max-width: 95%;
            }
            caption {
                 caption-side: top !important;
                 text-align: left !important;
            }
            
      </style>
      <script>
      $(function() {

      });
      </script>
</head>
<body>
<?php
//ต้องมีครบทั้งชื่อฐานข้อมูลและตาราง
if (!isset($_GET['db']) || !isset($_GET['tb'])) {
      exit ('</body></html>');
}           
$db = $_GET['db'];
$tb = $_GET['tb'];
$charset = $_GET['charset'] ?? '';

require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$user = $_SESSION['user'];
$pswd = $_SESSION['password'];
$mysqli = new mysqli('localhost', $user, $pswd, $db);
$mysqli->set_charset($charset);   

$sql = "SELECT * FROM $tb";
$result = $page->query($mysqli, $sql, 10);

if ($result->num_rows == 0) {      
      echo <<<HTML
      <div class="text-center mt-4 text-center">
             [$db.$tb]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-danger">ไม่พบข้อมูล</span>
      </div>
      HTML;

      echo '</body></html>';
      $mysqli->close();
      exit;
}

$start_row = $page->start_row();
$stop_row = $page->stop_row();
$total_rows = $page->total_rows();    

echo <<<HTML
<table class="table table-sm table-striped table-bordered mx-auto mt-2 mb-4">
<caption>
      [$db.$tb]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      ข้อมูลลำดับที่:  $start_row - $stop_row จากทั้งหมด: $total_rows
</caption>
<thead class="thead-dark">
HTML;
//แสดงแถวหัวตาราง
echo '<tr>';
$field_count =  $result->field_count;
for($i = 0; $i < $field_count; $i++) {
        $field = $result->fetch_field_direct($i);
        echo "<th>$field->name</th>";
}
echo '</tr></thead>';

 //แถวของข้อมูล
echo '<tbody>';
while ($data = $result->fetch_row()) {
      echo '<tr>';
      for ($i = 0; $i < $field_count; $i++) {
            $value = $data[$i];
            //ตรวจสอบลักษณะข้อมูลที่จัดเก็บในคอลัมน์นั้น หากเป็นชนิด Binary 
            //ซึ่งไม่สามารถแสดงผลแบบสตริงได้ ก็ให้แสดงเป็นคำว่า "BLOB" แทน
            //และถ้าข้อมูลยาวเกิน 50 อักขระ ก็ให้ตัดมาแสดงแค่ 50 ตัวแรก
            $flag = $result->fetch_field_direct($i)->flags;
            if ($flag == 4241) {      //XXXBLOB
                  $value = '[BLOB]';
            } else if (mb_strlen($value) > 50) {
                  $value = mb_substr($value, 0, 50) . '...';
            }
            echo "<td>$value</td>";
     }
     echo '</tr>';
}

echo '</tbody>
          </table>';

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}

$mysqli->close();
?>
    
<br><br><br><br><br>   
</body>
</html>

