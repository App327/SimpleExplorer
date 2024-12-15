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

if (isset($_GET["p"])) {
 if ($_GET["p"] != '') {
  $path = $_GET["p"];
 } else {
  $path = __DIR__;
 }
} else {
 $path = __DIR__;
}
echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8" />
  <title>Создание папки | SimpleExplorer v1.2</title>
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
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.2</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.2%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <p><a href="/?path='.urlencode($path).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <h3>Создание папки</h3>
  <form action="/newfolder_save.php">
   <input type="hidden" name="p" value="'.$path.'" />
   <input type="text" name="fn" placeholder="Название папки" title="Название папки" required style="width: calc(95% - 20px); padding: 10px;" />
   <br /><br />
   <input type="submit" value="Создать" style="padding: 10px;" />
  </form>

 </body>
</html>';

?>