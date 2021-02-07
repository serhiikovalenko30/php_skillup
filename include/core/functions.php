<?php

use App\DataBase\DB;
use App\Route;

function create_dir($dirName) {
    if(!is_dir($dirName))
        mkdir($dirName, 0755, true);
}

function write_log($path, $fileName, $name, $email, $phone, $massage) {
    if($handle = fopen($path . $fileName, 'a')) {
        fwrite($handle, time() . '|' . $name . '|' . $email . '|' . $phone . '|' . $massage . PHP_EOL);
        fclose($handle);
    }
}

function checkName($name) : bool {
    if (isset($_POST['contact_name'])) {
        if (preg_match("/[0-9а-яa-z_]/i", $name)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkEmail($email) : bool {
    if (isset($_POST['contact_email'])) {
        if(preg_match('|^[-0-9а-яa-z_.]+@[-0-9а-яa-z^.]+\.[a-zа-я]{2,6}$|i',$email)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkPhone($phone) : bool {
    if (isset($_POST['contact_phone'])) {
        if (preg_match('/^\+380(50|96|98|63|93)\d{7}$/', $phone)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkMassage($massage) : bool {
    if (isset($_POST['contact_massage'])) {
        if (preg_match("/[0-9а-яa-z_]/i", $massage)) {
            return true;
        }
        return false;
    }
    return false;
}

function getNews($source, $limit) : array {

//    $xml = 'http://k.img.com.ua/rss/ru/all_news2.0.xml';
    $xml = $source;
    $strXML = file_get_contents($xml);
    $objXML = simplexml_load_string($strXML, 'SimpleXMLElement', LIBXML_NOCDATA);
    $arXML = json_decode(json_encode($objXML), true);

    $arNews = [];

    foreach ($arXML['channel']['item'] as $item) {

        preg_match("/src=\"(.+?)\"/", $item['image'], $matches);
        $image = $matches[1] ?? '';

        $arNews[] = [
            'id' => $item['guid'],
            'datetime' => date('H:i', strtotime($item['pubDate'])),
            'title' => $item['title'],
            'image' => $image,
            'url' => '/detail.php?id=' . $item['guid'],
            'description' => strip_tags($item['description']),
            'fulltext' => strip_tags($item['fulltext']),
        ];
    }

    $arNews = array_slice($arNews, 0 , $limit);

    return $arNews;
}

function url($name, $params = []) {
    return Route::url($name, $params);
}

function printTemplateHtml($template, $arData = []) {
    $template_path = $_SERVER['DOCUMENT_ROOT'] . '/include/template/' . $template . '.php';
    if(is_file($template_path)) {
        include $template_path;
    }
}

function includeBlock ($block) {
    $block_path = $_SERVER['DOCUMENT_ROOT'] . '/include/blocks/' . $block . '.php';
    if(is_file($block_path)) {
        include $block_path;
    }
}

function db_connect() {
    return DB::get();
}

function redirect($url, $status = 301) {
    header("Location: " . $url, true, $status);
    exit;
}