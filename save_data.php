 <?php
$txt = $_POST["json"];
$filename="data/".uniqid("pfaender").".json";
file_put_contents($filename, $txt);
chmod($filename, 0640)
?> 