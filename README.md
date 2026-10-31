# ℹ️ SimpleExplorer
Простой файловый менеджер на PHP, позволяющий управлять файлами и папками прямо в веб-браузере.

# 🧭 Начало работы

Для того, чтобы начать использовать SimpleExplorer, вам потребуется:

* Веб-сервер (например, Apache)
* PHP (рекомендуется PHP 8.*)
    * PHP-расширение [Zip](https://www.php.net/manual/ru/book.zip.php), если вам нужна поддержка работы с ZIP-архивами (необязательно для базовой работы SimpleConverter; требуется только для чтения и распаковки ZIP-архивов)
   * PHP-расширение [Rar](https://www.php.net/manual/ru/book.rar.php), если вам нужна поддержка работы с RAR-архивами (необязательно для базовой работы SimpleConverter; требуется только для чтения и распаковки RAR-архивов)
   * PHP-расширение [mbstring](https://www.php.net/manual/ru/book.mbstring.php)

# 📁 Файлы

Ниже указан список файлов SimpleExplorer и пояснение, для чего они нужны и что делают.

* [_backup.zip](_backup.zip) — резервная копия всех файлов SimpleExplorer (на всякий случай).
* [file.php](file.php) — страница просмотра файлов.
* [zip.php](zip.php) — страница просмотра содержимого ZIP/RAR-архивов.
* [unzip_folder.php](unzip_folder.php) — страница ввода пути к папке для распаковки ZIP/RAR-архива.
* [unzip.php](unzip.php) — основной скрипт распаковки ZIP/RAR-архива.
* [newfolder.php](newfolder.php) — страница ввода названия новой папки для создания.
* [newfolder_save.php](newfolder_save.php) — скрипт для создания новой папки и перенаправления на список файлов ([index.php](index.php)) с уведомлением о статусе создания папки вверху страницы со списком файлов.
* [index.php](index.php) — страница со списком файлов в указанной папке.
* [file_view.php](file_view.php) — скрипт для чтения и вывода (отправки) в браузер требуемого файла. Используется для средства просмотра файлов ([file.php](file.php)).
* [file_edit.php](file_edit.php) — редактор содержимого файлов. Пока поддерживается редактирование содержимого только файлов формата TXT.
* [file_edit_save.php](file_edit_save.php) — скрипт для сохранения изменений в файле, сделанных с помощью [file_edit.php](file_edit.php).

# 🔄 Будущие обновления

SimpleExplorer развивается, время от времени выходят его новые версии (обновления). В этих обновлениях добавляяются новые функции, исправляются ошибки, улучшается безопасность, добавляется поддержку новых форматов файлов, улучшается внешний вид интерфейса и т. д.

Текущая версия SimpleExplorer: **1.3**.

# ✅ Поддерживаемые форматы файлов

Здесь перечислены файловые форматы, которые поддерживаются средством просмотра файлов ([file.php](file.php)).

Начиная с версии 1.3 SimpleExplorer определяет формат файла на основе расширения его имени. Некоторые форматы файлов имеют несколько вариантов расширений (например, HTML — `.html` и `.htm`). SimpleExplorer «знает» о некоторых таких вариантах, но может знать не обо всех из них. Проблемы также есть и у файловых форматов, хранящих разные типы контента внутри себя.

## 🖼️ Изображения
Отображаются как обычная картинка на веб-сайте.

`image/png` | `image/jpg` | `image/jpeg` | `image/gif` | `image/vnd.microsoft.icon` | `image/webp` | `image/tiff` | `image/bmp` | `image/avif` | `image/x-avif` | `image/tiff` | `image/x-tiff`

* PNG
* JPG/JPEG
* GIF
* ICO
* WEBP
* TIFF
* BMP
* AVIF
* TIF
* TIFF

## 🎥 Видео
Отображается как обычное видео на веб-сайте.

`video/mpeg` | `video/mp4` | `video/webm` | `video/quicktime` | `video/x-quicktime` | `video/x-msvideo` | `video/msvideo`

* MP4 (видео) [MPEG]
* WEBM
* MPEG
* MOV [QuickTime]
* MOVIE [QuickTime]
* QT [QuickTime]
* AVI

## 🎵 Аудио
Отображается как обычное аудио на веб-сайте.

`audio/mpeg` | `audio/x-hx-aac-adts` | `audio/mp4` | `audio/vnd.wave` | `audio/x-wav` | `audio/ogg` | `audio/opus` | `audio/x-m4a` | `audio/m4a`

* MP3
* WAV
* OGG
* OPUS
* MP4 (аудио) [MPEG]
* M4A
* MPEG

## 🗄️ Архивы
>[!WARNING]
>Для работы с ZIP/JAR-архивами требуется PHP-расширение [ZipArchive](https://www.php.net/manual/ru/book.zip.php).

>[!WARNING]
>Для работы с RAR-архивами требуется PHP-расширение [RarArchive](https://www.php.net/manual/ru/book.rar.php).

`application/zip` | `application/java-archive` | `application/vnd.rar` | `application/x-rar` | `application/rar`

Содержимое архива отображается в виде списка на отдельной странице ([zip.php](zip.php)). Поддерживается распаковка.
* ZIP
* JAR
* RAR (частичная поддержка)

## 🔠 Шрифты
Используя CSS-свойство `@font-face`, SimpleExplorer загружает шрифт и называет его «Test Font». Далее этот «Test Font» используется в абзацах в месте, где просматривается содержимое файла. В этих абзацах написано 2 [панграммы](https://ru.wikipedia.org/wiki/Панграмма): на русском («Съешь ещё этих мягких французских булок, да выпей же чаю») и на английском («The quick brown fox jumps over the lazy dog»); под ними находятся английский и русский алфавит, написаный большими (прописными) и маленькими (строчными) буквами: ABC/abc, АБВ/абв; затем идут цифры от 1 до 9 с 0 в конце: «1234567890»; в конце располагаются специальные символы (@, $, ?, _ и т. д.). Ниже расположено поле ввода, позволяющее тестировать другие символы, например, если шрифт содержит эмодзи, которые не отображаются в предпросмотре выше.

`font/sfnt` | `font/truetype` | `application/vnd.ms-fontobject` | `font/woff` | `font/opentype` | `application/font-woff` | `font/woff2` | `font/collection`

* TTF
* EOT
* OTF
* WOFF
* WOFF2

## 📃 Текстовые файлы
Отображается как неформатированный текст (в HTML-теге `<pre>`) на светло-сером фоне.

`text/plain` | `application/xml` | `text/xml` | `text/x-php` | `text/php` | `application/x-httpd-php` | `text/x-msdos-batch` | `text/msdos-batch` | `application/bat` | `application/x-bat` | `text/css` | `text/javascript` | `application/json` | `application/x-empty`

* TXT
* XML
* PHP
* BAT
* CMD
* CSS
* JS [JavaScript]
* JSON
* <без расширения>

## 📄 Веб-контент
Отображаются в iframe (HTML-тег `<iframe>`).

`text/html` | `image/svg+xml`

* HTML
* SVG

## ↔️ Другое
* Папки


Для всех остальных типов файлов будет отображаться текст «Этот тип файла пока не поддерживается SimpleExplorer.». Если поддержка файла будет добавлена в ближайших обновлениях (не обязательно именно в следующем), то будет отображаться следующий текст: «Этот тип файла пока не поддерживается SimpleExplorer, но его поддержка будет добавлена в ближайших обновлениях SimpleExplorer. Следите за обновлениями!».
