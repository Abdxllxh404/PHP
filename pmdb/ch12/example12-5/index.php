<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 12-5</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
            form {
                  max-width: 400px;
                  margin: auto;
            }
            table {
                  max-width: 500px;
            }
            td > img {
                  width: 60px;
                  cursor: pointer;
            }
      </style>
      <script>
            $(function() {
                  $(':file').change(function() { 
                         var filename = $(this).val().split('\\').slice(-1)[0];
                        $(this).next().after().text(filename);
                  });
                  
                  $('td > img').click(function() {
                        var item = $(this).parent().prev('td').text();
                        $('.modal-title').text(item);
                        var src = $(this).prop('src');
                        $('.modal-body > img').prop('src', src);
                        $('#bsModal').modal();
                  });
            });
      </script>
</head>
<body class="p-4">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'pmdb_ch12');

$image_folder = 'product-images';
@mkdir($image_folder);
$file_names = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //เพิ่มข้อมูลสินค้าลงในตาราง
      $stmt = $mysqli->stmt_init();  
      $sql = 'INSERT INTO product VALUES (?, ?, ?)';
      $stmt->prepare($sql);
      $params = [0, $_POST['pd_name'], ''];   //ชื่อไฟล์ภาพ ให้เป็นสตริงว่างไปก่อน
      $stmt->bind_param('iss', ...$params);
      $stmt->execute();
      $product_id = $stmt->insert_id;     //ค่า id ของแถวล่าสุด
      $stmt->close();
      
      require '../../lib/image-sizing.class.php';
      //เนื่องจากเราอัปโหลดไฟล์แบบ Multiple
      //ดังนั้นต้องใช้ลูปเพื่อจัดการทีละไฟล์
      $count = count($_FILES['upfile']['name']); 
      for ($i = 0; $i < $count; $i++) {
            if ($_FILES['upfile']['error'][$i] > 0) {
                  continue;
            }
            $image = ImageSizing::from_upload('upfile', $i);
            $image->resize_max(400, 400);

            $old_name = $_FILES['upfile']['name'][$i];
            //คัดแยกเอาส่วนขยายของไฟล์ เพื่อนำไปใช้ในการบันทึก
            $ext = pathinfo($old_name, PATHINFO_EXTENSION);
            $n = $i + 1;
            $new_name ="$product_id-$n.$ext";   //เช่น 1-1.png, 1-2.png
            $image->save("$image_folder/$new_name");
            
            $file_names[] = $new_name;
      } 
      
      //แก้ไขไฟล์ภาพในตาราง
      $img_files = implode(',', $file_names);
      $sql = "UPDATE product SET img_files = '$img_files' 
                  WHERE id = $product_id";
      
      $mysqli->query($sql);
}
?>
<form method="post" enctype="multipart/form-data">
      <div class="form-group mt-3">
            <label for="text1">ชื่อสินค้า</label>
            <input type="text" id="text1" name="pd_name" class="form-control form-control-sm" required>
      </div> 
      <div class="mb-2">ภาพสินค้า (1 - 3 ภาพ)</div>
      <div class="custom-file mb-3">
            <input type="file" name="upfile[]" class="custom-file-input" id="file1" accept="image/*">
            <label class="custom-file-label" for="file1">เลือกไฟล์</label>
      </div>
      <div class="custom-file mb-3">
            <input type="file" name="upfile[]" class="custom-file-input" id="file2" accept="image/*">  
            <label class="custom-file-label" for="file2">เลือกไฟล์</label>
      </div>
      <div class="custom-file mb-4">
            <input type="file" name="upfile[]" class="custom-file-input" id="file3" accept="image/*">     
            <label class="custom-file-label" for="file3">เลือกไฟล์</label>
      </div>
      <button class="btn btn-primary btn-sm d-block mx-auto px-4">ตกลง</button>
</form>
    
 <!-- อ่านข้อมูลมาแสดงในตาราง  -->   
<table class="table table-sm table-striped table-bordered mt-4 mx-auto">
<thead class="thead-dark">
      <tr><th>ชื่อสินค้า</th><th>รูปภาพ</th></tr>
</thead>
<tbody>     
<?php     
$sql = 'SELECT * FROM product';
$result = $mysqli->query($sql);
while ($p = $result->fetch_object()) {
      //แยกภาพสินค้าด้วย ", " แล้วนำไปกำหนดให้แก่แท็ก img
      $image_tags = '';
      $files = explode(',', $p->img_files);
      foreach ($files as $f) {
            $image_tags .=<<<HTML
             <img src="$image_folder/$f" class="img-thumbnail">
            HTML;
      }
      echo "<tr><td>$p->name</td><td>$image_tags</tr>";
}

$mysqli->close();
?>         
</tbody>
</table>
    
<!-- Bootstrap Modal Window -->
<div class="modal" id="bsModal">
      <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                  <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button 	class="close" 
                        data-dismiss="modal">&times;</button>
                  </div>
                
                  <div class="modal-body">
                        <img src="">
                  </div>
                
            </div>      <!-- modal-content -->
      </div>            <!-- modal-dialog -->
</div>                  <!-- modal -->

</body>
</html>
