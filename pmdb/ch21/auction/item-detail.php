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
            }
            
            #img-zoom {
                max-width: 280px;
                max-height: 280px;
            }   
            
            img.thumbnail {
                  max-width: 80px;
                  max-height: 80px;
                  cursor: pointer;                
            }
            
            #item-name {
                  font-size: 1rem;
            }
            
            #item-detail {
                  background: lavender;
            }
            
            div.input-group {
                  width: 300px;
            }
      </style>
      <script>
      $(function() {            
            $('img.thumbnail').click(function() {		
                  var img_src = $(this).prop('src');
                  $('#img-zoom').prop('src', img_src);
            });       
            
            $('button.delete').click(function() {
                  if (confirm('ยืนยันการลบรายการนี้')) {
                        $('#form-delete').submit();
                  }   
            });
      });  
      </script>
</head>
<body class="px-3">
<?php include 'navbar.php'; ?> 
    
<div id="main-container" class="mx-auto mt-5 mt-sm-3">     
<?php
//ฟังก์ชันสำหรับแสดง alert ของ Bootstrap
function show_aert($msg, $contextual) {
      echo <<<HTML
      <div class="alert $contextual alert-dismissible">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>                   
      HTML;
}

@session_start();
//รหัสรายการที่ส่งมาจากเพจ index.php หรือ search.php
$item_id = $_GET['id'] ?? 0;

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');

/***** ถ้ามีโพสต์การเสนอราคาถูกส่งขึ้นมา  *****/
if (isset($_POST['bid'])) {
      $msg = '';
      $contextual = 'alert-danger';
      if (!isset($_SESSION['member_id'])) {
            $msg = 'ต้องเข้าสู่ระบบก่อนการประมูล';
      } else {
            //ราคาที่เสนอ ต้องมากกว่าราคาสูงสุดปัจจุบัน
           //ดังนั้นเราต้องตรวจสอบราคาสูงสุดของรายการนั้นก่อน
            $sql = "SELECT MAX(bid_price) AS max_bid FROM bid 
                        WHERE item_id = $item_id";

            $result = $mysqli->query($sql);
            $bid = $result->fetch_object();
            $max = $bid->max_bid;
            //ถ้ายังไม่มีราคาสูงสุด (ยังไม่มีผู้เสนอราคา)
            //ให้เอาราคาเริ่มต้นที่กำหนดโดยผู้เปิดประมูลเป็นราคาสูงสุด
            if (empty($max)) {
                  $sql = "SELECT start_price FROM item WHERE id = $item_id";
                  $result = $mysqli->query($sql);
                  $item = $result->fetch_object();   
                  $max = $item->start_price;
            } 
            //ราคาที่เสนอ ต้องมากกว่าราคาสูงสุดปัจจุบัน จึงจะยอมรับ
            $b = $_POST['bid'];
            if ($b <= $max) {
                  $msg = 'ต้องเสนอราคาประมูลสูงกว่าราคาปัจจุบัน';                   
            } else {
                  $mid = $_SESSION['member_id'];
                  $sql = "INSERT INTO bid VALUES (0, $mid, $item_id, $b, NOW())";
                  $mysqli->query($sql);
                  if ($mysqli->error) {
                        $msg = 'เกิดข้อผิดพลาด กรุณากำหนดราคาประมูลใหม่';
                  } else {
                        $msg = 'การเสนอราคาประมูลเสร็จเรียบร้อย';
                        $contextual = 'alert-info';                          
                  }
            }
      }
      show_aert($msg, $contextual);
      
//ถ้าโพสต์รหัสรายการที่จะลบ ก็ใช้เป็นเงื่อนไขการลบ
//ข้อมูลจากตาราง item และผู้เสนอราคารายการนั้นจากตาราง bid
} else if (isset($_POST['delete_id'])) {
      $del_id = $_POST['delete_id'];
      $sql = "DELETE FROM item WHERE id = $del_id";
      $mysqli->query($sql);

      $sql = "DELETE FROM bid WHERE id = $del_id";
      $mysqli->query($sql);

      //ลบโฟลเดอร์และภาพโดยใช้ไลบรารี DeleteDir
      require 'lib/delete-dir.class.php';
      $dir = "item-images/$del_id";
      DeleteDir::delete($dir);
      
      $msg = '<h5>ข้อมูลถูกลบแล้ว</h5>';
      $contextual = 'alert-warning';
      show_aert($msg, $contextual);
      goto end_page;
}           
/***** สิ้นสุดการดำเนินการกับข้อมูลที่ถูกโพสต์ขึ้นมา  *****/

//ต่อไปคือการอ่านข้อมูลมาแสดง
$sql = "SELECT * FROM item WHERE id = $item_id";
$result_item = $mysqli->query($sql);

if ($mysqli->error || $result_item->num_rows == 0) {
       goto end_page;
}
$item = $result_item->fetch_object();

//นำรูปภาพทั้งหมดของรายการนั้นมาสร้างเป็น Thumbnail
$img_files = explode(',', $item->img_files);
$first_img = $img_files[0];
$img_zoom =<<<HTML
<img src="item-images/$item->id/$first_img" id="img-zoom" class="mt-2">
HTML;

$img_thumb = '<div>';
for ($i = 0; $i < count($img_files); $i++) {
      $img = $img_files[$i];
      $img_thumb .=<<< HTML
      <img src="item-images/$item->id/$img" class="thumbnail mr-2 mt-2 d-block">
      HTML;
}
$img_thumb .= '</div>';

//วันที่เปิดและปิดประมูล
$start_date = strtotime($item->start_date);
$end_date = strtotime($item->end_date);
$start = date("j/n/Y", $start_date);
$end = date("j/n/Y", $end_date);

