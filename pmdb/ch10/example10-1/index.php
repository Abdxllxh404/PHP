<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 10-1</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"> </script>
      <style>
          table {
                max-width: 400px;
          }
      </style>
</head>
<body class="p-4">
<?php
include '../../lib/pagination-v2.class.php';
$page = new PaginationV2();     
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch10');

$sql = 'SELECT * FROM pagination';
$result = $page->query($mysqli, $sql, 5);

echo <<<HTML
<table class="table table-sm table-striped table-hover mx-auto">
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

echo '<div class="mt-4 text-center">';
      $page->prevnext_text('หน้าที่แล้ว', 'หน้าถัดไป');
      $page->echo_prevnext(true, true);
echo '</div>';

$mysqli->close();
?>
</body>
</html>

