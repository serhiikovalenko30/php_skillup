<?php

namespace App\DataBase;

class DB
{
    private static $link = null;

    public static function get() {
        if(empty(self::$link)) {
            self::$link = self::connect();
        }
        return self::$link;
    }

    private static function connect() {
        $link = mysqli_connect('localhost', 'root', '', 'news_skillup');
        if (mysqli_connect_errno()) {
            echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
            exit;
        }
        return $link;
    }
}