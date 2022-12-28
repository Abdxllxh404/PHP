<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
      <style>
            div#main-container {
                max-width: 1000px;
            }
            div.card {
                  min-width: 130px;
                  max-width: 150px;
            }       
            div.card img {
                  max-width: 100px;
                  max-height: 100px;
            }           
            div.card * {
                  font-size: 0.9rem;
            }          
            hr {
                  width: 93%;
                  background: #eee;
                  margin-top: 30px;
            }
      </style>
      <script>
      $(function() {

      });
      </script>
</head>
<body class="px-3 pt-5">
<?php require 'navbar.php'; ?> 
    
<div id="main-container" class="mx-auto">
<div class="card-deck mx-4 mt-5 justify-content-center">
<?php
require 'lib/pagination-v2.class.php';
$page = new PaginationV2();

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_simple_store');
$sql = 'SELECT * FROM product';
$result = $page->query($mysqli, $sql, 10);

while ($p = $result->fetch_object()) {
      $n = $p->name;
      if (strlen($n) > 20) {
            $n = mb_substr($n, 0, 20) . '...';
      }
      $images = explode(',', $p->img_files);
      $src = "product-images/$p->id/{$images[0]}";
      $prc = number_format($p->price);

      echo <<<HTML
      <div class="card border border-info pt-2 shadow mb-3">
            <img class="card-img-top d-block mt-1 mx-auto" src="$src">
            <div class="card-body d-flex flex-column justify-content-between">
                  <h6 class="card-title text-success">$n</h6>
                  <div class="d-flex justify-content-between mt-2">
                        <span class="mt-2">฿$prc</span>
                        <a class="btn btn-info btn-sm p-1" href="product-detail.php?id=$p->id">
                              <i class="fa fa-search-plus"></i></a>
                  </div>
            </div>
      </div>
      HTML;
}

$mysqli->close();
?>
</div>  <!-- card -->
<br>

<?php 
 if ($page->total_pages() > 1) {
      $page->echo_pagenums_bootstrap(); 
 }

include 'recently-viewed.php';
?>

</div>  <!-- main-container -->
<br><br><br><br>
<?php require 'footer.php'; ?>     
</body>
</html>
