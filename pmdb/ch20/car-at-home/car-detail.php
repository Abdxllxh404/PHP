<?php
/* กรณีที่ใช้ Unite Gallery ควรเริ่มต้น session ที่ตอนต้นของเพจ */
@session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <link href="js/unite-gallery/css/unite-gallery.css" rel="stylesheet">
      <link href="js/unite-gallery/themes/compact/ug-theme-compact.css" rel="stylesheet">
      <script src="js/unite-gallery/themes/compact/ug-theme-compact.js"></script>
      <script src="js/unite-gallery/js/unitegallery.min.js"></script>
      <style>          
            div#main-container {
                max-width: 680px;
                min-width: 400px;
            }

            div#main-container *:not(h6) {
                font-size: 0.87rem !important;
            }
          
            img.product {
                max-width: 100px;
                max-height: 100px;
                cursor: pointer;
            }   
            
            #pro-detail {
                  background: lavender;
            }
            
            td:nth-child(even), span.seller-info {
                  font-weight: normal;
                  color: seagreen;
            }
            
            span.seller-title {
                  display: inline-block;
                  width: 115px;
            }
      </style>

      <script>
      $(function() {               
            $("#unite-gallery").unitegallery({
                    gallery_width: 600,	
                    gallery_height: 450
            });
            
            $('button.delete').click(function() {
                  if (confirm('ยืนยันการลบประกาศ')) {
                         $('#form-delete').submit();
                  }
            });
      });  
      </script>
</head>
<body class="px-3 pt-5 pt-md-4">      
<?php require 'navbar.php'; ?> 

<div id="main-container" class="mt-5 pt-5 mx-auto">
<?php
$car_id = $_GET['id'] ?? 0;

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');

if (isset($_POST['delete_id'])) {
      $car_id = $_POST['delete_id'];
      $sql = "DELETE FROM car_advert WHERE id = $car_id";
      $mysqli->query($sql);
      //ลบภาพรถออกจากโฟลเดอร์โดยใช้ไลบรารี DeleteDir
      require 'lib/delete-dir.class.php';
      $dir = "car-images/$car_id";
      DeleteDir::delete($dir);
      echo '<h6 class="text-danger">ข้อมูลถูกลบแล้ว</h6>';
      goto end_page;
}

$sql = "SELECT * FROM car_advert WHERE id = $car_id";
$result = $mysqli->query($sql);

if ($mysqli->error || $result->num_rows == 0) {
      goto end_page;
}

$car = $result->fetch_object();
$car_title = "$car->brand_name $car->model ($car->year)";
echo '<div id="unite-gallery" style="display: none">';

$img_files = explode(',', $car->img_files);
foreach ($img_files as $img) {
      $src = "car-images/$car_id/$img";
      echo "<img src=\"$src\" data-image=\"$src\">";
}
echo '</div>';

$e = number_format($car->engine);
$p = number_format($car->price);
echo <<<HTML
<h6 class="text-primary my-3">$car_title</h6>
<p class="my-3">$car->advert_text</p>
<p class="text-danger my-4">ราคา: $p บาท</p>

<table class="table table-striped table-sm border">
<thead class="thead-dark">
      <tr><th colspan="4">ข้อมูลเบื้องต้นเกี่ยวกับรถ</th></tr>
</thead>
<tbody>
<tr>
      <td>ยี่ห้อ:</td><td>$car->brand_name</td>
      <td>รุ่น:</td><td>$car->model</td>
</tr>
<tr>
      <td>ปี:</td><td>$car->year</td>
      <td>สี:</td><td>$car->color</td>
</tr>
<tr>
      <td>เครื่องยนต์:</td><td>$e</td>
      <td>เกียร์:</td><td>$car->transmission</td>
</tr>
<tr>
      <td>ออปชั่นอื่นๆ:</td><td colspan="3">$car->more_options</td>
</tr>
</tbody>
</table>
HTML;
//แสดงข้อมูลของผู้ประกาศ
$sql = "SELECT * FROM member WHERE id = $car->seller_id";
$result = $mysqli->query($sql);
$seller = $result->fetch_object();
echo <<<HTML
<h6 class="text-info mt-4">ข้อมูลผู้ขาย</h6>
<p>
      <span class="seller-title">ผู้ประกาศ:</span><span class="seller-info">$seller->firstname $seller->lastname</span><br>
      <span class="seller-title">โทร:</span><span class="seller-info">$seller->phone</span><br>
      <span class="seller-title">จังหวัด:</span><span class="seller-info">$seller->province</span>
</p>
HTML;
//แสดงฟอร์มสำหรับการลบประกาศ
if ((isset($_SESSION['member_id']) && ($_SESSION['member_id'] == $car->seller_id)) || isset($_SESSION['admin'])) {
      echo <<<HTML
      <form id="form-delete" method="post">
            <input type="hidden" name="delete_id" value="<?= $car->id ?>">
            <button type="button" class="delete btn btn-danger btn-sm px-5 mt-5 d-block mx-auto">ลบประกาศนี้</button>
      </form>
      HTML;
}

end_page:
$mysqli->close();
?>
</div> <!-- end main-container -->
    
<?php require 'footer.php'; ?>
</body>
</html>