<?php
if (!isset($_POST['brand'])) {
      exit;
}

$b = $_POST['brand'];
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_car_at_home');
$sql = "SELECT models FROM car_brand WHERE brand_name = '$b'";
$result = $mysqli->query($sql);

list($m) = $result->fetch_row();
$models = explode(',', $m);
$options = '';
foreach ($models as $md) {
      $m = trim($md);
      $options .= "<option value=\"$m\">$m</option>";
}
echo $options;
$mysqli->close();
?>
