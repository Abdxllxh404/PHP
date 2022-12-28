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
      <?php require 'head.php'; ?>
      <style>
            div.main-container {
                max-width: 800px;
                min-width: 600px;
            }
      </style>
      <script>
      $(function() {

      });
      </script>
</head>
<body class="pt-5">
<?php require 'navbar.php'; ?> 
    
<div class="main-container mx-auto px-3 pt-5">
<h6 class="text-info mb-4 text-center">ประวัติการสั่งซื้อ</h6>
<?php      
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$mid = $_SESSION['member_id'];
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
//อ่านข้อมูลที่ลูกค้ารายนั้นเคยสั่งซื้อทั้งหมด (1 รายการต่อการสั่งซื้อ 1 ครั้ง)
$sql = "SELECT * FROM orders WHERE member_id = $mid ORDER BY id DESC";
$result = $page->query($mysqli, $sql);
if ($mysqli->error || $result->num_rows == 0) {
      echo '<h6 class="text-center text-danger">ไม่พบข้อมูล</h6>';
      goto end_page;
}
//แสดงผลแบบตาราง
echo <<<HTML
<table class="table table-striped table-sm table-bordered mt-4 m-auto">
<thead class="thead-dark">
<tr class="text-center">
      <th>วันที่</th><th>มูลค่ารวม</th><th>การชำระเงิน</th><th>การจัดส่ง</th><th></th>
</tr>
</thead>
<tbody>
HTML;

while ($order = $result->fetch_object()) {
      $order_id = $order->id;
      $t = strtotime($order->order_date);
      $d = date('d-m-Y', $t);
      //หามูลค่ารวมของการสั่งซื้อแต่ละครั้ง ซึ่งต้องการอ่านจากตาราง orders_item
      //ซึ่งเป็นรายการสินค้าแต่ละชิ้นที่สั่งซื้อ แต่เนื่องจากข้อมูลบางอย่าง เช่น ราคา และค่าจัดส่ง
      //จัดเก็บอยู่ในตาราง product ดังนั้นจึงจำเป็นต้องใช้วิธีอ่านข้อมูลจากหลายตารางร่วมกัน
      $sql = "SELECT SUM((oi.quantity * p.price) + (oi.quantity * p.delivery_cost)) AS total
                  FROM orders_item oi 
                  LEFT JOIN product p
                  ON oi.product_id = p.id
                  WHERE oi.order_id = $order_id";

      $result2 = $mysqli->query($sql);
      $row = $result2->fetch_object();
      $total = number_format($row->total);

      //แสดงสถานะของการชำระเงินเป็นภาษาไทย
      $p = '';
      if ($order->pay_status == 'paid') {
            $p = 'ชำระแล้ว';
      } else if ($order->pay_status == 'pending') {
            if ($order->payment == 'cod') {
                  $p = 'ชำระปลายทาง';
            } else if (!empty($order->bank_transfer)) {
                  $p = 'รอตรวจสอบ';
            } else {
                  $p = 'ค้างชำระ';
            }
      }
      
      $dvr = '<i class="far fa-times-circle"></i>';
      if ($order->delivery == 'yes') {
            $dvr = '<i class="far fa-check-circle"></i>';
      }

      $a = "<a href=\"member-order-detail.php?id=$order_id\" target=\"_blank\">รายละเอียดและแจ้งโอนเงิน</a>";
      echo "<tr class=\"text-center\"><td>$d</td><td>$total</td><td>$p</td><td>$dvr</td><td>$a</td></tr>";
}
echo '</tbody></table><br><br>';

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}

end_page:
$mysqli->close();
?>
<br><br><br><br>    
</div>
    
<?php include 'footer.php';  ?>
</body>
</html>
