<?php
@session_start();
if (!isset($_SESSION['member_id'])) {
      header('location: member-signin.php');
      exit;
}

if (!isset($_GET['id'])) {
       header('location: index.php');
      exit;           
}
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            div.main-container {
                max-width: 600px;
                min-width: 450px;
            }
            
            img.product {
                max-width: 64px;
                max-height: 64px;
            } 
            
            div.row {
                  border-bottom: solid 1px lightgray;
            }
            
            #main-container button {
                  width: 120px;
            }
      </style>
      <script>
      $(function() {
            $('a#cancel').click(function() {
                  if (confirm('ยืนยันการยกเลิกคำสั่งซื้อนี้ ?')) {
                         $('#form-cancel').submit();
                  }
            });
      });
      </script>
</head>
<body class="pt-5">
<?php require 'navbar.php'; ?> 
    
<div class="main-container mx-auto px-3 pt-5">
<?php      
$order_id = $_GET['id'] ?? 0;
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
//ถ้าส่งค่า id สำหรับยกเลิกการสั่งซื้อเข้ามา ก็ให้ใช้เป็นเงื่อนไขเพื่อลบออกจากตาราง orders และ orders_item
if (isset($_POST['cancel_id'])) {
      $cancel_id = $_POST['cancel_id'];
      $sql = "DELETE FROM orders WHERE id = $cancel_id";
      $mysqli->query($sql);

      $sql = "DELETE FROM orders_item WHERE order_id = $cancel_id";
      $mysqli->query($sql);                
}
//ถ้าส่งข้อมูลการแจ้งชำเงินเข้ามา ก็นำไปอัปเดตตาราง orders
if (isset($_POST['bank'])) {
      $bank = $_POST['bank'];
      $date = $_POST['date'];
      $time = $_POST['time'];

      $sql = "UPDATE orders 
                  SET pay_status = 'pending', bank_transfer = '$bank',
                         date_transfer = '$date', time_transfer = '$time'
                  WHERE id = $order_id";

      $mysqli->query($sql);
}

//อ่านข้อมูลรายละเอียดการสั่งซื้อมาแสดงผล
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result_orders = $mysqli->query($sql);

if ($mysqli->error || $result_orders->num_rows == 0) {
      echo '<h6 class="text-center text-danger">ไม่พบข้อมูล <br>หรือการสั่งซื้อถูกยกเลิกแล้ว</h6>';
      goto end_page;
}

$order = $result_orders->fetch_object();
$t = strtotime($order->order_date);
$d = date('d-m-Y', $t);       //แปลงรูปแบบวัน-เดือน-ปี     

//แสดงข้อมูลในแบบ grid ของ bootstrap
 echo <<<HTML
<h6 class="text-info mb-4 text-center">รายละเอียดการสั่งซื้อและแจ้งชำระเงิน</h6>
<div class="container">
<div class="row pb-3">
      <div class="col-12 col-md-6">รหัสสั่งซื้อ #$order_id</div>
      <div class="col-12 col-md-6 text-md-right">วันที่ $d</div>
</div>        
HTML;           

 //สินค้าแต่ละรายการที่สั่งซื้อต้องใช้ข้อมูลร่วมกันจาก 2 ตาราง
 //คือ orders_item และ product จึงจะครบสมบูรณ์
$sql =<<<SQL
      SELECT oi.*,  p.* 
      FROM orders_item oi
      LEFT JOIN  product p
      ON oi.product_id = p.id
      WHERE oi.order_id = $order_id
SQL;

$result_items = $mysqli->query($sql);

 if ($mysqli->error || $result_items->num_rows == 0) {
      echo '<h6 class="text-center text-danger">ไม่พบข้อมูล</h6>';
      goto end_page;
}

$result_items = $mysqli->query($sql);
$grand_total = 0;
$dvr_cost = 0;
while ($data = $result_items->fetch_object()) {
      $n = $data->name;
      $files = explode(',', $data->img_files);
      $src = "product-images/$data->id/{$files[0]}";
      $price = number_format($data->price);
      $qty = number_format($data->quantity);
      $subtotal = $data->price * $data->quantity;
      $st = number_format($subtotal);
      $grand_total += $subtotal;   
      $dvr_cost += $data->delivery_cost * $data->quantity;
      
      echo <<<HTML
      <div class="row py-2">
            <div class="col-2 text-right"><img src="$src" class="product"></div>
             <div class="col-10">
                   <h6><a href="product-detail.php?id=$data->id">$n</a></h6>
                   <div class="d-flex justify-content-between align-items-center">
                        <div class="small">
                              ราคา: $price<br>
                              จำนวน: $qty
                        </div>
                        <div>$st</div>
                  </div>
              </div>
       </div>
      HTML;
}

