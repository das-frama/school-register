<?php

require_once SRC . '/utils.php';
$title = 'Посещаемость';

?>

<h2 class="mb-3"><?= $title ?></h2>

<h6>Фильтр:</h6>
<select id="quarter-select" class="form-control" onchange="reload_page(event)">
  <option value=""  <?= $quarter == null ? 'selected' : '' ?>>Все четверти</option>
  <option value="1" <?= $quarter == 1 ? 'selected' : '' ?>>Первая четверть</option>
  <option value="2" <?= $quarter == 2 ? 'selected' : '' ?>>Вторая четверть</option>
  <option value="3" <?= $quarter == 3 ? 'selected' : '' ?>>Третья четверть</option>
  <option value="4" <?= $quarter == 4 ? 'selected' : '' ?>>Четвёртая четверть</option>
</select>

<?php foreach ($attendance as $quarter => $at) : ?>
  <h4 class="mt-4"><?= from_number_to_ordinal($quarter) ?> четверть</h4>
  <hr />

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
      <?php foreach ($at as $k => $v) : ?>
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
<?php endforeach; ?>

<script>
  function reload_page(event) {
    const quarter = event.target.value;
    if (quarter) {
      document.location.href = document.location.origin + document.location.pathname + '?quarter=' + quarter;
    } else {
      document.location.href = document.location.origin + document.location.pathname;
    }
  }
</script>