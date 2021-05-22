<?php

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
