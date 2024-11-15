# SimpleExplorer
Простой файловый менеджер на PHP, позволяющий управлять файлами прямо в браузере.

# Начало работы

Для того, чтобы начать использовать SimpleExplorer, вам потребуется:

* Веб-сервер (например, Apache)
* PHP (рекомендуется PHP 8.*)
    * PHP-расширение [ZipArchive](https://www.php.net/manual/ru/book.zip.php), если вам требуется поддержка работы с ZIP-архивами

# Файлы

Ниже указан список файлов SimpleExplorer и пояснение, для чего они нужны.

* [backup.zip](backup.zip) — резервная копия всех файлов SimpleExplorer.
* [file.php](file.php) — средство просмотра файлов.
* [zip.php](zip.php) — средство просмотра содержимого ZIP-архивов.
* [unzip_folder.php](unzip_folder.php) — ввод папки для распаковки ZIP-архива.
* [unzip.php](unzip.php) — основной процесс распаковки ZIP-архива.
* [newfolder.php](newfolder.php) — созданине новой папки; окно ввода названия новой папки.
* [newfolder_save.php](newfolder_save.php) — сохранение новой папки и перенаправление в список файлов с уведомлением о статусе создания папки вверху страницы.
* [index.php](index.php) — список файлов на устройстве.
* [file_view.php](file_view.php) — чтение и вывод требуемого файла; используется для средства просмотра файлов ([file.php](file.php)).

# Будущие обновления

В последующем будут выходить обновления для SimpleExplorer, которые будут добавлять новые функции, исправлять ошибки, улучшать безопасность и т. д.

Текущая версия: **v1.0**.

# Поддерживаемые файлы

Файлы, которые поддерживаются файлом [file.php](file.php).

Приведённый ниже список расширений файлов показывает примерно поддерживаемые файлы, некоторые форматы файлов из списка ниже могут не поддерживаться, а некоторые — наоборот, поддерживаться. Дело в том, что SimpleExplorer проверяет не расширение файла, а его MIME-тип.

## Изображения
Отображаются как обычная картинка на веб-сайте.

`image/png` | `image/jpg` | `image/jpeg` | `image/gif` | `image/vnd.microsoft.icon` | `image/webp` | `image/tiff` | `image/bmp`

* PNG
* JPG/JPEG
* GIF
* ICO
* WEBP
* TIFF
* BMP

## Видео
Отображается как обычное видео на веб-сайте.

`video/mpeg` | `video/mp4` | `video/webm`

* MP4 (видео) [MPEG]
* WEBM
* MPEG

## Аудио
Отображается как обычное аудио на веб-сайте.

`audio/mpeg` | `audio/x-hx-aac-adts` | `audio/mp4` | `audio/vnd.wave` | `audio/x-wav` | `audio/ogg` | `audio/opus` | `audio/x-m4a` | `audio/m4a`

* MP3
* WAV
* OGG
* OPUS
* MP4 (аудио) [MPEG]
* M4A
* MPEG

## Архивы
>[!WARNING]
>Для работы с ZIP/JAR-архивами требуется PHP-расширение [ZipArchive](https://www.php.net/manual/ru/book.zip.php).

`application/zip`

Содержимое архива отображается в виде списка на отдельной странице ([zip.php](zip.php)). Поддерживается распаковка.
* ZIP
* JAR

## Шрифты
Используя CSS-свойство `@font-face`, SimpleExplorer загружает шрифт и называет его «Test Font». Далее этот «Test Font» используется в абзацах в месте, где просматривается содержимое файла. В этих абзацах написано 2 [панграммы](https://ru.wikipedia.org/wiki/Панграмма): на русском («Съешь ещё этих мягких французских булок, да выпей же чаю») и на английском («The quick brown fox jumps over the lazy dog»); под ними находятся английский и русский алфавит, написаный большими (прописными) и маленькими (строчными) буквами: ABC/abc, АБВ/абв; затем идут цифры от 1 до 9 с 0 в конце: «1234567890»; в конце располагаются специальные символы (@, $, ?, _ и т. д.). Ниже расположено поле ввода, позволяющее тестировать другие символы, например, если шрифт содержит эмодзи, которые не отображаются в предпросмотре выше.

`font/sfnt` | `font/truetype` | `application/vnd.ms-fontobject` | `font/woff` | `font/opentype` | `application/font-woff` | `font/woff2` | `font/collection`

* TTF
* EOT
* OTF
* WOFF
* WOFF2

## Текстовые файлы
Отображается как неформатированный текст (в HTML-теге `<pre>`) на светло-сером фоне.

`text/plain` | `text/css` | `text/javascript` | `application/json` | `application/x-empty`

* TXT
* CSS
* JS [JavaScript]
* JSON
* <без расширения>

## XML
Отображаются в iframe (HTML-тег `<iframe>`).

`text/html` | `image/svg+xml`

* HTML
* SVG

## Другое
* Папки


Для всех остальных типов файлов будет отображаться текст «Этот тип файла пока не поддерживается SimpleExplorer.».
