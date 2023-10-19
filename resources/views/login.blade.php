@extends('templates.main-template')

@section('content')

<form class="main-form mx-auto" action="/login" method="post">
    @csrf
  <div class="form-group">
    <label class="form-label">Логин</label>
    <input type="text" class="form-control" name="login">
  </div>
  <div class="form-group">
    <label class="form-label">Пароль</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Войти</button>
</form>

@endsection