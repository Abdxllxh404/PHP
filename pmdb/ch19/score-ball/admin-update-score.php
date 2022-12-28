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
            html, body {
                width: 100%;
                height: 100%;
                background: azure;
                min-width: 350px;
            }
            
            #main-container {
                max-width: 800px;
            }
            
            span {
                display: inline-block;
                font-size: small;
                width: 150px;
            }          
            
            [type="number"] {
                width: 60px;
                margin-left: 5px;
                margin-right: 5px;
            }

            div.flex-item {
                background: lavender;
                margin-right: 0.25rem;
                min-width: 320px;
            }
            
            button.delete {
                  cursor: pointer;
            }
      </style>
      <script>
      $(function() {
            //เมื่อคลิกไอคอนอัปเดต (ลูกศร) ให้อ่านจำนวนประตูของคู่นั้น
            //แล้วส่งผ่าน AJAX ขึ้นไป พร้อมกับปิดทับพื้นหลังด้วย LoadingOverlay
            $('a.update').click(function() {
                  var id = $(this).attr('data-id');   //id โปรแกรมแข่งขันของคู่นั้น
                  //จำนวนประตูของทีมแรก
                  var t1 = $(this).parent().find('[name="t1"]');
                  var t1_goals = t1.val();
                  if (t1_goals == '') {
                        t1_goals = 0;
                        t1.val(0);
                  }
                  //จำนวนประตูของทีมที่สอง
                  var t2 = $(this).parent().find('[name="t2"]');
                  var t2_goals = t2.val(); 
                  if (t2_goals == '') {
                        t2_goals = 0;
                        t2.val(0);
                  }
                  //ส่งผ่าน AJAX
                  $.ajax({
                        url: 'ajax-update-score.php',
                        type: 'post',
                        data: {'id': id, 't1': t1_goals, 't2': t2_goals},
                        dataType: 'text',
                        //ในระหว่างที่ส่ง ให้ปิดทีบพื้นหลังด้วย LoadingOverlay
                        beforeSend: () => {
                                $.LoadingOverlay('show', {
                                        image: 'clock-loading.gif',
                                        background: 'rgba(200, 200, 200, 0.6)',
                                        text: 'กำลังอัปเดต...',
                                        textResizeFactor: 0.15
                                });
                        },
                        error: (xhr, textStatus) => alert(textStatus),
                        complete: (result) => {  
                              $.LoadingOverlay("hide");
                        }
                  });
            });

            //เมื่อคลิกไอคอนลบ (ถังขยะ) แล้วยืนยัน ให้ส่งข้อมูลจากฟอร์มการลบของคู่นั้นขึ้น
            $('button.delete').click(function() {
                  if (confirm('ลบโปรแกรมการแข่งขันของคู่นี้')) {
                        $(this).parent('form').submit();
                  }                       
             });
      });     
      </script>
</head> 

<body class="pt-5 px-4">
<?php require 'navbar.php'; ?>
    
<div id="main-container" class="mx-auto mt-4">
     
<h6 class="text-info mt-5 text-left text-sm-center">อัปเดตผลการแข่งขัน</h6>
<div class="text-left text-sm-center small">คลิกไอคอน 
      <i class="fas fa-arrow-circle-up"></i> เพื่ออัปเดตผลของคู่นั้นๆ
</div>     
<?php
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $match_id = $_POST['match_id']; 
      
      $sql = "DELETE FROM matches WHERE id = $match_id";    
      $mysqli->query($sql);
}

$sql = 'SELECT * FROM matches ORDER BY match_date DESC, id DESC';
$result = $page->query($mysqli, $sql, 30);

$d = '';
$end_flex_box = true;
while ($m = $result->fetch_object()) {
      $t1_g = ($m->team1_goals >= 0) ? $m->team1_goals : '';
      $t2_g = ($m->team2_goals >= 0) ? $m->team2_goals : '';
      //เนื่องจากเราจัดเรียงผลลัพธ์ตามวันเดือนปี
      //ดังนั้น หากวันเดือนปีของแถวปัจจุบัน ตรงกับแถวก่อนนี้
      //ก็จัดให้อยู่ในกลุ่ม หรือ Flex Container อันเดียวกัน
      //แต่ถ้าวันเดือนปีไม่ตรงกัน ต้องสิ้นสุดกลุ่มเดิม แล้วเริ่มต้นกลุ่มใหม่
      if ($d != $m->match_date) {
            if (!$end_flex_box) {
                  echo '</div>';  //สิ้นสุด flex-box ก่อนนี้
                  $end_flex_box = true;
            }
            $dt = date('d-m-Y', strtotime($m->match_date));
            echo '<div class="mt-3">' . $dt . '</div>';            
            echo '<div class="d-flex flex-wrap">';  //เริ่ม flex-box ใหม่
            $end_flex_box = false;
      } 
      
      echo <<<HTML
      <div class="flex-item p-2 mt-1">
            <span class="t1 text-right">$m->team1</span>
            <input type="number" name="t1" class="form-control form-control-sm d-inline" value="$t1_g" min="0">
            <br>
            <span class="t2 text-right mt-2">$m->team2</span>
            <input type="number" name="t2" class="form-control form-control-sm d-inline" value="$t2_g" min="0">
            <a href="#" data-id="$m->id" class="update ml-3" title="อัปเดตผลของคู่นี้">
                  <i class="fas fa-arrow-circle-up"></i>
            </a>
            <form id="form-delete" method="post" class="d-inline">
                  <input type="hidden" id="mid" name="match_id" value="$m->id">
                  <button type="button" class="delete ml-3 border-0 bg-transparent" title="ลบโปรแกรมแข่งขันของคู่นี้">
                        <i class="fas fa-trash text-danger"></i>
                  </button>
            </form>
      </div>                    
      HTML;

      $d = $m->match_date;
}

if (!$end_flex_box) {
       echo '</div>';  //สิ้นสุด flex-box อันสุดท้าย
}

echo '<br><br>';
if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}

$mysqli->close();
?>
      
</div> <!-- end container  -->
  
<br><br><br>
<?php require 'footer.php'; ?>
</body>
</html>