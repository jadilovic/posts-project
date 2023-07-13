<nav class="navbar navbar-expand-lg bg-body-tertiary">
   <!-- Authentication -->
    <?php
      function isLoggedIn() {
        try {
          return Auth::check();
        } catch (\Throwable $th) {
          return false;
        }
      }
    ?>
  <div class="container">
    <a class="navbar-brand" href={{ route('home') }}>Oglasi Aplikacija</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href={{ route('dashboard') }}>Dashboard</a>
        </li>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href={{ route('posts', ['categoryId' => 0]) }}>Svi oglasi</a>
        </li>
        @if (isLoggedIn())
          <li class="nav-item">
            <a class="nav-link" href={{ route('myPosts') }}>Moji oglasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{ route('myFavorites') }}>Moji favoriti</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{ route('chats') }}>Poruke</a>
          </li>
        @endif
      </ul>
      <div style="align-items: center;" class="d-flex">
        <p style="font-weight: 700; margin: 0; ">{{Auth::user() ? Auth::user()->name : 'Gost'}}</p>
        @if (isLoggedIn())
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a
                class="btn btn-outline-secondary m-2"
                :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();"
              >
               {{ __('Log Out') }}
              </a>
          </form>
        @else
             <a href="{{ route('login') }}" class="btn btn-outline-success m-2">Login</a>
             <a href="{{ route('register') }}" class="btn btn-secondary m-2">Register</a>
        @endif
    </div>
  </div>
</nav>
