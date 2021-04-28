<?php

require_once SRC . '/db.php';
require_once SRC . '/session.php';
require_once SRC . '/render.php';
require_once SRC . '/models/homework.php';

// Guard only authorized users.
session_check_is_logged_in();

$conn = db_open_connection();

$user_id   = session_user_id();
$homeworks = homework_select_all($conn, $user_id);

db_close_connection($conn);

render_view('homework', ['homeworks' => $homeworks]);
