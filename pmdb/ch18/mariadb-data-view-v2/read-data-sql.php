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
$db = '';
$sql = '';
if (!isset($_POST['db']) || !isset($_POST['sql'])) {
      if (!isset($_SESSION['db']) && !isset($_SESSION['sql'])) {
            exit ('</body></html>');
      } else {
            $db = $_SESSION['db'];
            $sql = $_SESSION['sql'];
      }
} else {
      $db = $_POST['db'];
      $sql = $_POST['sql'];
}

$charset = $_GET['charset'] ?? '';

require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$user = $_SESSION['user'];
$pswd = $_SESSION['password'];
$mysqli = new mysqli('localhost', $user, $pswd, $db);
 $mysqli->set_charset($charset);   

$result = $page->query($mysqli, $sql, 10);

echo '<table class="table table-sm table-striped table-bordered mx-auto mt-2 mb-4">';

if ($result->num_rows == 0) {
      echo <<<HTML
      <caption>
            <pre class="bg-light mb-3 border p-2">$sql</pre> 
            <span class="text-danger">ไม่พบข้อมูล</span>
      </caption>
      </table>
      </body></html>
      HTML;

      $mysqli->close();
      exit;
}

$start_row = $page->start_row();
$stop_row = $page->stop_row();
$total_rows = $page->total_rows();     

echo <<<HTML
<caption>
      <pre class="bg-light mb-3 border p-2">$sql</pre>
      <span>ข้อมูลลำดับที่:  $start_row - $stop_row จากทั้งหมด: $total_rows</span"
</caption>
<thead class="thead-dark">
HTML;  

//แสดงแถวหัวตาราง
echo '<tr>';
$field_count =  $result->field_count;
for($i = 0; $i < $field_count; $i++) {
        $field = $result->fetch_field_direct($i);
        echo "<th>" . $field->name . "</th>";
}
echo '</tr></thead><tbody>';

while ($data = $result->fetch_row()) {
      echo '<tr>';
      for ($i = 0; $i < $field_count; $i++) {
            $value = $data[$i];
            $flag = $result->fetch_field_direct($i)->flags;
            if ($flag == 4241) {               //XXXBLOB
                  $value = '[BLOB]';
            } else if (mb_strlen($value) > 50) {
                  $value = mb_substr($value, 0, 50) . '...';
            }
            echo "<td>$value</td>";
     }
     echo '</tr>';
}

echo "</tbody>";
echo"</table>";

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}

$mysqli->close();

$_SESSION['db'] = $db ;
$_SESSION['sql'] = $sql;
?>
<br><br><br><br><br>  
</body>
</html>

