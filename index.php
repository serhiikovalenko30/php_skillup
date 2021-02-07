<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/include/core/functions.php');
include($_SERVER['DOCUMENT_ROOT'] . '/app/Autoloader.php');

Autoloader::register();

use \App\Auth;
use \App\Route;

$route = new Route();

$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $route->page . '.php';

if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}

$needHeaderFooter = $route->needHeaderFooter();

$header_template = 'header';
$footer_template = 'footer';
if($route->isAdminRoute()) {
    $header_template = 'admin/header';
    $footer_template = 'admin/footer';

    if(!Auth::isAdmin()) {
        redirect(url('main_page'));
    }
}

if ($needHeaderFooter) {
    printTemplateHtml($header_template);
}

include $page_file;

if ($needHeaderFooter) {
    printTemplateHtml($footer_template);
}

