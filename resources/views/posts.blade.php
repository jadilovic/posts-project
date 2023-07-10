@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Pregled oglasa po kategorijama</h1>
    <div class="row m-5">
      <div class="col-md-12">
        <div class="btn-group" role="group" aria-label="Kategorije">
          <a href="{{route('posts', ['categoryId' => 0])}}" class="btn btn-primary">Svi oglasi</a>
          @foreach ($categories as $category)
              <a href="{{route('posts', ['categoryId' => $category->id])}}" class="btn btn-primary">{{$category->naziv}}</a>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row row-gap-3">
      @foreach ($posts as $post)
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
              <a href="#" class="btn btn-secondary">Dodaj u favorite</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
