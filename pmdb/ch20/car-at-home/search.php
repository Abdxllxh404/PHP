<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            div#main-container {
                max-width: 680px;
                min-width: 400px;
            }
            
            img.car {
                max-width: 80px;
                max-height: 60px;
                cursor: pointer;
            } 
            
            div.row {
                  border-bottom: dotted 1px #bbb;
            }
            
            span.badge {
                  font-size: 0.8rem;
                  font-weight: normal;
                  padding: 0.4rem;
                  color: white;
            }
      </style>
      <script>
      $(function() {            
            
      });
      </script>
</head>
<body class="pt-5">
<?php require 'navbar.php'; ?>
    
<div id="main-container" class="mx-auto mt-5 px-3">
<?php      
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();
  
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');
$sql = 'SELECT * FROM car_advert ';

//ถ้าแนบ id เข้ามา ให้ใช้เป็นเงื่อนไขของคอลัมน์ seller_id
//ถ้าส่งชื่อยี่ห้อเข้ามา ให้ใช้เป็นเงื่อนไขของคอลัมน์ brand_name
//ถ้าส่งชื่อรุ่นเข้ามา ให้ใช้เป็นเงื่อนไขของคอลัมน์ model
if (isset($_GET['seller'])) {
      $id = $_GET['seller'];
      $sql .= " WHERE seller_id = $id";
} else if (isset($_GET['brand']) && isset($_GET['model'])) {
      $b = $_GET['brand'];
      $m = $_GET['model'];
      if (!empty($_GET['brand']) && !empty($_GET['model'])) {
            $sql .= " WHERE brand_name LIKE '%$b%' AND model LIKE '%$m%' ";
      } else if (!empty($_GET['brand'])) {
            $sql .= " WHERE brand_name LIKE '%$b%' ";
      } else if (!empty($_GET['model'])) {       
            $sql .= " WHERE model LIKE '%$m%' ";
      }
} else if (isset($_GET['brand'])) {
      $b = $_GET['brand'];
      $sql .= " WHERE brand_name LIKE '%$b%' ";
} else if (isset($_GET['model'])) {
      $m = $_GET['model'];
      $sql .= " WHERE model LIKE '%$m%' ";
} 
$sql .= ' ORDER BY id DESC';

$result = $page->query($mysqli, $sql, 10);
if ($mysqli->error || $result->num_rows == 0) {
      echo '<div class="text-center text-danger lead">ไม่พบข้อมูล</div>';
      goto end_page;
}

$start_row = $page->start_row();
$stop_row = $page->stop_row();
$total_rows = $page->total_rows();
echo <<<HTML
<h6 class="text-info text-center mt-5 pt-4 mt-md-0 pt-md-0 mb-4">
      ผลการค้นหาลำดับที่:  $start_row - $stop_row จากทั้งหมด: $total_rows
</h6>
<div class="container">
HTML;

while ($c = $result->fetch_object()) {
      $img_files = explode(',', $c->img_files);               
      $car_id = $c->id;
      $src = "car-images/$car_id/{$img_files[0]}";
      $p = number_format($c->price); 
      $e = number_format($c->engine);

      echo <<<HTML
      <div class="row py-3">
            <div class="col-2 ml-1 ml-md-0 text-left text-md-right">
                  <a href="car-detail.php?id=$c->id"><img src="$src" class="car"></a>
            </div>
             <div class="col-10 ml-1 ml-md-0">
                   <h6 class="mt-1 mt-md-0">
                         <a href="car-detail.php?id=$c->id">$c->brand_name $c->model</a>
                   </h6>
                   <div class="d-flex justify-content-between align-items-center">
                        <div class="small">
                              <span class="badge bg-success">ปี: $c->year</span>
                               <span class="badge bg-secondary">เครื่อง: $e</span>
                               <span class="badge bg-info">เกียร์: $c->transmission</span>
                        </div>
                        <div>฿$p</div>
                  </div>
              </div>
       </div>
      HTML;
}            
echo '</div>';  //end container

if ($page->total_pages() > 1) {
      echo '<div class="mt-3 my-5">';
      $page->echo_pagenums_bootstrap();
      echo '</div>';
}

end_page:
$mysqli->close();
?>      
</div>
    
<?php require 'footer.php'; ?>
</body>
</html>
