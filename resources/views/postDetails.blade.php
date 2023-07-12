@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

<?php use App\Models\Favorite; ?>

@section('content')
  <div class="container">
    <h1 style="margin: 1em">Oglas Detaljno</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-body" style="text-align: center">
              <h2 class="card-title">{{$post->naslov}}</h2>
            </div>
            <div class="card-body">
              @if ($post->slika)
                <img src="{{asset('storage/slike/' . $post->slika)}}" class="card-img-top" alt="{{$post->naziv}}" >
              @endif
            </div>
             <div class="card-body">
              <span><b>Kategorija:</b> {{$post->category->naziv}}</span>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Opis:</b> {{$post->opis}}</li>
              <li class="list-group-item"><b>Cijena:</b> {{$post->cijena}}KM</li>
              <li class="list-group-item"><b>Objavio:</b> {{$post->user->name}}</li>
              <li class="list-group-item"><b>Kontakt:</b> {{$post->kontakt}}</li>
            </ul>
            <div class="card-body" style="display: flex; justify-content:space-between">
              <a href="{{route('startChatForm', ['userId' => $post->user->id])}}" class="btn btn-secondary">Posalji poruku vlasniku</a>
                @if (Favorite::where('user_id', Auth::id())->where('post_id', $post->id)->get()->count() > 0)
                  <a href={{ route('myFavorites') }} class="btn btn-success">Dodan u favorite</a>
                @else
                  <form style="display: inline;" action="{{ route('favorites')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <button type="submit" class="btn btn-warning">Dodaj u favorite</button>
                  </form>
                @endif
            </div>
          </div>
        </div>
    </div>
    {{-- @if ($post->comments->count() > 0)
        <h3>Komentari:</h3>
        <ul class="list-group">
          @foreach ($post->comments as $comment)
              <li class="list-group-item">
                <strong>{{$comment->ime}}</strong>
                <span class="badge badge-primary">{{$comment->email}}</span>
                <p>{{$comment->tekst}}</p>
              </li>
          @endforeach
        </ul>
    @else
        <p>Trenutno nema komentara</p>
    @endif --}}
    {{-- <h3>Unesite komentar:</h3>
    <form action="{{route('comments.store')}}" method="post">
      @csrf
      <input type="hidden" name="post_id" value="{{$post->id}}">
      <div class="form-group">
        <label for="ime">Ime:</label>
        <input type="text" name="ime" id="ime" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="tekst">Tekst:</label>
        <textarea name="tekst" id="tekst" class="form-control"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Dodaj komentar</button>
    </form> --}}
  </div>
@endsection