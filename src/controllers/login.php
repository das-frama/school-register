<?php

require_once SRC . '/db.php';
require_once SRC . '/session.php';
require_once SRC . '/render.php';
require_once SRC . '/models/login.php';

// Guard only authorized users.
// session_check_is_not_logged_in();

$errors = [];

// If post method.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate data.
    if (!isset($_POST['username']) || !isset($_POST['password']) 
        || empty($_POST['username']) || empty($_POST['password'])) {
        $errors[] = 'Вы не указали логин или пароль';
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = db_open_connection();
    if ($user_id = login_user_exists($conn, $username, $password)) {
        session_login($user_id);
        redirect('/');
    } else {
        $errors[] = 'Неправильное имя пользователя или пароль';
    }
    db_close_connection($conn);
}

render_view('login', ['errors' => $errors], 'layout_login');
