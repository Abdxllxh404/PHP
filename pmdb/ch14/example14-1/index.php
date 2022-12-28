<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <title>Example 14-1</title>
</head>
<body style="padding: 20px; text-align: center">
 <?php
require '../../lib/PHPMailer/PHPMailer.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

//$mail->From = 'test@example.com';
//$mail->FromName = 'PHPMailer';
$mail->setFrom('admin@example.com', 'Admin');  
$mail->addAddress('banchar_pa@yahoo.com');  
$mail->Subject = 'ทดสอบการส่งเมลด้วย PHPMailer';
$mail->Body = 'ถ้าท่านได้รับเมลฉบับนี้ แสดงว่าการส่งเมลสำเร็จ';
$mail->WordWrap = 70; 
$mail->CharSet = 'utf-8';   
$mail->isHTML(true);			
//$mail->addAttachment('php-logo.png');

if ($mail->send()) {
      echo 'การส่งเมลสำเร็จ';
} else {
      echo 'การส่งเมลผิดพลาด';
}
?>   
</body>
</html>
