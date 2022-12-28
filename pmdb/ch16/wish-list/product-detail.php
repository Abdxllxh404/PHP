<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            div.main-container {
                max-width: 680px;
                min-width: 400px;
            }           
            img#product {
                max-width: 150px;
                max-height: 150px;
                cursor: pointer;
            }              
            p#detail, div.container {
                  font-size: 0.9rem;
            }
            
            div.modal img {
                  max-width: 450px;
                  max-height: 450px;
            }
      </style>
      <script>
      $(function() {            
            //เมื่อคลิกที่ภาพ ให้แสดงภาพขนาดจริงใน Modal
            $('img#product').click(function() {		
                  var name = $('#pro-name').text();
                  $('.modal-title').text(name);
                  var img_src = $(this).prop('src');
                  $('.modal-body > img').prop('src', img_src);
                  $('#bsModal').modal();
            });  
      });
      </script>
</head>
<body class="px-3 pt-5">
<?php require 'navbar.php'; ?> 
    
<div class="main-container mx-auto mt-5">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_wish_list');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
      $mid = 0;
      $msg = '';
      $bs_class = '';
      if (!isset($_SESSION['member_id'])) {
            $msg = 'ต้องเข้าสู่ระบบก่อนบันทึกรายการที่ชอบ';
            $bs_class = 'alert-danger';
            goto end_post;
      } else {
            $mid = $_SESSION['member_id'];
      }

      //เพื่อป้องกันการบันทึกข้อมูลซ้ำ 
      //ให้นับจำนวนว่ามีสินค้ารายการนี้ที่ผู้ใช้คนนี้เคยบันทึกไว้แล้วหรือไม่
      $post_pid = $_POST['pid'];
      $sql = "SELECT COUNT(*) FROM wish_list 
                   WHERE member_id = $mid AND product_id = $post_pid";             

      $result = $mysqli->query($sql);
      list($count) = $result->fetch_row();
      if ($count == 0) {      //ถ้าไม่เคยบันทึก จึงจะเพิ่มลงในตาราง
            //id, member_id, product_id
           $sql = 'INSERT INTO wish_list VALUES(?, ?, ?)';
           $p = [0, $mid, $post_pid];
           $stmt = $mysqli->stmt_init();
           $stmt->prepare($sql);
           $stmt->bind_param('iii', ...$p);
           $stmt->execute();                        
      }
      $msg = 'บันทึกเป็นรายการที่ชอบแล้ว';
      $bs_class = 'alert-info';

      end_post:
      echo <<<HTML
      <div class="alert $bs_class mb-4" role="alert">
            $msg
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
      HTML;
}

$pid = $_GET['id'] ?? 0;

$sql = "SELECT * FROM product WHERE id = $pid";
$result = $mysqli->query($sql);

if ($mysqli->error || $result->num_rows == 0) {
      $mysqli->close();
      include 'footer.php';
      exit ('ไม่พบข้อมูล </div></body></html>');
}

$p = $result->fetch_object();
//ถ้าจำนวนสินค้ามากกว่า 0 แสดงคำว่า "มีสินค้า" มิฉะนั้นแสดงคำว่า "สินค้าหมด"
$r = ($p->remain > 0)? 'มีสินค้า' : '<span class="text-danger">สินค้าหมด</span>';
$prc = number_format($p->price);
echo <<<HTML
<div class="d-flex">
      <div>
            <img src="product-images/$p->img_file" id="product" class="mr-4 mt-2">
       </div>
      <div>
            <h6 class="font-weight-bold text-info">$p->name</h6>
            <p id="detail">$p->detail</p>
            <div class="container">
                  <div class="row my-1">
                        <div class="col">ราคา: $prc บาท</div>
                        <div class="col-auto">
                              <button class="btn btn-sm btn-secondary text-white-50 disabled">
                                    <i class="fa fa-shopping-cart mr-2"></i>หยิบใส่รถเข็น
                              </button>
                        </div>
                  </div>
                  <div class="row my-1">
                        <div class="col">$r</div>
                        <div class="col-auto">
                              <form method="post">
                                    <input type="hidden" name="pid" value="$pid"> 
                                    <button class="btn btn-sm btn-success">
                                          <i class="fa fa-heart mr-2"></i>รายการที่ชอบ
                                    </button>
                              </form>
                        </div>
                  </div>                             
            </div>
       </div>
</div>
HTML;

$mysqli->close();
?>   
</div> 
    
<!-- Bootstrap Modal Window ใช้แสดงภาพขนาดจริง -->
<div class="modal" id="bsModal">
      <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                  <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button 	class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body"><img src=""></div>
            </div>      <!-- modal-content -->
      </div>            <!-- modal-dialog -->
</div>                  <!-- modal -->

<br><br><br><br><br>         
<?php require 'footer.php'; ?>
</body>
</html>