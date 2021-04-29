<?php 

$title = 'Домашнее задание';
?>

<h2>Домашнее задание</h2>

<table class="table table-sm table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Предмет</th>
            <th>Задание</th>
            <th>Дата сдачи</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($homeworks as $i => $homework): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $homework['subject'] ?></td>
                <td><?= $homework['text'] ?></td>
                <td><?= date('d.m.Y H:i', strtotime($homework['until_date'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
