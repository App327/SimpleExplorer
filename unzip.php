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

$ep = '';

if (isset($_GET["ep"])) {
 if ($_GET["ep"] != '') {
  $ep = $_GET["ep"];
 } else {
  $ep = __DIR__;
 }
} else {
 $ep = __DIR__;
}
echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8" />
  <title>Распаковка ZIP/RAR-архива | SimpleExplorer v1.2</title>
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
  <p><a href="/zip.php?p='.urlencode($path).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <h3>Распаковка ZIP/RAR-архива</h3>
';
$mime = mime_content_type($path);

if ($mime == 'application/zip' || $mime == 'application/java-archive') {
 $zip = new ZipArchive;
 if (!$zip) {
  echo '  <p>Для работы с ZIP-архивами требуется PHP-расширение <b><a href="https://www.php.net/manual/ru/book.zip.php">ZipArchive</a></b>.</p>
  </body>
 </html>';
  exit();
 }

 $zip->open($path);
 
 $j = 0;
 $list = [];
 while($name = $zip->getNameIndex($j)) {
  $list[$j] = $name;
  $j++;
 }

 $zip->extractTo($ep);
  
 $zip->close();

 echo '  <p>✓ Содержимое архива успешно извлечено в папку «'.$ep.'».</p>
  <textarea readonly style="width: 90%; height: 200px;">';

 for ($i = 0; $i < $j; $i++) {
  echo $list[$i].'
';
 }

 echo '  </textarea>';
} else if ($mime == 'application/vnd.rar' || 'application/x-rar' || 'application/rar') {
 if (!class_exists('RarArchive')) {
  echo '  <p>Для работы с RAR-архивами требуется PHP-расширение <b><a href="https://www.php.net/manual/ru/book.rar.php" target="_blank">RarArchive</a></b>.</p>
  </body>
 </html>';
  exit();
 }

 $rar = new RarArchive();

 echo '  <p>Полная поддержка RAR-архивов будет добавлена в следующем обновлении!</p>
';
} else {
 echo '  <p>Этот тип файла не поддерживается средством просмотра архивов. <a href="/file.php?f='.urlencode($path).'">Открыть в стандартном просмотрщике</a>.</p>
';
}

echo '
 </body>
</html>';

?>