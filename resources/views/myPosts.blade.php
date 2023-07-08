@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Moji oglasi</h1>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <a href="{{route('addPostForm')}}" class="btn btn-success my-3 mb-4">Kreiraj novi oglas</a>

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
              {{-- <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-primary">Detalji</a> --}}
            <div class="card-body" style="display: flex; justify-content:space-between">
              <a href="#" class="btn btn-primary">Pogledaj detaljno</a>
              <a href="#" class="btn btn-secondary">Dodaj u favorite</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
