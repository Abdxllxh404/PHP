<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-4</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <style>
            table { 
                  max-width: 500px; 
            }
            td:nth-child(even) { 
                  text-align: center;
            }
      </style>
      <script>
      $(function() {
            $('button').click(function(event) {
                  var d = 'id=' + $(event.target).attr('data-id');               
                  $.ajax({
                        url: 'delete-table-row.php', 
                        data: d, 
                        type: 'get',
                        dataType: 'script'
                  });
            });
      });
      </script>
</head>
<body class="p-3">
      <table class="table table-sm table-striped table-bordered mt-4 mx-auto">
      <thead class="thead-dark">
            <tr><th>รายการ</th><th>ลบ</th></tr>
      </thead>
      <tbody>
            <tr><td>PHP</td><td><button data-id="p1" class="btn btn-primary">ลบ</button></td></tr>
            <tr><td>MariaDB</td><td><button data-id="p2" class="btn btn-primary">ลบ</button></td></tr>
            <tr><td>Bootstrap</td><td><button data-id="p3" class="btn btn-primary">ลบ</button></td></tr>
            <tr><td>CSS</td><td><button data-id="p4" class="btn btn-primary">ลบ</button></td></tr>
            <tr><td>JavaScript</td><td><button data-id="p5" class="btn btn-primary">ลบ</button></td></tr>
      </tbody>
      </table>
</body>
</html>
