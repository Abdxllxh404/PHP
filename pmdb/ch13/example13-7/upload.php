<?php
if (isset($_FILES['upfile'])) {      //ถ้ามีอินพุท file ส่งเข้ามา   
      echo <<<HTML
            <table class="table table-sm table-striped table-bordered mt-4">
            <caption>ข้อมูลของไฟล์ที่อัปโหลด</caption>
            <thead class="thead-dark">
                  <tr><th>ข้อมูล</th><th>ค่า</th></tr>
            </thead>
            <tbody>
                  <tr><td>name</td><td>{$_FILES['upfile']['name']}</td></tr>
                  <tr><td>type</td><td>{$_FILES['upfile']['type']}</td></tr>
                  <tr><td>size</td><td>{$_FILES['upfile']['size']}</td></tr>
            </tbody>
            </table>
      HTML;
}
?>
