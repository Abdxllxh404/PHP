<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            #productImg {
                max-width: 150px;
                max-height: 150px;
            }
            div.main-container {
                max-width: 680px;
                min-width: 400px;
            }
            div.media img, div.media textarea {
                height: 60px;
            }
            input[name="questioner"], input[name="captcha"] {
                  min-width: 290px;
            }
            li.media img {
                height: 32px;
            }
            span#detail, div.media-body, input {
                  font-size: 0.87rem !important;
            }
            div.reply {
                  background: lavender;
            }
      </style>
      <script>
      $(function() {
            $('#modal-btn-submit').click(function() {
                  $('#modal-form').submit();
                  $('#modalReply').modal('hide');
            });
            
            $('a.delete').click(function() {
                  if (confirm('ลบคำถามนี้ ?')) {
                        id = $(this).attr('id');
                        $('#delete_id').val(id);
                        $('#form-delete').submit();
                  }
            });
      });
      
      function showModalReply(questionId) {
            $('#modalReply').modal();
            $('#modal-qid').val(questionId);
      }
      </script>
</head>
<body class="pt-5 px-3">
    
 <?php require 'navbar.php'; ?>   
<div class="main-container mx-auto mt-5">

<!-- ##########  ส่วนแสดงรายละเอียดของสินค้า  ########## -->
<?php
$product_id = 0;
if (isset($_GET['id'])) {
      $product_id = $_GET['id'];
}

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_question_answer');

$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $mysqli->query($sql);

if ($mysqli->error || $result->num_rows == 0) {
      echo '<h6 class="text-danger text-center">ไม่พบข้อมูล</h6>';
      goto end_page;
}

list ($id, $name, $detail, $img_file) = $result->fetch_row();

echo <<<HTML
<div class="container">
<div class="row">
      <div class="col-12 col-sm-3 pt-2">
            <img src="product-images/$img_file" id="productImg">
       </div>
      <div class="col-12 col-sm-9 pt-3 pt-md-0">
            <h6 class="font-weight-bold text-info">$name</h6>
            <span id="detail">$detail</span>
       </div>
</div>
</div>         
<hr>
HTML;
?>

<!-- ##########  ส่วนของฟอร์มเพื่อใส่คำถาม  ########## -->
<h6 class="text-info text-center mb-3">คำถามเกี่ยวกับสินค้า</h6> 
<?php 
date_default_timezone_set('Asia/Bangkok');
$now = date('Y-m-d H:i:s');
//ถ้ามีการโพสต์คำถามขึ้นมา
if (isset($_POST['question'])) {   
      if ($_POST['captcha'] == $_SESSION['captcha']) {
            //id, product_id, question, questioner, date_asked, answer, date_replied
            $sql = 'INSERT INTO q_a VALUES(?, ?, ?, ?, ?, ?, ?)';
            $question = $_POST['question'];
            $questioner = $_POST['questioner'];
            $p = [0, $product_id, $question, $questioner, $now, '', ''];
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('issssss', ...$p);
            $stmt->execute(); 
      } else {
            echo '<h6 class="text-danger text-center">ใส่อักขระในภาพไม่ถูกต้อง</h6>';
            goto end_page;
      }
}

require 'lib/SimpleCaptcha/captcha.class.php';	
$captcha = new SimpleCaptcha();
?>
<form method="post">
<div class="media border p-3" style="background: powderblue">
      <i class="fa fa-question-circle fa-3x mr-3"></i>
      <div class="media-body">
             <input type="text" name="question" class="form-control form-control-sm" placeholder="คำถาม" required>
            <input type="text" name="questioner" class="form-control form-control-sm d-inline  w-auto mt-2" placeholder="ชื่อ" required> 
            <div id="#captcha" class="float-md-right mt-2">
                  <?php $captcha->show(); ?>
            </div>
            <input type="text" name="captcha" class="form-control form-control-sm d-inline  w-auto mt-2" placeholder="อักขระในภาพ" required>                            
            <button type="submit" class="btn btn-info btn-sm d-block mt-3 px-5">ตกลง</button>                      
      </div>
