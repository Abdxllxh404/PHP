<?php
if (!isset($_POST['id'])) {
      exit;
}

$match_id = $_POST['id']; 
$t1_goals = $_POST['t1'];
$t2_goals = $_POST['t2'];

$mysqli = new mysqli('localhost', 'root', '', 'pmdb_score_ball');
$sql = 'UPDATE matches SET team1_goals = ?, team2_goals = ?
             WHERE id = ?';

$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);
$p = [$t1_goals, $t2_goals, $match_id];
$stmt->bind_param('iii', ...$p);
$stmt->execute();
$mysqli->close();
?>
