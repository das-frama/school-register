<?php

require_once SRC . '/db.php';
require_once SRC . '/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_logout();
} 

redirect('/login');
