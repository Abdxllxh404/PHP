<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-6</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/loadingoverlay.min.js"></script>
      <script>
      $(function() {      
            $('button').click(function() {
                  $.ajax({
                        url: 'search.php', 
                        type: 'get', 
                        data :$('#kw').serialize(), 
                        timeout: '3000',
                        beforeSend: function() {
                              $.LoadingOverlay('show', {
                                    image: 'clock-loading.gif',
                                    imageAnimation: '',
                                    background: 'rgba(200,200,200,0.6)',
                                    text: 'กำลังค้นหา...',
                                    textColor: 'green',
                                    textResizeFactor: 0.15
                              });
                        },
                        error: (xhr, textStatus) => alert(textStatus),
                        complete: () => $.LoadingOverlay("hide")
                  });
            });
      });
      </script>
</head>
<body class="p-3">
<form>
      <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ค้นหา">
            <div class="input-group-append">
                  <button class="btn btn-success" type="button">ตกลง</button> 
            </div>
      </div>
</form>
</body>
</html>

