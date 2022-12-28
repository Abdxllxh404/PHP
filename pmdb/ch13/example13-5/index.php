<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 14-5</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <link href="../../js/touch-spin/touch-spin.min.css" rel="stylesheet"> 
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/touch-spin/touch-spin.min.js"></script>
      <style>
          .card {
               min-width: 200px;
               max-width: 200px;
          }
          .card-body > * {
                max-width: 150px;
          }
      </style>
      <script>
      $(function() {      
            $('.spin').touchSpin({ 
                  min: 1, 
                  max: 10, 
                  initval: 1,
                  buttondown_class: 'btn btn-success',
                  buttonup_class: 'btn btn-success'	
            });
            
            $('.spin').keypress(function(event) {
                  event.preventDefault();
            });

            $('.card-body > button').click(function(event) {
                  var id = $(event.target).attr('data-id');
                  //อ่านจำนวนจากอิลิเมนต์ชนิด text ที่อยู่ก่อนปุ่มที่ถูกคลิก
                  var q = $(this).prev().children('.spin').val();                  
                  $.ajax({
                        url: 'cart.php', 
                        data: {'id': id, 'q': q},
                        type: 'post',
                        dataType: 'json',
                        success: callback
                  });
            });
      });

      function callback(result) {       
            var t = '<ul>';
            //ลักษณะข้อมูล json ที่ส่งกลับมาจะอยู่ในรูปแบบ รหัสสินค้า:จำนวนที่ซื้อ เช่น {p1:2, p4:1}
            //ในการแสดงผลเราจะตัดเอาตัวเลขที่อยู่ถัดจากตัว "p" ซึ่งเป็นตำแหน่งที่ 1 เป็นต้นไปจนสิ้นสุดสตริง
            //จากนั้นนำไปต่อท้ายคำว่า "สินค้า" เพื่อให้รู้ว่าหยิบสินค้าชนิดใด แล้วตามด้วยจำนวนที่หยิบ
            for(var p in result){
                  var x = p.substring(1);		
                  t += '<li>สินค้าชนิดที่ #' + x + ' (' + result[p] + ')</li>';
            }
            t += '</ul>';
            $('#list').html(t);
      }
      </script>
</head>
<body class="p-3">    
      <div class="card-deck">
      <?php
      for($i = 1; $i <= 4; $i++){
            echo <<< HTML
            <div class="card border-primary mt-sm-3">
                  <h6 class="card-header border-primary">สินค้าชนิดที่ #$i</h6>
                  <span class="p-2">Lorem ipsum dolor sit amet, consectetur ...</span>
                  <div class="card-body text-center">
                       <input type="text" class="spin">
                       <button data-id="p$i" class="btn btn-primary btn-sm mt-3">หยิบใส่รถเข็น</button>                             
                  </div>
            </div>
            HTML;
      }
      ?>
      </div>
    
      <div id="cart" class="mt-3">
            <h6>รายการสินค้าในรถเข็น</h6>
            <div id="list"></div>
      </div>
    
</body>
</html>
