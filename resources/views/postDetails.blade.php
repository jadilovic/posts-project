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
  </div>
@endsection