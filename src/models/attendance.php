<?php

function attendance_select_by_student($connection, $student_id) {
    $sql = "SELECT subjects.name AS subject, visit, lateness, truancy, disease, date FROM attendance 
        LEFT JOIN subjects ON attendance.subject_id = subjects.id
        WHERE student_id = {$student_id}";
    $result = mysqli_query($connection, $sql, MYSQLI_ASSOC);

    return $result->fetch_all(MYSQLI_ASSOC);
}
