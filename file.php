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
  <title>Файл | SimpleExplorer v1.2</title>
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
  <p><a href="/?path='.urlencode(dirname($path)).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <p>[<a href="/file_view.php?f='.urlencode($path).'" download>Скачать файл</a> | <a href="/file_view.php?f='.urlencode($path).'">Исходное содержимое</a>]</p>
  <h3>Просмотр файла</h3>
';

$mime = mime_content_type($path);

if (filesize($path) == '0') {
 echo '<p>Файл пуст.</p>
';
} else if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/jpeg' || $mime == 'image/gif' || $mime == 'image/vnd.microsoft.icon' || $mime == 'image/webp' || $mime == 'image/tiff' || $mime == 'image/bmp') {
 echo '  <img src="/file_view.php?f='.urlencode($path).'" alt="Файл" width="90%" />
';
} else if ($mime == 'video/mpeg' || $mime == 'video/mp4' || $mime == 'video/webm' || $mime == 'video/quicktime' || $mime == 'video/x-quicktime' || $mime == 'video/x-msvideo' || $mime == 'video/msvideo') {
 echo '  <video src="/file_view.php?f='.urlencode($path).'" width="90%" controls>Воспроизведение видео не поддерживается в этом браузере.</video>
';
} else if ($mime == 'audio/mpeg' || $mime == 'audio/x-hx-aac-adts' || $mime == 'audio/mp4' || $mime == 'audio/vnd.wave' || $mime == 'audio/x-wav' || $mime == 'audio/ogg' || $mime == 'audio/opus' || $mime == 'audio/x-m4a' || $mime == 'audio/m4a') {
 echo '  <audio src="/file_view.php?f='.urlencode($path).'" width="90%" controls>Воспроизведение аудио не поддерживается в этом браузере.</audio>
';
} else if ($mime == 'text/plain' || $mime == 'application/xml' || $mime == 'text/xml' || $mime == 'text/x-msdos-batch' || $mime == 'text/msdos-batch' || $mime == 'application/bat' || $mime == 'application/x-bat' || $mime == 'text/css' || $mime == 'text/javascript' || $mime == 'application/json' || $mime == 'text/x-php' || $mime == 'text/php' || $mime == 'application/x-httpd-php' || $mime == 'application/x-empty') {
 if ($mime == 'text/plain') {
  echo '  <p>[<a href="/file_edit.php?f='.urlencode($path).'">Изменить</a>]</p>
';
 }
 $file_cnt = '';
 $fgc = file_get_contents($path);
 $file_cnt = str_replace('<', '&lt;', $fgc);
 $file_cnt = str_replace('>', '&gt;', $file_cnt);
 echo '  <pre style="overflow: auto; width: calc(95% - 20px); padding: 10px; height: 300px; background: rgb(240, 240, 240);">';
 echo $file_cnt;
 echo '</pre>
';
} else if ($mime == 'text/html' || $mime == 'image/svg+xml') {
 echo '  <iframe src="/file_view.php?f='.urlencode($path).'" width="95%" height="400px" style="border: 2px solid grey;">Тег <code>iframe</code> не поддерживается в этом браузере.</iframe>
';
} else if ($mime == 'font/sfnt' || $mime == 'font/truetype' || $mime == 'application/vnd.ms-fontobject' || $mime == 'font/opentype' || $mime == 'application/font-woff' || $mime == 'font/woff' || $mime == 'font/woff2' || $mime == 'font/collection') {
 echo '  <style type="text/css">
@font-face {
 font-family: \'Test Font\';
 src: url(\'/file_view.php?f='.urlencode($path).'\');
}

.font-test {
 font-family: \'Test Font\';
 overflow: auto;
}
  </style>
  <div class="font-test">
   <p>Съешь ещё этих мягких французских булок, да выпей же чаю.</p>
   <p>The quick brown fox jumps over the lazy dog.</p>
   <p>АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ</p>
   <p>абвгдеёжзийклмнопрстуфхцчшщъыьэюя</p>
   <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
   <p>abcdefghijklmnopqrstuvwxyz</p>
   <p>1234567890</p>
   <p>.,@#$_&-+()/*"\':;!?~`|•√π÷×§∆£¢€¥^°={}\\%©®™✓[]<>«»‹›¿¡</p>
  </div>
  <noscript><p>JavaScript отключён. Тестирование шрифта работать не будет.</p></noscript>
  <input id="font-test-inp" placeholder="abc123" style="padding: 10px; width: calc(95% - 20px);" />
  <p class="font-test" id="font-test-value">Введите что-нибудь в поле выше</p>
  <script type="text/javascript">
let empty = \'Введите что-нибудь в поле выше\';
let inp = document.getElementById(\'font-test-inp\');
let val = document.getElementById(\'font-test-value\');

function changeFTvalue() { // FT = font test
 let curVal = inp.value;
 if (curVal == \'\') {
  val.innerHTML = empty;
 } else {
  if (curVal.includes(\'my password is\')) { // пасхалка :)
   val.innerHTML = \'\';
   for (let i = 0; i < curVal.length; i++) {
    val.innerHTML += \'•\';
   }
  } else {
   val.innerHTML = curVal;
  }
 }
}

inp.oninput = changeFTvalue;
inp.onfocus = changeFTvalue;
inp.onblur = changeFTvalue;
inp.onchange = changeFTvalue;
  </script>
';
} else if ($mime == 'application/zip' || $mime == 'application/java-archive' || $mime == 'application/vnd.rar' || $mime == 'application/x-rar' || $mime == 'application/rar') {
 echo '  <p><a href="/zip.php?p='.urlencode($path).'">Открыть содержимое архива</a></p>
';
} else if ($mime == 'directory') {
 echo '  <p><a href="/?path='.urlencode($path).'">Посмотреть содержимое папки</a></p>
';
} else if ($mime == 'text/csv' || $mime == 'text/tab-separated-values' || $mime == 'text/rtf' || $mime == 'application/rtf' || $mime == 'application/pdf' || $mime == 'application/x-pdf' || $mime == 'application/x-bzpdf' || $mime == 'application/x-gzpdf') {
 echo '  <p>Этот тип файла пока не поддерживается SimpleExplorer, но его поддержка будет добавлена в ближайших обновлениях SimpleExplorer. Следите за обновлениями!</p>
';
} else {
 echo '  <p>Этот тип файла пока не поддерживается SimpleExplorer.</p>
';
}

echo '
  <hr noshade color="lightgrey" />
  <h4>О файле</h4>
  <p><b>Изменено:</b> '.date('d/m/Y (нед. W), H:i:s', filemtime($path)).'</p>
  <p><b>MIME-тип:</b> <code>'.$mime.'</code></p>
  <p><b>Размер:</b> '.convert_bytes(filesize($path)).'</p>
 </body>
</html>';

?>