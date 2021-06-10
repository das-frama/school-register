<?php

require_once 'utils.php';

// Connection.
function db_open()
{
    $config = get_config('db');

    $connection = mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database']
    );
    if (mysqli_connect_errno()) {
        die("Не удалось подключиться к MySQL: " . mysqli_connect_error());
    }

    return $connection;
}

function db_close($connection)
{
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

function db_select_one($connection, $from, $where = [])
{
    $result = db_select($connection, $from, $where);
    return reset($result);
}

function find_logged_user($connection)
{
    $username = $_SESSION['username'];
    $user = db_select($connection, 'users', ['username' => $username]);
    $user = reset($user);

    return $user ? $user : null;
}

function find_student_class($connection, $user_id)
{
    $student = db_select_one($connection, 'students', ['student_id' => $user_id]);
    $class = db_select_one($connection, 'students', ['student_id' => $user_id]);

}

function attendance_group_by_quarters($connection, $student_id, $quarter = null)
{
    $result = [];
    $attendance = attendance_select_by_student($connection, $student_id, $quarter);
    foreach ($attendance as $a) {
        $result[$a['quarter']][] = $a;
    }
    return $result;
}

function attendance_select_by_student($connection, $student_id, $quarter = null)
{
    $sql = "SELECT subjects.name AS subject, visit, lateness, truancy, disease, date, quarter FROM attendance 
        LEFT JOIN subjects ON attendance.subject_id = subjects.id
        WHERE student_id = {$student_id}";
    if ($quarter) {
        $sql .= " AND quarter = {$quarter}";
    }
    
    $result = mysqli_query($connection, $sql, MYSQLI_ASSOC);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function find_all_homework($connection, $user_id) {
    $sql = "SELECT text, until_date, name AS subject FROM homeworks                              
        LEFT JOIN subjects ON homeworks.subject_id = subjects.id                             
        WHERE homeworks.classroom_id = (SELECT classroom_id FROM students WHERE user_id = $user_id)";
    $result = mysqli_query($connection, $sql, MYSQLI_ASSOC);

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Functions.
function find_user_by_credentials($connection, $username, $password) {
    // Check if user registered.
    $user = db_select_one($connection, 'users', ['username' => $username]);
    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    } else {
        return false;
    }
}

function find_all_marks($connection, $student_id) {
    $sql = "SELECT CONCAT(users.first_name, ' ', users.last_name) as teacher, subjects.name as subject, mark FROM marks                              
        LEFT JOIN subjects ON marks.subject_id = subjects.id                             
        LEFT JOIN users ON marks.teacher_id = users.id                             
        WHERE marks.student_id = $student_id";
    $result = mysqli_query($connection, $sql, MYSQLI_ASSOC);
    if (mysqli_errno($connection)) {
        die (mysqli_error($connection));
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function save_message_chat($connection, $user_id, $class_id, $text)
{
    $stmt = mysqli_prepare($connection, 'INSERT INTO chat (user_id, class_id, text) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'iis', $user_id, $class_id, $text);
    return mysqli_stmt_execute($stmt);
}


