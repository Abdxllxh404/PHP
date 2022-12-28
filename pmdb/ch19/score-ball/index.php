<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            html, body {
                width: 100%;
                height: 100%;
                background: azure;
            }
            #main-container {
                max-width: 800px;               
            }
            span {
                display: inline-block;
                font-size: small;
            }          
            span.team {
                  width: 150px;
                  color: navy;
            }
            span.score {
                  width: 30px;
                  text-align: right;
            }
            div.flex-item {
                background: lavender;
                margin-right: 0.25rem;
                
            }
      </style>
      <script>
      $(function() {

      });
      </script>
</head> 
<body class="pt-5 px-3">
<?php require 'navbar.php'; ?>
 
<div id="main-container" class="mx-auto mt-5">
<h6 class="text-info text-left text-sm-center mb-4">ผลการแข่งขันอัปเดตล่าสุด</h6>      
<?php
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();
//แสดงวันและเดือนแบบไทย
$months = [1=>'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 
            'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');

$sql = 'SELECT m.*, t1.logo_file AS t1_logo, t2.logo_file AS t2_logo
            FROM matches m
            LEFT JOIN team t1
            ON m.team1 = t1.name
            LEFT JOIN team t2
            ON m.team2 = t2.name            
            ORDER BY m.match_date DESC, m.id DESC';

$result = $page->query($mysqli, $sql, 30);

$date = '';
$end_flex_box = true;
while ($match = $result->fetch_object()) {
      $t1_g = ($match->team1_goals >= 0) ? $match->team1_goals : '';
      $t2_g = ($match->team2_goals >= 0) ? $match->team2_goals : '';
      //เนื่องจากเราจัดเรียงผลลัพธ์ตามวันเดือนปี
      //ดังนั้น หากวันเดือนปีของแถวปัจจุบัน ตรงกับแถวก่อนนี้
      //ก็จัดให้อยู่ในกลุ่ม หรือ Flex Container อันเดียวกัน
      //แต่ถ้าวันเดือนปีไม่ตรงกัน ต้องสิ้นสุดกลุ่มเดิม แล้วเริ่มต้นกลุ่มใหม่
      if ($date != $match->match_date) {
            if (!$end_flex_box) {
                  echo '</div>';  //สิ้นสุด flex-box ก่อนนี้
                  $end_flex_box = true;
            }
            $strtime = strtotime($match->match_date);
            $d = date("j", $strtime);
            $mn = date("n", $strtime);
            $m = $months[$mn];      //แสดงเดือนเป็นภาษาไทย
            $dt = "$d $m";
            echo '<div class="mt-3">' . $dt . '</div>';
            echo '<div class="d-flex flex-wrap">';  //เริ่ม flex-box ใหม่
            $end_flex_box = false;                           
      } 

      echo <<<HTML
      <div class="flex-item px-3 py-2 mt-1">
            <img src="logo/$match->t1_logo" height="20">
            <span class="team t1 ml-1">$match->team1</span>
            <span class="score pl-3">$t1_g</span><br>
            <img src="logo/$match->t2_logo" height="20">
             <span class="team t2 mt-2 ml-1">$match->team2</span>
            <span class="score pl-3">$t2_g</span>
      </div>
      HTML;

      $date = $match->match_date;
}

if (!$end_flex_box) {
      echo '</div>';  //สิ้นสุด flex-box สุดท้าย
}

echo '<br><br>';

if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap();
}

$mysqli->close();
?>
           
</div> <!-- end main-container  -->

<?php require 'footer.php'; ?>    
</body>
</html>