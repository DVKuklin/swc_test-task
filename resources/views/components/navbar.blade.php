<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @auth
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/logout" class="nav-link">Выйти</a>
      </li>
      @endauth
      @guest
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/login" class="nav-link">Войти</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/register" class="nav-link">Регистрация</a>
      </li>
      @endguest
    </ul>
  </nav>