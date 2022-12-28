<?php
session_start();

if (!isset($_SESSION['recently_viewed'])) {
      $_SESSION['recently_viewed'] = [];
}

$page = $_SERVER['PHP_SELF'];

//ค่าของตัวแปร $title จะกำหนดในเพจที่จะนำไฟล์นี้ไปแทรก
$article_link = "<a href=\"$page\">$title</a>";

//ถ้าในเซสชัน ยังไม่เก็บลิงก์ของเพจที่นำไฟล์นี้ไปแทรก ก็ให้เพิ่มลงไป
if (!in_array($article_link, $_SESSION['recently_viewed'])) {
      $_SESSION['recently_viewed'][] = $article_link;
}

//นำลิงก์ของเพจที่เคยเปิดดูซึ่งเก็บในเซสชัน มาแสดงผล  
$text = "";
if (count($_SESSION['recently_viewed']) > 0) {
      foreach ($_SESSION['recently_viewed'] as $a) {
            if ($a != $article_link) {
                  $text .= "<li>$a</li>";
            }
      }
}

if ($text != "") {
      echo "<br><br><p>เพจที่เปิดดูล่าสุด</p>";
      echo "<ul>$text</ul>";          
}
/*
echo '<br><p><a href="index.php">หน้าหลัก</a></p>';
*/
?>

