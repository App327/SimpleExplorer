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
  $path = __DIR__.'/index.php';
 }
} else {
 $path = __DIR__.'/index.php';
}
echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8" />
  <title>ZIP-архив | SimpleExplorer v1.1</title>
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
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.1</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.1%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <p><a href="/file.php?f='.urlencode($path).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <h3>ZIP-архив</h3>
  <p>[<a href="/unzip_folder.php?f='.urlencode($path).'">Распаковать архив</a>]</p>
';

if (!class_exists('ZipArchive')) {
 echo '  <p>Для работы с ZIP-архивами требуется PHP-расширение <b><a href="https://www.php.net/manual/ru/book.zip.php" target="_blank">ZipArchive</a></b>.</p>
 </body>
</html>';
 exit();
}

$zip = new ZipArchive();

$zip->open($path);
 
$j = 0;
$list = [];
while($name = $zip->getNameIndex($j)) {
	$list[$j] = $name;
	$j++;
}
  
$zip->close();

echo '  <ul>';

for ($i = 0; $i < $j; $i++) {
 echo '   <li>'.$list[$i].'</li>
';
}

echo '  </ul>';

echo '
 </body>
</html>';

?>