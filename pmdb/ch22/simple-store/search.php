<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            div#main-container {
                max-width: 1000px;
            }
            div.card {
                  min-width: 130px;
                  max-width: 150px;
            }       
            div.card img {
                  max-width: 100px;
                  max-height: 100px;
            }           
            div.card * {
                  font-size: 0.9rem;
            }          
            hr {
                  width: 93%;
                  background: #eee;
                  margin-top: 30px;
            }
      </style>
      <script>
      $(function() {

      });
      </script>
</head>
<body class="px-3 pt-5">
   
<?php             
//ต้องคีย์เวิร์ดไปแสดงผลในช่องค้นหาบน navbar
//ดังนั้นต้องอ่านคีย์เวิร์ดก่อนแสดง navbar
$q = '';
if (isset($_GET['q'])) {
      $q = $_GET['q'];
}

include 'navbar.php';   
?>
<div id="main-container" class="mx-auto pt-5">

<?php
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
$sql = "SELECT * FROM product
            WHERE name LIKE '%$q%' OR detail LIKE '%$q%' 
            ORDER BY id DESC";

$result = $page->query($mysqli, $sql, 20);
if ($mysqli->error || $result->num_rows == 0) {
      echo '<h6 class="text-center text-danger">ไม่พบข้อมูล</h6>';
      $mysqli->close();
      exit ('</div></body></html>');
}

$start_row = $page->start_row();
$stop_row = $page->stop_row();
$total_rows = $page->total_rows();

echo <<<HTML
<p class="text-info text-center mb-3">
ผลการค้นหาลำดับที่:  $start_row - $stop_row
จากทั้งหมด: $total_rows</p>
HTML;

echo '<div class="card-deck mx-4 mt-5 justify-content-center">';

while ($p = $result->fetch_object()) {
      $n = $p->name;
      if (strlen($n) > 20) {
            $n = mb_substr($n, 0, 20) . '...';
      }
      $images = explode(',', $p->img_files);
      $src = "product-images/$p->id/{$images[0]}";
      $prc = number_format($p->price);

      echo <<<HTML
      <div class="card border border-info pt-2 shadow mb-3">
            <img class="card-img-top d-block mt-1 mx-auto" src="$src">
            <div class="card-body d-flex flex-column justify-content-between">
                  <h6 class="card-title text-success">$n</h6>
                  <div class="d-flex justify-content-between mt-2">
                        <span class="mt-2">฿$prc</span>
                        <a class="btn btn-info btn-sm p-1" href="product-detail.php?id=$p->id">
                              <i class="fa fa-search-plus"></i></a>
                  </div>
            </div>
      </div>
      HTML;
}
$mysqli->close();

echo '</div>';  //end card
?>

<br>
<?php 
if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();  
}

include 'recently-viewed.php'; 
?>

</div>  <!-- main-container -->
<br><br><br><br>
<?php require 'footer.php'; ?>     
</body>
</html>
