<?php 

$title = 'Посещаемость';
?>

<h2><?= $title ?></h2>

<h4 class="mt-4">Первая четверть</h4>
<hr/>

<table class="table table-sm table-striped table-bordered">
    <thead>
        <tr>
            <th rowspan="2">№</th>    
            <th rowspan="2">Предмет</th>    
            <th rowspan="2">Посещения</th>    
            <th rowspan="2">Опоздания</th>    
            <th colspan="2">Пропуски</th>    
        </tr>
        <tr>
            <th>Всего</th>    
            <th>По болезни</th>    
        </tr>
    </thead>
    <tbody>
        <?php foreach ($attendance as $k => $v): ?>
            <tr>
                <td><?= $k + 1 ?></td>
                <td><?= $v['subject'] ?></td>
                <td><?= $v['visit'] ?></td>
                <td><?= $v['lateness'] ?></td>
                <td><?= $v['truancy'] ?></td>
                <td><?= $v['disease'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Итого</strong></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>