@extends('layouts.layout')

@section('navigation')
  @include('partials.header')
@endsection

<?php use App\Models\User; ?>

@section('content')
  <div class="container">
    <h1 class="text-center m-5" >Moji chats</h1>
    <div class="row row-gap-3">
      @foreach ($chats as $chat)
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Chat ID: {{$chat->id}}</h5>
              <p class="card-text"><b>Korisnik 1:</b> {{User::findOrFail($chat->user1_id)->name}}</p>
              <p class="card-text"><b>Korisnik 2:</b> {{User::findOrFail($chat->user2_id)->name}}</p>
            </div>
            <div class="card-body">
              <a href="{{route('chatForm', ['chatId' => $chat->id])}}" class="btn btn-secondary">Otvori chat</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
