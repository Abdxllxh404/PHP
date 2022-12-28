<?php
include 'check-signin.php';
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            body {
                  margin: 0;
            }
            table {
                  
            }
      </style>
      <script>
      $(function() {
            $('.btn-delete').click(function() {
                  if (confirm('ยืนยันการลบผู้สมัครงานรายนี้')) {
                        $(this).parent('form').submit();
                  }
            });
      });
      </script>
</head>
<body>
<?php require 'navbar.php'; ?>  
    
<div class="main-container p-4">   
<?php
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_jobs_resume');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['del_id'];
      $sql = "DELETE FROM applicant WHERE id = $id";
      $mysqli->query($sql);
      //ลบไฟล์ Resume ของผู้สมัครงานรายนั้นด้วย
      $file_name = "resume/$id.pdf";
      unlink($file_name);
}

$sql = 'SELECT * FROM applicant ORDER BY id DESC';
$result = $page->query($mysqli, $sql, 20);

echo <<<HTML
<table class="table table-striped table-sm mx-auto my-4">
<thead class="thead-dark">
      <tr><th>รายชื่อผู้สมัครงาน</th><th>&nbsp;</th></tr>
</thead>
<tbody>
HTML;

while ($a = $result->fetch_object()) {
      $p = str_replace(':::', ', ', $a->apply_for_positions);             
      echo <<<HTML
      <tr>
            <td>$a->firstname $a->lastname<br><span class="text-info small">ตำแหน่งที่สมัคร: $p</span></td>
             <td class="text-right pr-3">
                   <a href="view-resume.php?id=$a->id" target="_blank" class="btn btn-primary btn-sm mx-3">Resume</a>
                   <form method="post" class="d-inline">
                        <input type="hidden" name="del_id" value="$a->id">
                        <button type="button" class="btn-delete btn btn-danger btn-sm">ลบ</button>
                  </form>
            </td>
      </tr>
      HTML;
}
echo '</tbody></table>';

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}  

$mysqli->close();
?>
    
<br><br><br><br><br>
</div>      <!-- main-container -->
    
<?php require 'footer.php';  ?>
</body>
</html>
