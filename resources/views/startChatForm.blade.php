@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Poruke</h1>
    @if ($chat->messages->count() > 0)
        <h3>Poruke:</h3>
        <ul class="list-group">
          @foreach ($chat->messages as $message)
              <li class="list-group-item">
                <p>{{$message->content}}</p>
              </li>
          @endforeach
        </ul>
    @else
        <p>Trenutno nema poruka</p>
    @endif
    <h3>Unesite poruku:</h3>
    <form action="{{route('message.store')}}" method="post">
      @csrf
      <input type="hidden" name="chat_id" value="{{$chat->id}}">
      <div class="form-group">
        <label for="content">Sadrzaj:</label>
        <textarea name="content" id="content" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Posalji poruku</button>
    </form>
  </div>
@endsection
