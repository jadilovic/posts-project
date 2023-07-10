@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1>Oglas Detaljno</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">{{$post->naslov}}</h2>
              @if ($post->slika)
                <img src="{{asset('storage/slike/' . $post->slika)}}" class="card-img-top" alt="{{$post->naziv}}" >
              @endif
              <p class="card-text">{{$post->opis}}</p>
              <span>Kategorija: {{$post->category->naziv}}</span>
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