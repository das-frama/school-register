<?php

// Connection.
function db_open_connection() {
    // Config.
    $host = 'localhost';
    $db = 'school-register';
    $username = 'root';
    $password = 'root';

    $connection = mysqli_connect($host, $username, $password, $db);
    if (mysqli_connect_errno()) {
        die("Не удалось подключиться к MySQL: " . mysqli_connect_error());
    }

    return $connection;
}

function db_close_connection($connection) {
    mysqli_close($connection);
}

function db_select($connection, $from, $where = []): array
{
    // Prepare SQL string.
    $sql = "SELECT * FROM $from";
    if ($where !== []) {
        $sql .= " WHERE ";
        foreach ($where as $key => $val) {
            $sql .= $key . ' = ? AND ';
        }
        $sql = substr($sql, 0, -5);
    }


    // Select from database..
    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        die(mysqli_error($connection));
    }

    foreach ($where as $key => $val) {
        $stmt->bind_param('s', $val);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Return results.
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function db_select_one($connection, $from, $where = []) {
    $result = db_select($connection, $from, $where);
    return reset($result);
}

function db_find_logged_user_id($connection) {
    $username = $_SESSION['username'];
    $user = db_select($connection, 'users', ['username' => $username]);
    $user = reset($user);

    return $user ? $user['id'] : null;
}
