@extends('templates.main-template')

@section('content')
<div class="card-body">
  <div class="form-group">
    <label for="inputName">Имя</label>
    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
  </div>
  <div class="form-group">
    <label for="inputDescription">Фамилия</label>
    <input type="text" class="form-control" value="{{ $user->surname }}" readonly>
  </div>
  <div class="form-group">
    <label for="inputName">Дата рождения</label>
    <input type="date" class="form-control" value="{{ $user->birthday }}" readonly>
  </div>
</div>
@endsection