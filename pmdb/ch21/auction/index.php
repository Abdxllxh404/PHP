<!DOCTYPE html>
<html>
<head>
      <?php include 'head.php'; ?>
      <style>
            html, body {
                  widh: 100%;
                  height: 100%;
                  padding-top: 3rem;
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
  
<div id="main-container" class="mx-auto px-3 mt-2 mt-sm-0">  
<h6 class="text-info mb-4 text-center">รายการที่เปิดประมูลล่าสุด</h6>
<?php      
      include 'lib/pagination-v2.class.php';
      $page = new PaginationV2();
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');
      //อ่านรายการจากตาราง item
      $sql = 'SELECT * FROM item ORDER BY id DESC';
      $result = $page->query($mysqli, $sql, 10);
      if ($mysqli->error || $result->num_rows == 0) {
            echo '<div class="text-center text-danger lead">ไม่พบข้อมูล</div>';
            goto end_page;
      }

      echo '<div class="container">';
      $col = 1;
      while ($item = $result->fetch_object()) {
            $item_id = $item->id;
            //แยกเอาเฉพาะภาพแรกมาแสดง
            $img_files = explode(',', $item->img_files);                  
            $src = "item-images/$item_id/{$img_files[0]}";
            //หาราคาสูงสุดที่ถูกเสนอของรายการนั้นจาก bid
           $sql = "SELECT MAX(bid_price) AS max_bid FROM bid WHERE item_id = $item_id";
           $result_max = $mysqli->query($sql);
           $bid = $result_max->fetch_object();         
           if (!empty($bid->max_bid)) {
                  $max = number_format($bid->max_bid);
           } else {
                  $max = number_format($item->start_price);
           }      
           //นับจำนวนผู้ร่วมประมูลของสินค้ารายการนั้น
           $sql = "SELECT COUNT(*) AS count FROM bid WHERE item_id = $item_id";
           $result_count = $mysqli->query($sql);
            $bid = $result_count->fetch_object();
            $num_bidders = $bid->count;
            //ถ้าต่อไปเป็นคอลัมน์ในลำดับคี่ ให้เริ่มแถวใหม่ (1 แถวมี 2 คอลัมน์)
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
                                     <span class="badge bg-secondary">ผู้ร่วมประมูล: $num_bidders</span>
                              </div>
                        </div>
                  </div>
            </div>
            HTML;
            //ถ้าคอลัมน์ที่แสดงไปแล้วอยู่ในลำดับคู่ ให้สิ้นสุดแถวนั้น (1 แถวมี 2 คอลัมน์)
             if ($col % 2 == 0) {
                  echo '</div>';  //end row
            }

            $col++;
      }
      echo '</div>';  //end container (grid)

      if ($page->total_pages() > 1) {
           echo '<div class="mt-3 my-5">';
           $page->echo_pagenums_bootstrap();
           echo '</div>';                 
      }
      
      end_page:
      $mysqli->close();
?>
</div>  
    
<?php include 'footer.php'; ?>
</body>
</html>
