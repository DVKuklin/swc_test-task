@extends('templates.main-template')

@section('content')
<div class="card-body">
  <div class="form-group">
    <label for="inputName">Название события</label>
    <input type="text" class="form-control" value="{{ $event->title }}" readonly>
  </div>
  <div class="form-group">
    <label for="inputDescription">Описание события</label>
    <textarea id="inputDescription" class="form-control" rows="4" readonly>{{ $event->description }}</textarea>
  </div>
  <div class="form-group">
    <label for="inputName">Дата</label>
    <input type="date" id="eventDate" class="form-control" value="{{ $event->date }}" readonly>
  </div>
</div>

<h3>Участники</h3>
<ul>
  <li><a href="#">sdfsdf</li>

</ul>
<div class="my-2">
@if (!$is_participant)
  <button class="btn btn-success">Принять участие</button>
@else
  <button class="btn btn-danger">Отказаться от участия</button>
@endif
</div>

@endsection