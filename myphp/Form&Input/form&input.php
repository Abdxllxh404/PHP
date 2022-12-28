<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form&Input</title>
</head>

<body>
        <form action="wellcome.php" method="post">
        Name: <input type ="text"   name="name"><br>
        Email: <input type="text"   name="email"><br>
        <input  type="submit">
        <!-- //!เมื่อผู้ใช้กดปุ่มSubmitข้อมูลจะถูกส่งไปยัง wellcome.php-ด้วยวิธีHTTP-POST -->
        </form>
</body>

</html>