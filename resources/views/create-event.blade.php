@extends('templates.main-template')

@section('content')

<form class="main-form mx-auto" action="/events/create" method="post">
  @csrf
  <div class="form-group">
    <label class="form-label">Заголовок</label>
    <input type="text" class="form-control" name="title">
  </div>
  <div class="form-group">
    <label class="form-label">Описание</label>
    <textarea class="form-control" name="description"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Создать событие</button>
</form>


@endsection