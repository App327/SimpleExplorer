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
  $notif = '<div class="notif"><p class="icon">ⓘ</p><p class="text">'.$_GET["notif"].'</p></div>';
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
  <title>SimpleExplorer v1.2</title>
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

.path-inp {
 border: 1.5px solid dodgerblue;
 border-radius: 0px;
 padding: 5.5px;
 width: calc(100% - 70px);
}

.path-inp:hover {
 border: 1.5px solid royalblue;
}

.path-inp:focus {
 outline: 2px solid skyblue;
}

.path-submit, .path-top {
 background: white;
 border: 1.5px solid dodgerblue;
 padding: 5px;
 user-select: none;
}

.path-submit:hover, .path-top:hover {
 border: 1.5px solid royalblue;
}

.path-submit:focus, .path-top:focus {
 outline: 2px solid skyblue;
}

.path-submit {
 width: 30px;
 height: 30px;
 border-top-left-radius: 0px;
 border-bottom-left-radius: 0px;
 border-top-right-radius: 5px;
 border-bottom-right-radius: 5px;
}

.path-top {
 width: 30px;
 height: 30px;
 border-top-left-radius: 5px;
 border-bottom-left-radius: 5px;
 border-top-right-radius: 0px;
 border-bottom-right-radius: 0px;
}

.notif {
 display: flex;
 align-items: center;
 width: calc(100% - 20px);
 background: rgb(230, 230, 255);
 padding: 0 10px 0 10px;
 border-radius: 10px;
 overflow: auto;
}
.notif .icon {
 color: royalblue;
}
.notif .text {
 margin-left: 10px;
}
  </style>
 </head>
 <body>
'.$notif.'
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.2</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.2%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <div style="width: 100%; display: flex; align-items: center;">
   <button onclick="window.location.href = \'/?path='.urlencode(dirname($path)).'\'" class="path-top">↑</button>
   <form action="/" style="width: calc(100% - 30px); display: flex; align-items: center;">
    <input id="path" style="width: 90%" type="text" name="path" value="' . $path . '" placeholder="Путь" class="path-inp" />
    <input type="submit" value="›" class="path-submit" />
   </form>
  </div>
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