$gt = number_format($grand_total + $dvr_cost);
$f_dvr_cost = number_format($dvr_cost);

echo <<<HTML
<div class="row py-2">
      <div class="col text-center">ค่าจัดส่งรวม</div>
      <div class="col text-right">$f_dvr_cost</div>
</div>   
<div class="row pt-4 pb-2">
      <div class="col text-center">รวมทั้งสิ้น</div>
      <div class="col text-right">$gt</div>
</div>       
HTML;


$bs_class = 'btn-primary';
$pay = '';
if ($order->pay_status == 'paid') {
      $pay = 'ชำระแล้ว';
      $bs_class = 'd-none';
} else if ($order->pay_status == 'pending') {
      if ($order->payment == 'cod') {
            $pay = 'ชำระปลายทาง';
            $bs_class = 'd-none';
      } else if (!empty($order->bank_transfer)) {
            $pay = 'รอตรวจสอบ';
      } else {
            $pay = 'ค้างชำระ';
      }
}

$btn_notify =<<<BTN_NOTIFY
<button id="pay-notify" class="btn btn-sm $bs_class mb-4" data-toggle="modal" data-target="#modalNotify">แจ้งโอนเงิน</button>
BTN_NOTIFY;   

$btn_cancel ='';
if ($order->pay_status != 'paid' && $order->delivery != 'yes') {
      $btn_cancel =<<<CANCEL
      <form id="form-cancel" method="post">
            <input type="hidden" name="cancel_id" value="$order->id">
            <a href=# id="cancel" title="ยกเลิกการสั่งซื้อ"><i class="fas fa-trash"></i></a>
      </form>
      CANCEL;                     
}

$dvr = '';
if ($order->delivery == 'yes') {
      $dvr = '<div class="text-success">
                        <i class="fa fa-truck"></i><br>
                        จัดส่งสินค้าแล้ว</div>';
}

echo <<<HTML
<div class="row pt-3 pb-2">
      <div class="col text-center">การชำระเงิน</div>
      <div class="col text-right">$pay</div>
</div>
<div class="row pt-3 pb-2">
      <div class="col text-center">
            <p class="text-info">ที่อยู่ในการจัดส่ง</p>
            $order->firstname  $order->lastname <br>
            $order->address <br>
            $order->phone               
      </div>
      <div class="col text-right">
            $btn_notify<br>
            $btn_cancel
            $dvr
      </div>
</div>                      
HTML;            

echo '</div>';  //end grid container
?>
<br><br><br><br>        
</div> <!-- main container -->

<!-- ฺbootstrap modal  แสดงฟอร์มแจ้งชำระเงิน -->
<div id="modalNotify" class="modal fade">
<form id="modal-form" method="post">
<div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                  <h6 class="modal-title">แจ้งชำระเงิน</h6>
                  <button class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                        <label>ธนาคารที่โอน:</label>
                        <select name="bank" class="form-control form-control-sm w-auto">
                              <option value="กรุงเทพ">กรุงเทพ</option>
                              <option value="กรุงไทย">กรุงไทย</option>
                              <option value="กสิกรไทย">กสิกรไทย</option>
                              <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
                        </select>
                  </div>
                  <div class="form-group">
                      <label>วันเวลาที่โอน:</label><br>
                        <input type="date" name="date" class="form-control form-control-sm d-inline w-auto" required>
                        <input type="time" name="time" class="form-control form-control-sm d-inline w-auto" required>
                  </div>
            </div>
            <div class="modal-footer justify-content-center">
                  <button id="modal-btn-submit" class="btn btn-primary">ตกลง</button>
            </div>
      </div>
</div>
</form>   
</div>   <!-- end modal -->

<?php
end_page:
$mysqli->close();

include 'footer.php'; 
?>
</body>
</html>
