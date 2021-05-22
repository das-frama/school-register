<?php

require_once SRC . '/utils.php';

// Parse route.
function execute_route() {
    $path = $_SERVER['PATH_INFO'];
    $params = [];
    if (isset($_SERVER['QUERY_STRING'])) {
        $query = $_SERVER['QUERY_STRING'];
        preg_match_all("/([^,=&]+)=([^,=&]+)/", $query, $r); 
        $params = array_combine($r[1], $r[2]);
    }

    switch ($path) {
        case '' :
        case '/' :
            require __DIR__ . '/controllers/index.php';
            break;
        case '/login':
            require __DIR__ . '/controllers/login.php';
            break;
        case '/logout':
            require __DIR__ . '/controllers/logout.php';
            break;
        case '/homework' :
            require __DIR__ . '/controllers/homework.php';
            break;
        case '/marks' :
            require __DIR__ . '/controllers/mark.php';
            break;
        case '/attendance' :
            require __DIR__ . '/controllers/attendance.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/views/404.php';
            break;
    }
}