</div>
<input type="hidden" name="product_id" value="<?= $product_id ?>">
</form>
<!-- สิ้นสุดส่วนฟอร์มคำถาม  -->

<!-- ##########  ส่วนแสดงคำถามและคำตอบ  ########## -->
<?php
if (isset($_POST['answer'])) {       
      $sql = 'UPDATE q_a SET answer = ?, date_replied = ?
                  WHERE id = ?';

      $answer = $_POST['answer'];
      $question_id = $_POST['question_id'];
      $p = [$answer, $now, $question_id];
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param('ssi', ...$p);
      $stmt->execute();
} else if (isset($_POST['delete_id'])) {
      $qid = $_POST['delete_id'];
      $sql = "DELETE FROM q_a WHERE id = $qid";
      $mysqli->query($sql);
}

require 'lib/thai-datetime-friendly.class.php';
require 'lib/pagination-v2.class.php';

$dtf = new ThaiDateTimeFriendly();
$page = new PaginationV2();

$sql = "SELECT * FROM q_a WHERE product_id = $product_id
            ORDER BY date_asked DESC";

$result = $page->query($mysqli, $sql, 10);
if ($mysqli->error || $result->num_rows == 0) {
      goto end_page;
}

echo '<ul class="list-unstyled mt-4 mb-4">';

while ($data = $result->fetch_object()) {
      $q_id = $data->id;
      $admin_link = '';
      if (isset($_SESSION['admin'])) {
            $admin_link =<<<HTML
            <a href="javascript: showModalReply($q_id)">ตอบกลับ</a> - 
            <a href="#" class="delete" id="$q_id">ลบ</a>
            HTML;
     }

      echo <<<HTML
      <li class="media border p-3 mb-2">
            <i class="far fa-question-circle fa-3x mr-3 mt-1 text-secondary"></i>
            <div class="media-body">
                  <h6 class="text-info">$data->questioner</h6>
                  $data->question
                  <div class="d-flex justify-content-between mt-3">
                        <div class="small text-black-50"><i>{$dtf->of($data->date_asked)}</i></div>
                        <div class="text-right">$admin_link</div>
                  </div>
      HTML;

      if (!empty($data->answer)) {
            echo <<<HTML
            <div class="reply media mt-4 p-3">
                  <i class="far fa-check-circle fa-3x mr-3 mt-1 text-success"></i>
                  <div class="media-body">
                        $data->answer
                        <div class="small mt-2 text-black-50"><i>{$dtf->of($data->date_replied)}</i></div>
                  </div>              
            </div>
            HTML;
      }
      echo '</div>';   //media-body
      echo '</li>';
}

echo '</ul>';

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}
?>
    
<!-- Modal สำหรับใส่คำตอบ แสดงเมื่อคลิกที่ลิงก์ "ตอบกลับ" -->
<div id="modalReply" class="modal fade">
<form id="modal-form" method="post">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title">ตอบกลับ</h5>
                        <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                        <textarea name="answer" rows="3" class="form-control form-control-sm bg-light" required></textarea>
                        <input type="hidden" name="question_id" id="modal-qid" value="0">
                  </div>
                  <div class="modal-footer">
                        <button type="button" id="modal-btn-submit" class="btn btn-primary mx-auto">ตกลง</button>
                  </div>
            </div>
      </div>
</form>
</div>

<!-- ฟอร์ม สำหรับส่งค่า id ขึ้นไปลบคำถาม (เมื่อคลิกที่ลิงก์ "ลบ") -->
<form id="form-delete" method="post">
      <input type="hidden" name="delete_id" id="delete_id" value="">
</form>
<!-- สิ้นสุดส่วนแสดงคำถาม-คำตอบ  -->
<?php 
end_page:
$mysqli->close();
?>
<br><br><br><br><br>
</div>      <!-- //main container -->
<?php require 'footer.php';   ?>
</body>
</html>