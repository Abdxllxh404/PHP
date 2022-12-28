<?php
$id = $_GET['id'] ?? '';
echo "\$('[data-id=$id]').parent().parent().remove();";
?>
