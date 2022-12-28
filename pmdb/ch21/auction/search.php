<!DOCTYPE html>
<html>
<head>
      <?php include 'head.php'; ?>
      <style>
            html, body {
                  widh: 100%;
                  height: 100%;
                  padding-top: 4rem;
            }
            * {
                  font-size: 0.95rem;
            }
            div#main-container {
                max-width: 800px;
                min-width: 400px;
            }
            
            img.item {
                width: 60px;
                max-height: 60px;
                cursor: pointer;
            } 
            
            div.row {
                  border-bottom: solid 0px darkgray;
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
<body>
<?php include 'navbar.php'; ?>
  
<div id="main-container" class="mx-auto px-3 mt-3 mt-sm-0">  
<?php      
include 'lib/pagination-v2.class.php';
$page = new PaginationV2();      
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');

$sql = 'SELECT * FROM item ';
//กำหนดเงื่อนไขตามคีย์เวิร์ด หรือ id ที่ถูกส่งเข้ามา
if (isset($_GET['q'])) {
      $q = $_GET['q'];
      $sql .= " WHERE name LIKE '%$q%' OR detail LIKE '%$q%' ";
} else if (isset($_GET['mid'])) {
      $mid = $_GET['mid'];
      $sql .= " WHERE member_id =$mid ";
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
<p class="text-info text-center mb-3">
      ข้อมูลลำดับที่:  $start_row - $stop_row จากทั้งหมด: $total_rows
</p>
<div class="container">
HTML;
        
$col = 1;
while ($item = $result->fetch_object()) {
      $item_id = $item->id;
      $img_files = explode(',', $item->img_files);                  
      $src = "item-images/$item_id/{$img_files[0]}";

     $sql = "SELECT MAX(bid_price) FROM bid WHERE item_id = $item_id";
     $r_max = $mysqli->query($sql);
      $row = $r_max->fetch_row();         
     if (!empty($row[0])) {
           $max = number_format($row[0]);
     } else {
            $max = number_format($item->start_price);
     }      

     $sql = "SELECT COUNT(*) FROM bid WHERE item_id = $item_id";
     $r_count = $mysqli->query($sql);
      $row = $r_count->fetch_row();
      $bidders = $row[0];

      if ($col % 2 != 0) {
            echo '<div class="row py-2">';
      }

      echo <<<HTML
      <div class="col-12 col-md-6 mt-3 d-flex">
            <div class="mt-1 mr-3">
                  <a href="item-detail.php?id=$item->id"><img src="$src" class="item"></a>
            </div>
             <div>
                   <h6>
                         <a href="item-detail.php?id=$item->id">$item->name</a>
                   </h6>
                   <div class="d-flex justify-content-between align-items-center">
                        <div class="small">
                              <span class="badge bg-success">ราคาปัจจุบัน: $max</span>
                               <span class="badge bg-secondary">ผู้ร่วมประมูล: $bidders</span>
                        </div>
                  </div>
            </div>
      </div>
      HTML;

       if ($col % 2 == 0) {
            echo '</div>';  //end row
      }
      
      $col++;
}            

echo '</div>';  //end grid container

if ($page->total_pages() > 1) {
     echo '<div class="mt-3 my-5">';
     $page->echo_pagenums_bootstrap();
     echo '</div>';                 
}

end_page:
$mysqli->close();
?>

</div>   <!-- main container -->

<?php include 'footer.php'; ?>
</body>
</html>
