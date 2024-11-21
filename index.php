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

if (isset($_GET["path"])) {
 if ($_GET["path"] != '') {
  $path = $_GET["path"];
 } else {
  $path = __DIR__;
 }
} else {
 $path = __DIR__;
}

if (isset($_GET["notif"])) {
 if ($_GET["notif"] != '') {
  $notif = $_GET["notif"];
 } else {
  $notif = '';
 }
} else {
 $notif = '';
}

echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8" />
  <title>SimpleExplorer v1.1</title>
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

.f-info {
 user-select: none;
}

.f-info:hover {
 color: dodgerblue;
}

.f-info-i {
 display: none;
}

.f-info-i:hover {
 display: block;
}

.f-info:hover + .f-info-i {
 display: block;
}
  </style>
 </head>
 <body>
'.$notif.'
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.1</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.1%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <form action="/" style="display: flex; align-items: center;">
   <p style="width: 10px;"><a href="/?path='.urlencode(dirname($path)).'">↑</a></p>
   <input id="path" style="width: 90%" type="text" name="path" value="' . $path . '" placeholder="Путь" />
   <input type="submit" value="›" />
  </form>
  <p class="f-info">[ ⓘ ]</p>
  <div style="border: 2px solid orange;" class="f-info-i">
   <p><b>[D]</b> — папка</p>
   <p><b>[F]</b> — файл</p>
   <p><b>[U]</b> — тип неизвестен</p>
  </div>
  <p><b>Занято:</b> ' . convert_bytes(disk_total_space($path) - disk_free_space($path)) . ' / ' . convert_bytes(disk_total_space($path)) . ' (<b>свободно:</b> ' . convert_bytes(disk_free_space($path)) . ')</p>
  <br />
  <p>[<a href="/newfolder.php?p='.$path.'">+ Новая папка</a>]</p>
';

$sd = scandir($path);

if (!$sd) {
 echo '<p>Папка пуста или произошла ошибка.</p>';
 echo '
 </body>
</html>';
 exit();
}

for ($i = 0; $i < count($sd); $i++) {
 $output = '  <p>';
 $p = $path.'/'.$sd[$i];
 $p0 = $sd[$i];
 if (is_dir($p)) {
  $output .= '<b>[D]</b> <a href="/?path='.urlencode($p).'">'.$p0.'</a>';
 } else if (is_file($p)) {
  $output .= '<b>[F]</b> <a href="/file.php?f='.urlencode($p).'">'.$p0.'</a> ('.convert_bytes(filesize($p)).')';
 } else {
  $output .= '<b>[U]</b> '.$p0;
 }
 $output .= '</p>';
 echo $output;
}

echo '
 </body>
</html>';

?>