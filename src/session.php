<?php

// Functions.
function session_check_is_logged_in() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        redirect('/login');
        exit();
    }
}

function session_check_is_not_logged_in() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        redirect('/');
        exit();
    }
}

function session_user_id() {
    return $_SESSION['user_id'];
}

function session_login($user_id) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user_id;
}

function session_logout() {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_id']);
    session_unset();
}

function redirect($path = '/') {
    header('Location: ' . $path);
}
