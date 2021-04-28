<?php

require_once SRC . '/render.php';
require_once SRC . '/session.php';

// Guard only authorized users.
session_check_is_logged_in();

render_view('index');
