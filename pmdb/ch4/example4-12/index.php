<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Example 4-11</title>
</head>
<body>
<?php
$file = pathinfo(__FILE__, PATHINFO_BASENAME);  //ไฟล์ของเพจนี้ (index.php)
$bytes = filesize($file);

if ($bytes >= 1073741824) {   //1 GB
    $size = $bytes / 1073741824;
    $size = round($size, 2) . ' GB';  //ประมาณทศนิยม 2 ตำแหน่ง
} else if ($bytes >= 1048576) {   //1 MB
    $size = $bytes / 1048576;
    $size = round($size, 2) . ' MB';
} else if ($bytes >= 1024) {   //1 KB
    $size = $bytes / 1024;
    $size = round($size, 2) . ' KB';
} else {
   $size = $bytes . ' Bytes' ;   
}
echo "ไฟล์: $file มีขนาด $size";
?>
</body>
</html>
