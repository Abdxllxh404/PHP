<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <link href="js/unite-gallery/css/unite-gallery.css" rel="stylesheet">
      <link href="js/unite-gallery/themes/compact/ug-theme-compact.css" rel="stylesheet">
      <style>            
            div#main-container {
                max-width: 800px;
                min-width: 400px;
            }
      </style>
      <script src="js/unite-gallery/themes/compact/ug-theme-compact.js"></script>
      <script src="js/unite-gallery/js/unitegallery.min.js"></script>
      <script src="js/loadingoverlay.min.js"></script>
      <script>
       //var ug;      
      $(function() {
           var ug = $("#unite-gallery").unitegallery({
                  gallery_width: 400,
                  gallery_height: 300,
                  gallery_autoplay: true,
                  gallery_play_interval: 2000
             
            });   
           //ug.play();       
           ug.on("item_change",function() {	
	ug.resetZoom();			
            });
            
            //เมื่อคลิกปุ่ม "หยิ ug.selectItem(1)บใส่รถเข็น" ให้อ่านค่า id ของสินค้าที่แนบไว้กับแอตทริบิวต์ data-id ของปุ่ม
            //แล้วส่งผ่าน AJAX ไปยังเพจ ajax-add-cart.php 
            $('#add-cart').click(function() {
                  var id = $(this).attr('data-id');
                  $.ajax({
                        url: 'ajax-add-cart.php', 
                        data: {'pro_id': id}, 
                        type: 'post',
                        dataType: 'html',
                        //ในระหว่างที่ส่ง ให้ปิดทีบพื้นหลังด้วย LoadingOverlay
                        beforeSend: () => {
                                $.LoadingOverlay('show', {
                                        image: 'clock-loading.gif',
                                        background: 'rgba(200, 200, 200, 0.6)',
                                        text: 'กำลังดำเนินการ...',
                                        textResizeFactor: 0.15
                                });
                        },
                        error: (xhr, textStatus) => alert(textStatus),
                        success: (result) => {  
                              $.LoadingOverlay("hide");
                              $('#show-alert').html(result);
                              
                              updateCart();     
                              //ฟังก์ชันนี้อยู่ใน header.php เพื่อนับจำนวนสินค้าในรถเข็น
                              //มาแสดงที่ปุ่มรถเข็นบน Navbar
                        }               
                  });       
            });              
      });  
      </script>
</head>
<body class="px-2 pt-5">
<?php require 'navbar.php'; ?>  
    
<div id="main-container" class="mx-auto mt-5">
<div id="show-alert"></div>
<?php
$product_id = $_GET['id'] ?? 0;

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');

$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $mysqli->query($sql);

if ($mysqli->error || $result->num_rows == 0) {
      $mysqli->close();
      echo '<h6 class="text-danger text-center mb-4">ไม่พบข้อมูล</h6>';
      include 'recently-viewed.php';
      include 'footer.php';
      exit ('</div></body></html>');
}

$p = $result->fetch_object();
$img_files = explode(',', $p->img_files);    
$img_tags = ''; 
foreach ($img_files as $img) {
      $src = "product-images/$product_id/$img";
      $img_tags .= "<img src=\"$src\" data-image=\"$src\">";
}                

$r = ($p->remain > 0) ? 'มีสินค้า' : '<span class="text-danger">สินค้าหมด</span>';
$cart_class = ($p->remain > 0) ? 'btn-primary' : 'btn-secondary disabled';
$price = number_format($p->price);
echo <<<HTML
<div class="container"> <!-- grid -->
<div class="row">
<div class="col-12 col-md-6 mt-3">
      <div id="unite-gallery" style="display: none">
            $img_tags
      </div>
</div>
<div class="col-12 col-md-6 d-flex flex-column justify-content-between">
      <div>
            <h6 class="text-success my-3">$p->name</h6>
            <p>ราคา: $price บาท</p>
            $r
      </div>
      <div class="mt-2 mt-md-0">
            <a href="#" id="add-cart" class="btn btn-sm $cart_class mb-2" data-id="$p->id">
                  <i class="fa fa-cart-plus mr-1"></i> หยิบใส่รถเข็น
            </a><br>
            <a href="#" id="wishlist" class="btn btn-sm btn-info">
                  <i class="fa fa-heart mr-1"></i> รายการที่ชอบ
            </a>
      </div>
</div>                 
</div>     <!-- /row -->

<div class="row mt-2 mt-md-4">
      <div class="col-12">$p->detail</div>
</div>

</div>     <!-- /container -->            
HTML;

//จัดเก็บข้อมูลบางอย่างของสินค้ารายการนี้สำหรับแสดง Recently Viewed
//โดยสิ่งที่จะเก็บประกอบด้วยตำแหน่งภาพสินค้า (ใช้ภาพแรก) และชื่อ (15 ตัวแรก)
//แล้วสร้างเป็นลิงก์ แล้วเก็บไว้ในเซสชัน 
$url = $_SERVER['PHP_SELF'] .  '?' . $_SERVER['QUERY_STRING'];
$img_src = $img_files[0];
$n = mb_substr($p->name, 0, 15);
$link =<<<LINK
<div>       
<a href="$url">
      <img src="product-images/$product_id/$img_src" style="max-width:60px;max-height:60px">
</a>
</div>
<div class="text-info mt-2 small">$n</div>
LINK;
//ตรวจสอบว่าได้สร้างเซสชันสำหรับเก็บข้อมูลหรือยัง
//ถ้ายัง ให้สร้างในแบบอาร์เรย์ว่างขึ้นมาก่อน
if (!isset($_SESSION['recently_viewed'])) {
      $_SESSION['recently_viewed'] = [];
}
//ต้องตรวจสอบว่า ได้เก็บลิงก์ของสินค้าชนิดนี้ไว้ในเซสชันหรือยัง
//เพื่อป้องกันการเก็บข้อมูลซ้ำซ้อนกัน 
//ถ้ายัง ก็เพิ่มลงไปให้เป็นรายการแรกของอาร์เรย์ 
if (!in_array($link, $_SESSION['recently_viewed'])) {
array_unshift($_SESSION['recently_viewed'], $link);
}
//นำรายการที่เคยเปิดดูมาแสดง
include 'recently-viewed.php';
$mysqli->close()
?>
</div>
    
<br><br><br><br>
<?php require 'footer.php'; ?> 
</body>
</html>