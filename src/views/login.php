<main class="form-signin text-center">
  <form action="" method="post">
    <!-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <i class="las la-school la-6x text-secondary"></i>
    <h1 class="h4 mt-3 mb-3 fw-normal">Школьный журнал</h1>

    <?php if (isset($errors) && count($errors) > 0): ?>
      <div class="alert alert-danger">
        <ul class="m-0 list-unstyled">
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <label for="inputEmail" class="visually-hidden">Логин</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="Логин" autofocus="" name="username">
    <label for="inputPassword" class="visually-hidden">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" name="password">
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me" name="remember_me"> Запомнить меня
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">© 2021</p>
  </form>
</main>
