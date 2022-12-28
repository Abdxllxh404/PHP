<?php
include 'check-signin.php';

$id = $_GET['id'] ?? 0;
$file_name = "$id.pdf";
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"$file_name\"");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");

@readfile("resume/$file_name");
?>
