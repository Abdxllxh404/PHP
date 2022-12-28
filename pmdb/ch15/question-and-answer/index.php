<!DOCTYPE html>
<html>
<head>
    <?php require 'head.php'; ?>
      <style>
            div.card {
                  max-width: 200px;
                  min-width: 150px;
                  
            }
            div.card img {
                  max-width: 120px;
                  max-height: 120px;
            }
      </style>
</head>
<body class="pt-5 px-3">
<?php require 'navbar.php'; ?>
    
<div class="card-deck mt-5 justify-content-center">
 <?php      
      require 'lib/pagination-v2.class.php';
      $page = new PaginationV2();
      $mysqli = new mysqli('localhost', 'root', '', 'pmdb_question_answer');
      $sql = 'SELECT * FROM product';
      $result = $page->query($mysqli, $sql, 15);

      while ($p = $result->fetch_object()) {
            $n = $p->name;
            if (strlen($n) > 20) {
                  $n = mb_substr($n, 0, 20) . '...';        //ถ้าชื่อสินค้ายาวเกินไป ตัดเอา 20 ตัวแรก
            }   
            echo <<<HTML
            <div class="card border border-info mb-4 shadow">
                  <div class="card-body d-flex flex-column justify-content-between p-2">
                        <a href="product-detail.php?id=$p->id" class="mb-4">
                              <img class="card-img-top d-block mt-2 mx-auto" src="product-images/$p->img_file">
                         </a>       
                        <h6 class="card-title text-success text-center">$n</h6>
                  </div>
            </div>
            HTML;
      }            
      
      $mysqli->close();
?>
</div>
<br>
<?php
      if ($page->total_pages() > 1) {     //ถ้ามีมากกว่า 1 ให้แสดงหมายเลขเพจ
            $page->echo_pagenums_bootstrap(); 
      }
?>    
<br><br><br><br>
<?php require 'footer.php'; ?>    
</body>
</html>
