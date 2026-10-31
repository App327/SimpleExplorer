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
 if ($_GET["f"] !== '') {
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
  <title>Файл | SimpleExplorer v1.3</title>
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
  <h2 style="color: navy; font-weight: 400;">SimpleExplorer <span style="color: dodgerblue">v1.3</span></h2>
  <p>[<a href="https://github.com/App327/SimpleExplorer">GitHub</a> • <a href="https://github.com/App327/SimpleExplorer/issues/new?title=Сообщение+об+ошибке+%5Bv1.3%5D">Сообщить об ошибке</a>]</p>
  <hr noshade color="silver" />
  <p><a href="/?path='.urlencode(dirname($path)).'">‹ Назад</a></p>
  <p>'.$path.'</p>
  <p>[<a href="/file_view.php?f='.urlencode($path).'" download>Скачать файл</a> | <a href="/file_view.php?f='.urlencode($path).'">Исходное содержимое</a>]</p>
  <h3>Просмотр файла</h3>
';

$mime = mime_content_type($path);

$ext0 = pathinfo($path)['extension'];
if (!$ext0) {
 $ext0 = '';
}
$ext = strtolower($ext0);

if (!file_exists($path)) {
 echo '<p>Файл по указанному пути не существует.</p>
';
} else if (!is_readable($path)) {
 echo '<p>Файл по указанному пути недоступен для чтения.</p>
';
} else if (filesize($path) === 0) {
 echo '<p>Файл пуст.</p>
';
} else if ($mime === 'directory') {
 echo '  <p><a href="/?path='.urlencode($path).'">Посмотреть содержимое папки</a></p>
';
} else if ($ext === 'png' || $ext === 'jpg' || $ext === 'jpeg' || $ext === 'gif' || $ext === 'ico' || $ext === 'webp' || $ext === 'tiff' || $ext === 'bmp' || $ext === 'avif' || $ext === 'jpe' || $ext === 'apng' || $ext === 'jfif') {
 echo '  <img src="/file_view.php?f='.urlencode($path).'" alt="Файл" width="90%" />
';
} else if ($ext === 'mp4' || $ext === 'webm' || $ext === 'mov' || $ext === 'movie' || $ext === 'qt' || $ext === 'avi') {
 echo '  <video src="/file_view.php?f='.urlencode($path).'" width="90%" controls>Воспроизведение видео не поддерживается в этом браузере.</video>
';
} else if ($ext === 'mp3' || $ext === 'ogg' || $ext === 'mp2' || $ext === 'wav' || $ext === '3gpp' || $ext === 'opus' || $ext === 'm4a') {
 echo '  <style type="text/css">
audio {
 background: lightskyblue;
 border-radius: 5px;
 box-shadow: 0 2px 10px silver;
 width: calc(100% - 20px);
 margin-left: 10px;
}

audio::-webkit-media-controls-enclosure {
 background: lightskyblue;
}

audio::-webkit-media-controls-play-button {
 background-color: deepskyblue;
 border-radius: 5px;
}

audio::-webkit-media-controls-play-button:active {
 box-shadow: 0 0 7px inset grey;
}
  </style>
  <audio src="/file_view.php?f='.urlencode($path).'" preload="metadata" controls>Воспроизведение аудио не поддерживается в этом браузере.</audio>
';
} else if ($ext === 'txt' || $ext === 'xml' || $ext === 'bat' || $ext === 'cmd' || $ext === 'css' || $ext === 'js' || $ext === 'json' || $ext === 'php' || $ext === 'java' || $ext === 'cpp' || $ext === 'cs' || $ext === 'py' || $ext === '') {
 if ($ext === 'txt') {
  echo '  <p>[<a href="/file_edit.php?f='.urlencode($path).'">Изменить</a>]</p>
';
 }
 $file_cnt = '';
 $fgc = file_get_contents($path);
 $file_cnt = str_replace('<', '&lt;', $fgc);
 $file_cnt = str_replace('>', '&gt;', $file_cnt);
 echo '  <p><label><input type="checkbox" id="wrap-cb" onchange="toggleFileContentWrap()" /> Переносить строки</label></p>
  <pre id="file-cnt-pre" style="overflow: auto; width: calc(95% - 20px); padding: 10px; height: 300px; background: rgb(240, 240, 240);">';
 echo $file_cnt;
 echo '</pre>
  <script type="text/javascript">
function toggleFileContentWrap() {
 let cb = document.getElementById(\'wrap-cb\');
 let pre = document.getElementById(\'file-cnt-pre\');
 if (cb.checked) {
  pre.style.whiteSpace = \'pre-wrap\';
 } else {
  pre.style.whiteSpace = \'pre\';
 }
}
  </script>
';
} else if ($ext === 'html' || $ext === 'htm' || $ext === 'xhtml' || $ext === 'xhtm' || $ext === 'xht' || $ext === 'svg' || $ext === 'mml') {
 echo '  <iframe src="/file_view.php?f='.urlencode($path).'" width="95%" height="400px" style="border: 2px solid grey;">Тег <code>iframe</code> не поддерживается в этом браузере.</iframe>
';
} else if ($ext === 'ttf' || $ext === 'ttc' || $ext === 'eot' || $ext === 'otf' || $ext === 'woff' || $ext === 'woff2' || $ext === 'otc') {
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
 if (curVal === \'\') {
  val.innerHTML = empty;
 } else {
  if (curVal.includes(\'my password is\')) { // пасхалочка :)
   val.innerHTML = \'\';
   for (let i = 0; i < curVal.length; i++) {
    val.innerHTML += \'•\';
   }
  } else if (curVal.includes(\'gold\')) { // пасхалочка №2 :)
   val.innerHTML = \'<span style="color: gold; font-weight: 700; font-size: 1.3rem;">\' + curVal + \'</span>\';
  } else if (curVal.includes(\'silver\')) { // пасхалочка №3 :)
   val.innerHTML = \'<span style="color: silver; font-weight: 700; font-size: 1.3rem;">\' + curVal + \'</span>\';
  } else if (curVal.includes(\'bold\')) {
   val.innerHTML = \'<span style="font-weight: 700;">\' + curVal + \'</span>\';
  } else if (curVal.includes(\'italic\')) {
   val.innerHTML = \'<span style="font-style: italic;">\' + curVal + \'</span>\';
  } else if (curVal.includes(\'underline\')) {
   val.innerHTML = \'<span style="text-decoration: underline;">\' + curVal + \'</span>\';
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
} else if ($ext === 'zip' || $ext === 'jar' || $ext === 'rar') {
 echo '  <p><a href="/zip.php?p='.urlencode($path).'">Открыть содержимое архива</a></p>
';
} else if ($ext === 'csv' || $ext === 'tsv') {
 echo '  <div style="width: calc(100% - 20px); margin-left: 10px; overflow: auto;">
   <table border="1" bordercolor="grey" cellpadding="10" cellspacing="0">
    <tbody>
';
 $sep = '';
 if ($ext === 'csv') {
  $sep = ',';
 } else if ($ext === 'tsv') {
  $sep = '\t';
 }
 $f = file($path); // Разбиваем файл на массивы по строкам. Каждая строка в CSV-файле — строка в таблице.
 for ($i = 0; $i < count($f); $i++) { // Обрабатываем строки
  $cr = $f[$i]; // Текущая строка
  $cr = str_replace('<', '&lt;', $cr);
  $cr = str_replace('>', '&gt;', $cr);
  echo '     <tr>
';
  $tds = [];
  $symbols = mb_str_split($cr);
  $expLock = false;
  for ($j = 0; $j < count($symbols); $j++) {
   $s = $symbols[$j];
   if ($s === '"') {
    if ($expLock === false) {
     $expLock = true;
    } else {
     $expLock = false;
    }
   } else if ($s === $sep && $expLock === false) {
    $tds[] = '';
   } else {
    $index = array_key_last($tds);
    if (!$index) $index = 0;
    $tds[$index] .= $s;
   }
  }
  for ($j = 0; $j < count($tds); $j++) { // Обрабатываем столбцы (ячейки)
   if (is_numeric($tds[$j])) { // Выравниваем числа по правому краю
    echo '      <td style="text-align: right;">'.$tds[$j].'</td>
';
   } else {
    echo '      <td>'.$tds[$j].'</td>
';
   }
  }
  echo '     </tr>
';
 }
 echo '    </tbody>
   </table>
  </div>
';
} else if ($ext === 'ini') {
 echo '  <style type="text/css">
.section {
 background: lightblue;
 padding: 2.5px 5px;
 width: calc(100% - 10px);
 border-bottom: 1px solid dodgerblue;
}
  </style>
';
 $prs = parse_ini_file($path, true, INI_SCANNER_RAW);
 for ($i = 0; $i < count($prs); $i++) {
  if (gettype($prs[array_keys($prs)[$i]]) == 'array') {
   echo '  <p class="section"><b>'.array_keys($prs)[$i].'</b></p>'.PHP_EOL;   
   for ($j = 0; $j < count(array_keys($prs[array_keys($prs)[$i]])); $j++) {
    echo '  <p><b>'.array_keys($prs[array_keys($prs)[$i]])[$j].'</b> = '.$prs[array_keys($prs)[$i]][array_keys($prs[array_keys($prs)[$i]])[$j]].'</p>'.PHP_EOL;
   }
  } else {
   echo '  <p><b>'.array_keys($prs)[$i].'</b> = '.$prs[array_keys($prs)[$i]].'</p>'.PHP_EOL;
  }
 }
} else if ($ext === 'bin' || $ext === 'rtf' || $ext === 'pdf') {
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
  <p><b><a href="https://www.php.net/manual/ru/function.fileatime.php#refsect1-function.fileatime-notes">Последний доступ</a>:</b> '.date('d/m/Y (нед. W), H:i:s', fileatime($path)).'</p>
  <p><b>MIME-тип:</b> <code>'.$mime.'</code></p>
  <p><b>Размер:</b> '.convert_bytes(filesize($path)).'</p>
  <p><b>Индексный дескриптор (inode):</b> '.fileinode($path).'</p>
  <p><b>Права доступа:</b> '.substr(sprintf('%o', fileperms($path)), -4).' ('.fileperms($path).')</p>
 </body>
</html>';

?>