 <?php
$txt = $_POST["json"];
$filename="data/".uniqid("huashan").".json";
file_put_contents($filename, $txt);
chmod($filename, 0640)
?> 