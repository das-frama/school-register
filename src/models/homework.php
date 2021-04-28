<?php

function homework_select_all($connection, $user_id) {
    $sql = "SELECT text, until_date, name AS subject FROM homeworks                              
        LEFT JOIN subjects ON homeworks.subject_id = subjects.id                             
        WHERE homeworks.classroom_id = (SELECT classroom_id FROM students WHERE user_id = $user_id)";
    $result = mysqli_query($connection, $sql, MYSQLI_ASSOC);

    return $result->fetch_all(MYSQLI_ASSOC);
}
