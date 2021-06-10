<?php

require_once 'db.php';

function page_home()
{
    render_view('index');
}

function page_login(array $params)
{
    $errors = [];

    // If post method.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate data.
        if (
            !isset($_POST['username']) || !isset($_POST['password'])
            || empty($_POST['username']) || empty($_POST['password'])
        ) {
            $errors[] = 'Вы не указали логин или пароль';
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = db_open();
        if ($user = find_user_by_credentials($conn, $username, $password)) {
            session_login($user['id']);
            redirect('/');
        } else {
            $errors[] = 'Неправильное имя пользователя или пароль';
        }
        db_close($conn);
    }

    render_view('login', ['errors' => $errors], 'layout_login');
}

function page_marks(array $params)
{
    $conn = db_open();

    $user_id = session_user_id();
    $marks   = find_all_marks($conn, $user_id);

    db_close($conn);

    render_view('mark', ['marks' => $marks]);
}

function page_homework()
{
    $conn = db_open();

    $user_id   = session_user_id();
    $homeworks = find_all_homework($conn, $user_id);

    db_close($conn);

    render_view('homework', ['homeworks' => $homeworks]);
}

function page_chat(array $params)
{
    $conn = db_open();

    $user = find_logged_user($conn);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message = $_POST['message'];
        $class_id = 
        save_message_chat($conn, $user['id'], $user['class_id'], $message);
    }


    // $user_id   = session_user_id();
    // $homeworks = find_all_homework($conn, $user_id);
    
    
    db_close($conn);

    render_view('chat', ['chat' => []]);
}

function render_view(string $view, array $params = [], string $layout = 'layout')
{
    extract($params);
    ob_start();
    require('views/' . $view . '.php');
    $route = $view;
    $content = ob_get_clean();
    require("views/$layout.php");
}
