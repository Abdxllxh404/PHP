<!doctype html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Example 13-7</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"> </script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/jquery.form.js"></script>
      <style>
            html, body { height: 100%; }
            form, table {
                  max-width: 500px;
                  margin: auto;
            }
            caption {
                  caption-side: top;
                  text-align: center;
            }
      </style>
      <script>
      $(function() {
             $(':file').change(function() { 
                   var filename = $(this).val().split('\\').slice(-1)[0];
                  $(this).next().after().text(filename);
                  
                  $('.progress-bar').css('width', '0');
            });      

            $('form').ajaxForm({
                  url: 'upload.php',
                  type: 'post',
                  dataType: 'html', 
                  beforeSend: () => { },
                  uploadProgress: (ev, pos, total, percent) => {
                        $('.progress-bar').css('width', percent + '%');
                        $('.progress-bar').text(percent + '%');
                        $('button[type="submit"]').prop("disabled", true);
                  },
                  success: (result) => {
                        $('#display').html(result);
                        $('button[type="submit"]').prop("disabled", false);
                  },
                  error: (xhr, textStatus) => alert(textStatus)
            });

      });
      </script>
</head>
<body class="p-3">
<form method="post" enctype="multipart/form-data">
      <div class="custom-file">
            <input type="file" name="upfile" class="custom-file-input" id="file1">
            <label class="custom-file-label" for="file1">กรุณาเลือกไฟล์</label>
      </div>
      <div class="progress m-3">
            <div  class="progress-bar bg-info progress-bar-striped"></div>
      </div>
    <button type="submit" class="btn btn-primary btn-sm d-block mx-auto px-4">Upload</button>
</form>

<div id="display"></div>
</body>
</html>

