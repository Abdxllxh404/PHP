<?php
@session_start();
$msg = '';
$contextual = '';

if (!isset($_SESSION['member_id'])) {
      $msg = 'ลูกค้าต้องเข้าสู่ระบบก่อนหยิบสินค้าใส่รถเข็น';
      $contextual = 'alert-danger';
      goto end;
}

if (isset($_POST['pro_id'])) {        
      $mid = $_SESSION['member_id'];
      $pid = $_POST['pro_id'];

      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
      $sql = 'REPLACE INTO cart VALUES (?, ?, ?)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('iii', ...[$mid, $pid, 1]);
      $stmt->execute();
      $aff_row = $stmt->affected_rows;
      if ($stmt->error || $aff_row == 0) {
            $msg = 'เกิดข้อผิดพลาดในการหยิบสินค้าใส่รถเข็น';
            $contextual = 'alert-danger';  
      } else {
            $msg = 'หยิบสินค้าใส่รถเข็นเรียบร้อยแล้ว';
            $contextual = 'alert-success';               
      }           
}

$stmt->close();
$mysqli->close();

end:
echo <<<HTML
<div class="alert $contextual mb-4" role="alert">
      $msg
      <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>             
HTML;
?>

