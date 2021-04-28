<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/line-awesome.min.css">
  <link href="css/style.css" rel="stylesheet">
  <title><?= $title ?> - Школьный журнал</title>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
      <i class="las la-school"></i> Школьный журнал
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <form action="/logout" method="post">
          <button class="btn btn-link nav-link">Выйти</button>
        </form>
      </li>
    </ul>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link <?= $route == 'index' ? 'active' : '' ?>" aria-current="page" href="/">
                <i class="las la-digital-tachograph"></i>
                Моя рабочая область
              </a>
            </li>
          </ul>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Обучение</span>
          </h6>
          <ul class="nav flex-column">

            <li class="nav-item">
              <a class="nav-link <?= $route == 'homework' ? 'active' : '' ?>" href="/homework">
                <i class="las la-book-reader"></i>
                Домашнее задание
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $route == 'mark' ? 'active' : '' ?>" href="/marks">
                <i class="las la-graduation-cap"></i>
                Оценки по предметам
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $route == 'attendance' ? 'active' : '' ?>" href="/attendance">
                <i class="las la-calendar-check"></i>
                Посещаемость
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="las la-calendar"></i>
                Расписание
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Общение</span>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="las la-chalkboard-teacher"></i>
                Связь с учителем
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="las la-comments"></i>
                Общий чат с классом
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <?= $content ?>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>

</html>