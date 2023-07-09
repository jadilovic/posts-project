@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center m-5">Uredi Oglas</h1>

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

    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data" >
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="naslov" class="form-label">Naslov</label>
        <input type="text" name="naslov" id="naslov" class="form-control" value="{{ $post->naslov }}" required >
      </div>
      <div class="mb-3">
        <label for="opis" class="form-label">Opis</label>
        <textarea class="form-control" name="opis" id="opis" cols="30" rows="5" required>{{ $post->opis }}</textarea>
      </div>
      <div class="mb-3">
        <label for="cijena" class="form-label">Cijena</label>
        <input type="number" step="0.01" min="0" name="cijena" id="cijena" class="form-control" value="{{ $post->cijena }}" required >
      </div>
      <div class="mb-3">
        <label for="kontakt" class="form-label">Kontakt</label>
        <input type="text" name="kontakt" id="kontakt" class="form-control" value="{{ $post->kontakt }}" required >
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="status" id="status" class="form-check-input" {{$post->status ? 'checked' : ''}}>
        <label for="status" class="form-check-label">Aktivan</label>
      </div> 
      <div class="mb-3">
        <label for="kategorija" class="form-label">Kategorija</label>
        <select name="kategorija" id="kategorija" class="form-control">
          <option value="{{$post->category->id}}">{{$post->category->naziv}}</option>    
          @foreach ($kategorije as $kategorija)
              @if ($post->category_id != $kategorija->id)
                  <option value="{{$kategorija->id}}">{{$kategorija->naziv}}</option>
              @endif
          @endforeach
        </select>
      </div>
       @if ($post->slika)
          <div class="mb-3">
            <label for="trenutna-slika">Trenutn slika:</label>
            <img id="trenutna-slika" src="{{asset('storage/slike/' . $post->slika)}}" alt="post photo" style="max-width: 300px;" >
          </div>
      @else
          <div class="mb-3">
            <p>Trenutno nema slike.</p>
          </div>
      @endif
      <div class="mb-3">
        <label for="slika" class="form-label">Nova slika:</label>
        <input type="file" name="slika" id="slika" class="form-control" >
      </div>
      <button type="submit" class="btn btn-primary">Spremi</button>
    </form>
  </div>
@endsection