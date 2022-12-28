<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 5-4</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
          body {
                background: azure;
          }
          
          * {
                font-size: 0.9rem;
          }
          
          label {
                font:  1rem bold !important;
          }
          
          form {
                max-width: 350px;
          }
      </style>
</head>
<body class="px-4 pt-3">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      echo '<label>ที่อยู่:</label><br>';
      foreach ($_POST['addr'] as $address) {
            echo $address . '<br>';
      }
      //เนื่องจากข้อมูลอยู่ในรูปแบบอาร์เรย์ จึงสามารถรวมเป็นสตริงเดียวกันได้ด้วย implode()
      if (isset($_POST['hb'])) {
            $hobby = implode(', ', $_POST['hb']);  //คั่นด้วย ', '
            echo "<br><label>งานอดิเรก:</label> $hobby";
            
      }
      //ตัวเลือก multiple selection ต้องตรวจสอบก่อน เพราะผู้ใช้อาจไม่เลือกรายการใดเลยก็ได้
      if (isset($_POST['pet'])) {
            $pets = implode(', ', $_POST['pet']);  //คั่นด้วย ', '
            echo "<br><br><label>สัตว์เลี้ยงที่ชอบ:</label> $pets";
      }
      
      goto end_page;	//หลังแสดงผล แล้วหยุดการทำงานของเพจ (ไม่แสดงฟอร์มอีก)
}
?>
<form method="post" class="mx-auto">
      <label>ที่อยู่:</label>
      <input type="text" name="addr[]" class="form-control form-control-sm mb-2" placeholder="บรรทัดที่ 1">
      <input type="text" name="addr[]" class="form-control form-control-sm mb-2" placeholder="บรรทัดที่ 2">
     <input type="text" name="addr[]" class="form-control form-control-sm mb-2" placeholder="บรรทัดที่ 3">

      <label class="mt-3 mr-4">งานอดิเรก:</label>
      <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" name="hb[]" id="c1" class="custom-control-input" value="ดูหนัง">
            <label class="custom-control-label" for="c1">ดูหนัง</label>
      </div>
      <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" name="hb[]" id="c2" class="custom-control-input" value="ฟังเพลง">
            <label class="custom-control-label" for="c2">ฟังเพลง</label>
      </div>
      <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" name="hb[]" id="c3" class="custom-control-input" value="นอน">
            <label class="custom-control-label" for="c3">นอน</label>
      </div>    
      <br>
      <label class="mt-3">สัตว์เลี้ยงที่ชอบ:</label>
      <select name="pet[]" class="form-control" multiple>
            <option value="สุนัข">สุนัข</option>
            <option value="แมว">แมว</option>
            <option value="ปลา">ปลา</option>
            <option value="นก">นก</option>
      </select>
      
      <button class="btn btn-primary btn-sm d-block px-4 mx-auto mt-4">ส่งข้อมูล</button>
</form>
    
<?php end_page: ?>
</body>
</html>

