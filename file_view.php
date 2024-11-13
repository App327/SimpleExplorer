<?php

$path = '';

if (isset($_GET["f"])) {
 if ($_GET["f"] != '') {
  $path = $_GET["f"];
 } else {
  $path = __DIR__.'/index.php';
 }
} else {
 $path = __DIR__.'/index.php';
}

$mime = mime_content_type($path);

header('HTTP/1.1 200 OK');
header('Content-Type: '.$mime);

readfile($path);

?>