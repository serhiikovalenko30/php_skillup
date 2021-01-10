<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/include/core/functions.php');

$routes = [
    'main_page' => ['/', '/', 'index'],
    'news_list' => ['/news/', '/news/', 'news/list'],
    'news_detail' => ['/news/([0-9a-z-])/', '/news/<id>/', 'news/detail'],
    'contacts' => ['/contacts/', '/contacts/', 'contacts/index'],
    'contacts_send_form' => ['/contacts/send/', '/contacts/send/', 'contacts/send'],

    'detail' => ['/detail/', '/detail/', 'news/detail'],
    'info' => ['/info/', '/info/', 'company/info'],

    'auth' => ['/auth/', '/auth/', 'user/auth'],
    'logout' => ['/logout/', '/logout/', 'user/logout'],
    'profile' => ['/profile/', '/profile/', 'user/profile'],
];

$arRouteWOHeaderAndFooter = [
    'contacts_send_form',
];

$arRoute = getRoute();

$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $arRoute['page'] . '.php';

if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}


if (!in_array($arRoute['name'], $arRouteWOHeaderAndFooter)) {
    printTemplateHtml('header');
}
include $page_file;
if (!in_array($arRoute['name'], $arRouteWOHeaderAndFooter)) {
    printTemplateHtml('footer');
}

