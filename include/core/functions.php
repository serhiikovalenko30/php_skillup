<?php

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

function getLastNews($limit = 7) : array {
    return getNews('http://k.img.com.ua/rss/ru/all_news2.0.xml' , $limit);
}

function getPopularNews($limit = 5) : array {
    return getNews('http://k.img.com.ua/rss/ru/good_news.xml' , $limit);
}

function getPhotoNews($limit = 6) : array {
    return getNews('http://k.img.com.ua/rss/ru/mainbyday.xml' , $limit);
}

function isAuthUser() : bool {
    return isset($_SESSION['user']['auth']) && $_SESSION['user']['auth'] == 1;
}

function loginUser($email, $password) : bool {

    $result = false;

    $email_list = 'serro_ko@bigmir.net';
    $password_list = 'serro_ko@bigmir.net';

    if ($email == $email_list && $password == $password_list) {

        $_SESSION = [
            'user' => [
                'name' => 'Serhii',
                'auth' => 1,
            ],
        ];

        $result = true;
    }

    return $result;

}

function logoutUser() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
}

function getRoute($path = '') : array {

    global $routes;

    if($path == '') {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    $arRoute = [
        'name' => '',
        'page' => '404',
        'param' => [],
    ];

    foreach ($routes as $name => $arValue) {
        $pattern = '/^' . str_replace('/', '\/', $arValue[0]) . '$/';
        if(preg_match($pattern, $path, $matches)) {
            $arRoute['name'] = $name;
            $arRoute['page'] = $arValue[2];

            if(count($matches) > 1) {
                preg_match_all("/<(.+?)>/", $arRoute[1], $matches2);

                foreach ($matches2[1] as $k => $v) {
                    $arRoute['param'][$v] = $matches[$k + 1];
                }
            }
        }
    }

    return $arRoute;

}

function url($name, $params = []) {

    global $routes;

    $url = $routes[$name][1] ?? '';

    if(!empty($params)) {
        $arReplace = [];
        foreach ($params as $key => $value) {
            $arReplace['<' . $key . '>'] = $value;
        }
        if(!empty($arReplace)) {
            $url = str_replace(array_keys($arReplace), $arReplace, $url);
        }
    }
    return $url;
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

