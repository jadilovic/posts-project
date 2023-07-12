@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

<?php use App\Models\Favorite; ?>

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Pregled oglasa po kategorijama</h1>
    
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
      @endforeach
    </div>
  </div>
@endsection
