<?php
if (!isset($_POST['country'])) {
      exit;
}

$c = $_POST['country']; 
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');
$sql = "SELECT name FROM team WHERE country = '$c'";
$result = $mysqli->query($sql);

$options = '';
while (list($t) = $result->fetch_row()) {
      $options .= "<option value=\"$t\">$t</option>";
}
echo $options;
$mysqli->close();
?>
