<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            body {
                  margin: 0;
                  padding-bottom: 40px;
            }
            
            div.descr, div.qual {
                  font-size: 0.90rem;
            }
      </style>
      <script>
      $(function() {
            $('.btn-delete').click(function() {
                  if (confirm('ยืนยันการลบตำแหน่งงานนี้')) {
                        var f = $(this).parent('form');
                        f.submit();
                  }
            });
      });
      </script>
</head>
<body>   
<?php require 'navbar.php'; ?>
    
<div class="main-container mt-1 mx-3">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_jobs_resume');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['del_id'];          
      $sql = "DELETE FROM jobs WHERE id = $id";
      $mysqli->query($sql);
}

$sql = 'SELECT * FROM jobs';
$result = $mysqli->query($sql);

echo '<div class="row">';
echo '<div class="col-12">';
if ($result->num_rows == 0) {
      echo '<h6 class="my-4 text-danger text-center">ไม่มีตำแหน่งงานที่เปิดรับสมัคร</h6>';
      $mysqli->close();
      include 'footer.php';
      exit;       
} else {
      echo '<h6 class="my-4 text-info text-center">ตำแหน่งงานที่เปิดรับสมัคร</h6>';
}

echo '<div class="container">';     //grid

while ($job = $result->fetch_object()) {
      $qualifications = '<ul>';
      $qs = explode(':::', $job->qualifications);
      foreach ($qs as $q) {
            $qualifications .= "<li>$q</li>";
      }
      $qualifications .= '</ul>';

      if (is_numeric($job->quantity)) {
            $job->quantity .= ' อัตรา';
      }

      echo <<<HTML
      <div class="row bg-warning">
            <div class="col-sm-8 font-weight-bold">$job->position</div>
            <div class="col-sm-4 text-sm-right">$job->quantity</div>
      </div>
      <div class="row">
            <div class="descr col my-2"><i>$job->description</i></div>
      </div>
       <div class="row">
            <div class=" qual col">$qualifications</div>
      </div>                 
      HTML;

     if (isset($_SESSION['admin'])) {
            echo <<<HTML
            <div class="row mt-1 mb-3">
                  <div class="col text-center">
                  <form method="post">
                        <input type="hidden" name="del_id" value="$job->id">
                        <button type="button" class="btn-delete btn btn-danger btn-sm">ลบงานตำแหน่งนี้</button>
                  </form>   
                  </div>
            </div>
            HTML;
      }
}

echo '</div>';  //container (grid)

if (!isset($_SESSION['admin'])) {
      echo <<<HTML
      <div class="mt-4  text-center">
            <a href="apply.php" class="btn btn-primary btn-sm px-5">สมัครงาน</a>
      </div>
      HTML;
}

$mysqli->close();
?>

<br><br><br><br><br>
</div>      <!-- main-container -->
    
<?php require 'footer.php';  ?>
</body>
</html>
