<?php

function get_config($param = '')
{
    $config = require_once 'config.php';
    if ($param !== '' && !isset($config[$param])) {
        throw new Exception('The $param does not exists in config.');
    }

    return $param === '' ? $config : $config[$param];
}

function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}

function from_number_to_ordinal($num)
{
    switch ($num) {
        case 0:
            return 'Нулевая';
        case 1:
            return 'Первая';
        case 2:
            return 'Вторая';
        case 3:
            return 'Третья';
        case 4:
            return 'Четвёртая';
        case 5:
            return 'Пятая';
        case 6:
            return 'Шестая';
        case 7:
            return 'Седьмая';
        default:
            return '';
    }
}

function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}
