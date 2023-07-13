@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Chat ID: {{$chat->id}}</h1>
    @if ($chat->messages->count() > 0)
        <ul class="list-group">
          <h3>Korisnik: {{$userName2 === Auth::user()->name ? $userName1 : $userName2}}</h3>
          @foreach ($chat->messages as $message)
              <li style="{{Auth::id() === $message->user_id ? 'margin-left: 4em; background-color: lightgreen;' : ''}}" class="list-group-item">
                <p>{{$message->content}}</p>
              </li>
          @endforeach
        </ul>
    @else
        <p>Trenutno nema poruka</p>
    @endif
    <h3 style="margin-top: 1em">Poruka</h3>
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
