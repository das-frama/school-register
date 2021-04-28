<?php 

$title = 'Оценки';
?>

<h2>Оценки</h2>

<table class="table table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Предмет</th>
            <th>Учитель</th>
            <th>Оценка</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($marks as $i => $mark): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $mark['subject'] ?></td>
                <td><?= $mark['teacher'] ?></td>
                <td><?= $mark['mark'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
