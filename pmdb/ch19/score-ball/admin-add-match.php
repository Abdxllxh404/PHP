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
          }
          .goals {
                width: 100px;      
          }
          
          label {
                font-size: 0.87rem !important;
          }
      </style>
      <script>
      $(function() {
            //เมื่อเลือกประเทศสำหรับทีมแรก
            $('#country1').change(function() {
                  updateTeam('#country1', '#team1');
            });
            
             //เมื่อเลือกประเทศสำหรับทีมที่สอง
             $('#country2').change(function() {
                  updateTeam('#country2', '#team2');
            });

            //ทำให้เกิดอีเวนต์ change กับ select ทั้งสองอัน 
            //เพื่อโหลดชื่อทีมมาแสดงทันทีเมื่อเปิดเพจ
            $('#country1').change(); 
            $('#country2').change();

            //เมื่อจะส่งข้อมูลจากฟอร์มขึ้นไปเพื่อบันทึกโปรแกรมการแข่งขัน
            //ให้ตรวจสอบก่อนว่า เราเลือกทีมซ้ำซ้อนหรือไม่
            $('button#ok').click(function() {
                  if ($('#match_date').val() == '') {
                        alert('กรุณากำหนดวันแข่งขัน');
                  } else if ($('#team1').val() == $('#team2').val()) {
                        alert('กรุณาเลือกทีมที่แตกต่างกัน');
                  } else {
                        $('form#main').submit();
                  }
            });
      });
     
      //ฟังก์ชันสำหรับการส่งชื่อประเทศที่ถูกเลือกขึ้นไป เพื่ออ่านชื่อทีมของประเทศนั้นมาแสดง
      function updateTeam(country, team_select_id) {
            var c = $(country).val();
            $.ajax({
                  url: 'ajax-team-name.php',
                  data: {'country': c},
                  type: 'post',
                  dataType: 'text',
                  success: (result) => { 
                        $(team_select_id).empty();
                        $(team_select_id).append(result);
                  }
            });                 
      }
      </script>
</head> 
<body class="d-flex pt-5">
 <?php require 'navbar.php'; ?>
    
<form id="main" method="post" enctype="multipart/form-data" class="mx-auto">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $date = $_POST['match_date'];
      $team1 = $_POST['team1'];
      $team2 = $_POST['team2'];
      $sql = 'INSERT INTO matches VALUES (?,?,?,?,?,?)';
      $stmt = $mysqli->stmt_init();  
      $stmt->prepare($sql);
      $params = [0, $date, $team1, $team2, -1, -1];
      $stmt->bind_param('isssii', ...$params);
      $stmt->execute();
      
      if ($stmt->error) {
           echo $stmt->error;
      } else {
            echo <<<HTML
            <div class="alert alert-info alert-dismissible mt-5">
                  ข้อมูลถูกบันทึกแล้ว
                  <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div> 
            HTML;
      }
      
      $stmt->close(); 
}
//อ่านชื่อประเทศแบบไม่ซ้ำกันมาแสดงใน select
$sql = 'SELECT DISTINCT(country) FROM team';
$result = $mysqli->query($sql);
$mysqli->close();
?>
      <h6 class="text-info mt-5 mb-4">เพิ่มโปรแกรมการแข่งขัน</h6>
      <div class="form-group mt-4">
            <label for="match_date">วันที่</label>
            <input type="date" id="match_date" name="match_date" class="form-control form-control-sm w-auto " required>
      </div>         
      <div class="form-group">
          <label for="country1">ทีมที่ 1 (หรือ ทีมเหย้า)</label><br>
            <select id="country1" name="country1" class="custom-select custom-select-sm w-auto">
            <?php
            while (list($t) = $result->fetch_row()) {
                  $t = $t;
                  echo "<option value=\"$t\">$t</option>";
            }
            ?>
            </select>                   
            <select id="team1" name="team1" class="custom-select custom-select-sm w-auto">
            </select>
      </div>
      <div class="form-group">
          <label for="country2">ทีมที่ 2 (หรือ ทีมเยือน) </label><br>
            <select id="country2" name="country2" class="custom-select custom-select-sm w-auto">
            <?php
                  $result->data_seek(0);
                  while (list($t) = $result->fetch_row()) {
                        echo "<option value=\"$t\">$t</option>";
                  }
            ?>
            </select>                   
            <select id="team2" name="team2" class="custom-select custom-select-sm w-auto">
            </select>                   
      </div>

      <button type="button" id="ok" class="btn btn-primary btn-sm d-block mt-5  mx-auto px-5">ตกลง</button>    

      <br><br><br><br><br>       
</form>

<?php require 'footer.php'; ?>    
</body>
</html>