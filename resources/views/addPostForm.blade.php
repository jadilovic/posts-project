@extends('layouts.layout')

{{-- @section('navigation')
  @include('partials.header')
@endsection --}}

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Kreiraj novi oglas</h1>
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" >
      @csrf
      <div class="mb-3">
        <label for="naslov" class="form-label">Naslov</label>
        <input type="text" name="naslov" id="naslov" class="form-control" required >
      </div>
      <div class="mb-3">
        <label for="opis" class="form-label">Opis</label>
        <textarea class="form-control" name="opis" id="opis" cols="30" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="cijena" class="form-label">Cijena</label>
        <input type="number" step="0.01" min="0" name="cijena" id="cijena" class="form-control" required >
      </div>
      <div class="mb-3">
        <label for="kontakt" class="form-label">Kontakt</label>
        <input type="text" name="kontakt" id="kontakt" class="form-control" required >
      </div>
      <div class="mb-3">
        <label for="kategorija" class="form-label">Kategorija</label>
        <select name="kategorija" id="kategorija" class="form-control" required>
          <option value="">Odaberi kategoriju</option>
          @foreach ($kategorije as $kategorija)
              <option value="{{$kategorija->id}}">{{$kategorija->naziv}}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="slika" class="form-label">Slika</label>
        <input type="file" name="slika" id="slika" class="form-control" >
      </div>
      <button type="submit" class="btn btn-primary">Kreiraj</button>
    </form>
  </div>
@endsection
