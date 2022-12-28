<?php
@session_start();
if (!isset($_SESSION['admin'])) {
      header('location: admin-signin.php');
      exit;
}
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
          * {
                font-size: 0.93rem;
          }
            div.main-container {
                max-width: 680px;
                min-width: 400px;
            }
      </style>
      <script>
      $(function() {

      });
      </script>
</head>
<body class="pt-5">
<?php require 'navbar.php'; ?> 
    
<div class="main-container mx-auto px-2 pt-4">
<h6 class="text-info mb-4 text-center">รายการสั่งซื้อจากล่าสุด</h6>
<?php      
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $page->query($mysqli, $sql);

if ($mysqli->error || $result->num_rows == 0) {
      echo '<div class="text-center text-danger lead">ไม่พบข้อมูล</div>';
      goto end_page;
}

echo <<<HTML
<table class="table table-striped table-sm table-bordered mt-4 m-auto">
<thead class="thead-dark">
<tr class="text-center">
      <th>วันที่</th><th>ผู้ซื้อ</th><th>มูลค่ารวม</th><th>การชำระเงิน</th><th>การจัดส่ง</th><th></th>
</tr>
</thead>
<tbody>
HTML;

while ($order = $result->fetch_object()) {
      $order_id = $order->id;
      $t = strtotime($order->order_date);
      $d = date('d-m-Y', $t);
      $n = $order->firstname . '&nbsp;&nbsp;' . $order->lastname;
      
      $sql = "SELECT SUM((oi.quantity * p.price) + (oi.quantity * p.delivery_cost)) AS total
                  FROM orders_item oi 
                  LEFT JOIN product p
                  ON oi.product_id = p.id
                  WHERE oi.order_id = $order_id";

      $result2 = $mysqli->query($sql);
      $row = $result2->fetch_object(); 
      $total = number_format($row->total);
      
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

      $dvr = '<i class="far fa-times-circle text-danger"></i>';
      if ($order->delivery == 'yes') {
            $dvr = '<i class="far fa-check-circle text-success"></i>';
      }

      $a = "<a href=\"admin-order-detail.php?id=$order_id\" target=\"_blank\">รายละเอียด</a>";

      echo <<<ROW
      <tr class="text-center">
            <td>$d</td><td>$n</td><td>$total</td><td>$p</td><td>$dvr</td><td>$a</td>
      </tr>
      ROW;
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
<?php require 'footer.php'; ?> 
</body>
</html>
