<?php
// Прописываем заголовок PNG-изображения
header("Content-type: image/jpeg");

$image_path = "images/bg_002.jpg"; //Путь к изображению

$text1 = "Константин"; // текст, который мы написали здесь
$text2 = "Константинопольский"; // текст, который мы написали здесь
$text3 = "Достиг больших успехов в 500 больших проектах за этот плодотворный год";
$text4 = "ПРЕМИЯ"; // статичний текст
$stamp_path = "images/g.gif"; //Путь к изображению штампа 1

//$stamp_path = $_GET['stamp_path'];
// так соме зробити текст через GET


$file_new = "images/result/".$_GET['file_new']." ".$text3.".jpg"; //Путь к изображению

function imagecreatefromfile( $filename ) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
            break;

        case 'png':
            return imagecreatefrompng($filename);
            break;

        case 'gif':
            return imagecreatefromgif($filename);
            break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
    }
}

$img = imagecreatefromfile($image_path); // создаём новое изображение из файла
$stamp1 = imagecreatefromfile($stamp_path); // создаём новое изображение штамп 1


$font = "fonts/RobotoSlabRegular.woff"; // путь к шрифту
$font_size = 14; // размер шрифта общий
$font_size2 = 18; // размер шрифта
$font_size3 = 11; // размер шрифта

$white = imagecolorallocate($img, 255, 255, 255);
imagecopy($img, $stamp1, 500, 70, 0, 0, imagesx($stamp1), imagesy($stamp1)); // наложение штампа на основное изображение

///////////////// переніс слів якщо не влазять у задану ширину///////
// Разбиваем наш текст на массив слов
$arr = explode(' ', $text3);
// Возращенный текст с нужными переносами строк, пока пустая
$ret = "";
// Перебираем наш массив слов
foreach($arr as $word)
{
    // Временная строка, добавляем в нее слово
    $tmp_string = $ret.' '.$word;

    // Получение параметров рамки обрамляющей текст, т.е. размер временной строки
    $textbox = imagettfbbox($font_size, 0, $font, $tmp_string);

    // Если временная строка не укладывается в нужные нам границы, то делаем перенос строки, иначе добавляем еще одно слово
    if($textbox[2] > 320)
        $ret.=($ret==""?"":"\n").$word;
    else
        $ret.=($ret==""?"":" ").$word;
}

/////////// кінець розбивки///////

//Разметка самого текста и его позиционирование
imagettftext($img, $font_size, 0, 650, 110, $white, $font, $text1);
imagettftext($img, $font_size, 0, 650, 135, $white, $font, $text2);
imagettftext($img, $font_size, 0, 650, 340, $white, $font, $ret);
imagettftext($img, $font_size3, 0, 200, 98, $white, $font, $text4);

//imagepng($img, $file_new, 0); // сохранение файла на сервер
imagepng($img); // вывод изображения в браузер
imagedestroy($img);


?>