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
  <title>Сохранение — Редактирование файла | SimpleExplorer v1.2</title>
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
  <p><a href="/file.php?f='.urlencode($path).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <h3>Сохранение | Редактирование файла</h3>
';

$mime = mime_content_type($path);

if ($mime == 'text/plain') {
 if (isset($_GET["cnt"])) {
  $old = file_get_contents($path);
  $new = $_GET["cnt"];
  if ($old == $new) {
   echo '  <p>В файле нет изменений для сохранения.</p>
';
  } else {
   file_put_contents($path, $new);
   echo '  <p>Содержимое файла успешно изменено.</p>
  <p>При необходимости, вы можете посмотреть и скопировать введённое вами новое содержимое файла:</p>
';
   $file_cnt = '';
   $fgc = $new;
   $file_cnt = str_replace('<', '&lt;', $fgc);
   $file_cnt = str_replace('>', '&gt;', $file_cnt);
   echo '  <pre style="overflow: auto; width: calc(95% - 20px); padding: 10px; height: 300px; background: rgb(240, 240, 240);">';
   echo $file_cnt;
   echo '</pre>
';
  }
 } else {
  echo '  <p>Требуется GET-параметр <code>cnt</code>, содержащий новое содержимое файла.</p>
';
 }
} else {
 echo '  <p>Изменение файлов пока поддерживается только для файлов формата TXT.</p>
';
}

echo '
  <p><a href="/file.php?f='.urlencode($path).'">Посмотреть текущее содержимое файла</a></p>
  <p><a href="/file_edit.php?f='.urlencode($path).'">Изменить содержимое файла заново</a></p>
 </body>
</html>';

?>