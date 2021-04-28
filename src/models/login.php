<?php


// Functions.
function login_user_exists($connection, $username, $password) {
    // Check if user registered.
    $user = db_select_one($connection, 'users', ['username' => $username]);
    if ($user && password_verify($password, $user['password_hash'])) {
        return $user['id'];
    } else {
        return false;
    }
}

function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

