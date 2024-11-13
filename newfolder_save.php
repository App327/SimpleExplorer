<?php

if (isset($_GET["p"])) {
 if ($_GET["p"] != '') {
  if (isset($_GET["fn"])) {
   if ($_GET["fn"] != '') {
    $md = mkdir($_GET["p"].'/'.$_GET["fn"]);
    if (!$md) {
     header('Location: /?path='.$_GET["p"].'&notif=Ошибка+создания+папки:+не+удалось+создать+папку.');
    } else {
     header('Location: /?path='.$_GET["p"].'&notif=Папка+'.urlencode('«'.$_GET["fn"].'»').'+успешно+создана.');
    }
   } else {
    header('Location: /?path='.$_GET["p"].'&notif=Ошибка+создания+папки:+не+указано+название+новой+папки.');
   }
  } else {
   header('Location: /?path='.$_GET["p"].'&notif=Ошибка+создания+папки:+не+указано+название+новой+папки.');
  }
 } else {
  header('Location: /?notif=Ошибка+создания+папки:+не+указан+путь+для+создания.');
 }
} else {
 header('Location: /?notif=Ошибка+создания+папки:+не+указан+путь+для+создания.');
}

?>