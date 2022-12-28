<!DOCTYPE html>
<html>
<head>
      <?php require 'head.php'; ?>
       <style>
            html, body {
                  width: 100%;
                  height: 100%
            }
      </style>
      <script>
      $(function() {
            $('#add').click(function() {
                  if ($('input[name="qualifications[]"]').length < 10) {
                        var input = $('input[name="qualifications[]"]:last').clone();
                        input.val('');
                        $('input[name="qualifications[]"]:last').after(input);
                  }
            });
            
            $('#add').click();
            
            $('#delete').click(function() {
                  if ($('input[name="qualifications[]"]').length > 1) {
                        $('input[name="qualifications[]"]:last').remove();
                  }
            });
      });
      </script>
</head>
<body>
<?php require 'navbar.php'; ?>

<div class="jumbotron py-4 px-5">
      <h3>Bootstrap Framework</h3>
      <p class="text-success">
              Bootstrap เป็น CSS Framework ถูกสร้างขึ้นในปี ค.ศ. 2011 โดย Mark Otto และ Jacob Thornton ขณะที่ทั้งคู่ยังทำงานอยู่กับ Twitter
              ซึ่งตอนแรกนั้นอยู่ภายใต้โปรเจ็กต์ที่ชื่อ Twitter Blueprint แต่ต่อมาภายหลังได้เปลี่ยนชื่อเป็น Bootstrap
      </p>
      <hr>
      <p>แนวทางการใช้งานหลักๆ ก็คือ นำ CSS Class ของ Bootstrap มากำหนดให้แก่แอตทริบิวต์ class ของ HTML</p>
      <a href="#" class="btn btn-primary px-4" role="button">รายละเอียดทั้งหมด</a>
</div>    
    
<?php require 'footer.php'; ?>
</body>
</html>