//ข้อมูลของผู้เปิดประมูล
$member_id = $item->member_id;
$sql = "SELECT * FROM member WHERE id = $member_id";
$result_member = $mysqli->query($sql); 
$member = $result_member->fetch_object();

//ตรวจสอบราคาสูงสุดของรายการนั้น
$sql = "SELECT MAX(bid_price) FROM bid
            WHERE item_id = $item_id";

$result_max_bid = $mysqli->query($sql);
list($max_bid) = $result_max_bid->fetch_row();
//ถ้ายังไม่มีผู้เสนอราคา ให้เอาราคาเริ่มต้นที่กำหนดโดยผู้เปิดประมูลเป็นราคาสูงสุด
if (empty($max_bid)) {
      $bid = number_format($item->start_price);
} else {
      $bid = number_format($max_bid);
}              
$bid .= ' บาท ';

//ตรวจสอบว่าสิ้นสุดระยะเวลาการประมูลหรือยัง
//โดยใช้คลาสของ Bootstrap เป็นตัวสลับการแสดงผล
$now = strtotime('now');
$display_form = 'd-block';    //ปกติ ให้แสดงฟอร์ม
$display_close_auction = 'd-none';  //ซ่อนข้อความ
if ($now > $end_date) {       //ถ้าสิ้นสุดแล้ว
      $display_form = 'd-none';     //ซ่อนฟอร์ม
      $display_close_auction = 'd-block';   //แสดงข้อความ              
}

echo <<<HTML
<div class="container">
<div class="row" style="min-height: 300px">
      <div class="col-12 col-md-6" id="img-container" >
            <div class="d-flex justify-content-center align-items-start mr-3">
                  $img_thumb
                  $img_zoom
            </div>
       </div>
      <div class="col-12 col-md-6 mt-4 mt-md-0">
            <h5 id="item-name" class="font-weight-bold text-info">$item->name</h5>
            <div id="item-detail" class="mb-2 p-2">$item->detail</div>
            <div class="text-success text-right">เปิดประมูลระหว่างวันที่ $start - $end</div>
       </div>
</div>
<div class="row mt-0 mt-md-3 py-2">
<div class="col-12 col-md-6 pt-1 text-center text-md-left">
      <div class="text-left mt-3 mt-md-0">
            <b>ผู้เปิดประมูล:</b> $member->firstname $member->lastname<br>
            <b>โทร:</b> $member->phone<br>        
            <b>อีเมล:</b> $member->email<br>
      </div>                             
</div>               
<div class="col-12 col-md-6 text-center">                              
      <form method="post" class="$display_form mt-5 mt-md-0">
      <span class="text-primary">ราคาปัจจุบัน: $bid</span>
      <div class="input-group input-group-sm mt-2 mx-auto">
            <div class="input-group-prepend">
                  <span class="input-group-text">เสนอราคา</span>
            </div>
            <input type="text" name="bid" class="form-control">
            <div class="input-group-append">
                  <span class="input-group-text">บาท</span>
            </div>
            <div class="input-group-append">
                  <button class="btn btn-success" type="submit">ตกลง</button> 
            </div>
      </div>
      </form>
      <p class=" text-danger $display_close_auction mt-4 mt-md-0">ปิดประมูลแล้ว</p>
</div>
</div>
HTML;

//ถ้าเป็นสมาชิกที่เข้าสู่ระบบและมีค่า id ตรงกับ id ของผู้เปิดประมูลสินค้ารายการนั้น
//ให้แสดงฟอร์มสำหรับการลบ และปุ่มปุ่มผู้เสนอราคาสูงสุด
if (isset($_SESSION['member_id'])) {

      if ($_SESSION['member_id'] == $member_id) {
            echo <<<HTML
            <div class="text-center mt-5 mb-3">
                  <form id="form-delete" method="post" class="d-inline">
                        <input type="hidden" name="delete_id" value="$item_id">
                        <button type="button" class="delete btn btn-danger btn-sm mr-4">ลบรายการนี้</button>
                  </form>        
                  <a href="max-bid.php?id=$item_id" target="_blank" class="btn btn-success btn-sm">ผู้เสนอราคาสูงสุด</a>
            </div> 
            HTML;
      }
}             

//ต่อไปเป็นการแสดงตารางประวัติการเสนอราคา 10 คนล่าสุด
//โดยอ่านข้อมูลจาก 2 ตารางแบบ LEFT JOIN
$sql = "SELECT CONCAT(m.firstname, ' ', m.lastname), b.bid_price
            FROM bid b
            LEFT JOIN member m
            ON b.member_id = m.id
            WHERE b.item_id = $item_id  
            ORDER BY b.id DESC
            LIMIT 10";

$result2 = $mysqli->query($sql);
echo <<<HTML
<table class="table table-striped table-sm mt-4">
<thead class="thead-dark">
<tr>
      <th colspan="3">ประวัติการเสนอราคา</th>
</tr>
</thead>
<tbody>
HTML;

if ($mysqli->error || $result2->num_rows == 0) {
     echo '<tr><td>ยังไม่มีผู้ร่วมประมูล</td></tr>';
} else {
     while (list($bidder, $price) = $result2->fetch_row()) {
           $b = number_format($price);
           echo "<tr><td>$bidder</td><td>$b</td></tr>";
     }
}

echo <<<HTML
</tbody>
</table>
HTML;

end_page:
$mysqli->close();
?>
</div> <!-- end main-container -->

<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>   

<?php include 'footer.php'; ?>
</body>
</html>