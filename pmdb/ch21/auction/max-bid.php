<?php 
      @session_start();
      if (!isset($_SESSION['member_id'])) {
            header('location: member-signin.php');
            exit;
      }
?>
<!DOCTYPE html>
<html>
<head>
      <?php include 'head.php'; ?>
      <style>
            * {
                  font-size: 0.95rem;
            }
            table {
                  max-width: 600px;
            }
      </style>
      <script>
      $(function() {            

      });  
      </script>
</head>
<body class="px-4 py-5">  
    
<div id="main-container" class="mx-auto">
<?php           
$item_id = 0;
if (isset($_GET['id'])) {
      $item_id = $_GET['id'];
} else {
      goto end_page;
}
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_auction');

//อ่านชื่อรายการที่เปิดประมูล
$sql = "SELECT name FROM item WHERE id = $item_id";
$result1 = $mysqli->query($sql);

if ($mysqli->error || $result1->num_rows == 0) {
      $mysqli->close();
      echo 'ไม่พบข้อมูล';
      goto end_page;
}
$item = $result1->fetch_object();
$item_name = $item->name;

//ตรวจสอบราคาสูงสุดและ id ของผู้เสนอราคาดังกล่าว
$sql = "SELECT * FROM bid
            WHERE bid_price = (
                  SELECT MAX(bid_price)
                  FROM bid
                  WHERE item_id = $item_id)";

$result2 = $mysqli->query($sql);
$bid = $result2->fetch_object();
$member_id = $bid->member_id;

//ตรวจสอบข้อมูลส่วนตัวของผู้เสนอราคาสูงสุด
$sql = "SELECT * FROM member WHERE id = $member_id";
$result3 = $mysqli->query($sql);
$bidder = $result3->fetch_object();

echo <<<HTML
<table class="table table-striped table-sm mt-4 m-auto">
<thead class="thead-dark">
      <tr><th colspan="3">$item_name</th></tr>
</thead>
<tbody>
HTML;

if ($mysqli->error || empty($bidder->firstname)) {
     echo '<tr><td>ยังไม่มีผู้ร่วมประมูล</td></tr>';
} else { 
      $b = number_format($bid->bid_price);
      echo <<<HTML
      <tr><td>ราคาสูงสุด</td><td>$b  บาท</td></tr>
      <tr><td>ผู้เสนอราคาสูงสุด</td><td>$bidder->firstname  $bidder->lastname</td></tr>
      <tr><td>ที่อยู่</td><td>$bidder->address</td></tr>
      <tr><td>โทร</td><td>$bidder->phone</td></tr>
      <tr><td>อีเมล</td><td><a href="mailto:$bidder->email">$bidder->email<a></td></tr>
      HTML;
}
echo <<<HTML
</tbody>
</table>
<p class="mt-3 text-center text-secondary">
      ผู้เปิดประมูล ต้องติดต่อกับผู้เสนอราคาดังกล่าวเพื่อนัดหมายการจัดส่งและชำระเงินตามแต่จะตกลงกัน
</p>
HTML;

$mysqli->close();

end_page:
?>
    
</div> <!-- end main-container -->

<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>   
</body>
</html>
