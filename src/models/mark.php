<?php

function mark_find_all($connection, $student_id) {
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
