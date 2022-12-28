<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" description="IE=edge">
      <meta name="viewport" description="width=device-width, initial-scale=1">
      <title>Example 11-1</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/popper.min.js"></script>
      <script src="../../js/bootstrap.min.js"> </script>
      <style>
          body {
                background: azure;
          }
          form {
                max-width: 300px;
          }
      </style>
</head>
<body class="p-3">
<?php
if (isset($_POST['q'])) {
      if ($_POST['target'] == 'google') {
            $google = 'https://www.google.com/search?q=';
            $google .= urlencode($_POST['q']);
            header("location: $google");
            exit;
      }
}
?>
<form method="post" target="_blank" class="mt-3 mx-auto">
      <div class="input-group input-group-sm mb-3">
            <input type="text" name="q" class="form-control" placeholder="Search">
            <div class="input-group-append">
                  <button class="btn btn-success" type="submit">OK</button> 
            </div>
      </div>
      <input type="radio" name="target" value="google" checked> Google
      <input type="radio" name="target" value="site" class="ml-4"> This Site  
</form>
</body>
</html>
