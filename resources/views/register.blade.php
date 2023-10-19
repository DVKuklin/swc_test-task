@extends('templates.main-template')

@section('content')

<form class="main-form mx-auto" action="/register" method="post">
    @csrf
  <div class="form-group">
    <label class="form-label">Логин</label>
    <input type="text" class="form-control" name="login">
  </div>
  <div class="form-group">
    <label class="form-label">Пароль</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <label class="form-label">Подтверждение пароля</label>
    <input type="password" class="form-control" name="password_confirmation">
  </div>
  <div class="form-group">
    <label class="form-label">Имя</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="form-group">
    <label class="form-label">Фамилия</label>
    <input type="text" class="form-control" name="surname">
  </div>
  <div class="form-group">
    <label class="form-label">Дата рождения</label>
    <input type="date" class="form-control" name="birthday">
  </div>
  <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>


@endsection