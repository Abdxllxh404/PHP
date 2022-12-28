<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 10-2</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"> </script>
      <style>
            table {
                  max-width: 500px;
            }
            table * {
                  font-size: 0.87rem;
            }
            caption {
                  caption-side: top;
                  text-align: center;
            }
      </style>
</head>
<body class="p-3">
<?php
require '../../lib/pagination-v2.class.php';
$page = new PaginationV2();
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch10');

$sql = 'SELECT * FROM pagination';
$result = $page->query($mysqli, $sql, 3);
$start_row = $page->start_row();
$stop_row = $page->stop_row();
$total_page = $page->total_rows();

echo <<<HTML
<table class="table table-sm table-striped table-hover w-75 mx-auto">
<caption>
      ข้อมูลลำดับที่: $start_row  - $stop_row จากทั้งหมด: $total_page
</caption> 
<thead class="thead-dark">
      <tr><th>ID</th><th>Item</th></tr>
</thead>
<tbody>
HTML;

while (list($i, $item) = $result->fetch_row()) {
      echo "<tr><td>$i</td><td>$item</td></tr>";
}

echo 
'</tbody>
</table>';

echo '<div class="mt-4" style="text-align:center">';
if ($page->total_pages() > 1) {
      /*
      $page->link_border('solid', '1px', 'gray');
      $page->link_bg_color('lightblue', 'pink');
      $page->font('14px');
      $page->link_color('blue', 'red');
      $page->prevnext_text('หน้าที่แล้ว', 'หน้าถัดไป');
       $page->echo_pagenums(6, true, false);
       */
      
      $page->echo_pagenums(6, true, false);
      
      //$page->echo_pagenums_bootstrap();
}
echo '</div>';

$mysqli->close();
?>
</body>
</html>

