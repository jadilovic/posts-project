<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
          <a class="nav-link" href={{ route('dashboard') }}>Blogovi Kartice</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href={{ route('blogs') }}>Blogovi Kartice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('jobs') }}>Poslovi Kartice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('blogs.filter', ['category' => 1]) }}>Blogs Filter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('jobs.filter', ['category' => 1]) }}>Jobs Filter</a>
        </li> --}}
      </ul>
      <div class="d-flex">
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
