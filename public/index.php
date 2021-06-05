<?php

// Мы хотим видеть все возможные ошибки.
ini_set('display_errors', 1);

// Глобальные переменные для удобства.
define('ROOT', substr(__DIR__, 0, -6));
define('SRC', ROOT . DIRECTORY_SEPARATOR . 'src');

// Подключаем полезные файлы,
require_once SRC . '/session.php';
require_once SRC . '/pages.php';

// Запускаем пользовательскую сессию.
session_start();

// Получаем список параметров из урл ?param=value&param2=value2
$params = [];
if (isset($_SERVER['QUERY_STRING'])) {
    $query = $_SERVER['QUERY_STRING'];
    preg_match_all("/([^,=&]+)=([^,=&]+)/", $query, $r);
    $params = array_combine($r[1], $r[2]);
}

// Получаем текущий запрашиваемый путь и анализируем его.
$path = $_SERVER['PATH_INFO'] ?? '/';
$view = null;

// Дальше идёт защищённая часть приложения, то есть пользователь должен быть залогиненым.
// Проверка на то, залогинен ли пользователь.
session_check_is_logged_in();

// Анализируем защищённые маршруты.
switch ($path) {
    case '':
    case '/':
        page_home($params);
        break;
    case '/login':
        page_login($params);
        break;
    case '/logout':
        session_logout();
        exit();
        break;
    case '/homework':
        page_homework();
        break;
    case '/marks':
        page_marks($params);
        break;
    case '/chat':
        page_chat($params);
        break;
    default:
        http_response_code(404);
        render_view('404');
        break;
}

