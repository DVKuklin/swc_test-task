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
<ul id="participantList">

</ul>

<div class="my-2">
@if (!$is_participant)
  <button id="buttonTekePart" class="btn btn-success" onclick="takePart( {{ $event->id }} )">Принять участие</button>
  <button id="buttonRefusePart" class="btn btn-danger d-none" onclick="refusePart( {{ $event->id }} )">Отказаться от участия</button>
@else
  <button id="buttonTekePart" class="btn btn-success d-none" onclick="takePart( {{ $event->id }} )">Принять участие</button>
  <button id="buttonRefusePart" class="btn btn-danger" onclick="refusePart( {{ $event->id }} )">Отказаться от участия</button>
@endif
</div>

<script>
  document.event_id = {{ $event->id }};
  
  window.addEventListener('load',function() {
    getParticipantList();
  });
</script>
@endsection