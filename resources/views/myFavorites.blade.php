@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

<?php use App\Models\Favorite; ?>

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Moji favoriti</h1>
    @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">
        {{session('error')}}
      </div>
    @endif
    <div class="row row-gap-3">
      @if (sizeof($favoritePosts) < 1)
          <h3 class="text-center m-5">Nema dodanih favorit oglasa</h3>
      @else
        @foreach ($favoritePosts as $post)
          <div class="col-md-4">
            <div class="card">
              @if ($post->slika)
                <img src="{{asset('storage/slike/' . $post->slika)}}" class="card-img-top" alt="{{$post->naslov}}" >
              @endif
              <div class="card-body">
                <h5 class="card-title">{{$post->naslov}}</h5>
                <p class="card-text">{{$post->opis}}</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Kategorija:</b> {{$post->category->naziv}}</li>
                <li class="list-group-item"><b>Cijena:</b> {{$post->cijena}}KM</li>
                <li class="list-group-item"><b>Objavio:</b> {{$post->user->name}}</li>
                <li class="list-group-item"><b>Kontakt:</b> {{$post->kontakt}}</li>
              </ul>
              <div class="card-body" style="display: flex; justify-content:space-between">
                <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-primary">Pogledaj Detaljno</a>
                <form style="display: inline;" action="{{ route('favorite.delete', $post->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Izbrisi favorite</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection
