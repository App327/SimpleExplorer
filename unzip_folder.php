<?php

function convert_bytes($size) { // https://snipp.ru/php/converting-bytes
	$i = 0;
	while (floor($size / 1024) > 0) {
		++$i;
		$size /= 1024;
	}
 
	$size = str_replace('.', ',', round($size, 1));
	switch ($i) {
		case 0: return $size .= ' Б';
		case 1: return $size .= ' КБ';
		case 2: return $size .= ' МБ';
		case 3: return $size .= ' ГБ';
		case 4: return $size .= ' ТБ';
	}
}

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
echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8" />
  <title>Выбор папки — Распаковка ZIP-архива | SimpleExplorer v1.0</title>
  <meta name="viewport" content="width=device-width,intitial-scale=1.0" />
  <style type="text/css">
body {
 font-family: sans-serif;
}

a {
 color: dodgerblue;
 text-decoration: none;
}
a:active {
 color: royalblue;
}
a:hover {
 text-decoration: underline;
}
  </style>
 </head>
 <body>
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.0</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.0%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <p><a href="/zip.php?p='.urlencode($path).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <h3>Выбор папки | Распаковка ZIP-архива</h3>
  <form action="/unzip.php">
   <p>Введите в поле ниже путь к папке для распаковки.</p>
   <input type="hidden" name="f" value="'.$path.'" />
   <input type="text" name="ep" placeholder="Папка для распаковки" title="Папка для распаковки" value="'.dirname($path).'" required style="width: 95%;" />
   <br /><br />
   <input type="submit" value="Распаковать" />
  </form>

 </body>
</html>';

?>