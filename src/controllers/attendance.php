<?php

require_once SRC . '/db.php';
require_once SRC . '/session.php';
require_once SRC . '/render.php';
require_once SRC . '/models/attendance.php';

// Guard only authorized users.
session_check_is_logged_in();

$conn = db_open_connection();

$user_id    = session_user_id();
$attendance = attendance_select_by_student($conn, $user_id);

db_close_connection($conn);

render_view('attendance', compact('attendance'));
