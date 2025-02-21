<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
  <div class="container">
    <a class="navbar-brand d-inline-flex" href="{{ url('/site') }}">
      <img class="d-inline-block" src="assets/img/gallery/logo.svg" alt="logo" />
      <span class="text-1000 fs-3 fw-bold ms-2 text-gradient">Irukka?</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      @if (Request::is('site') || Request::is('/'))
        <div class="mx-auto pt-5 pt-lg-0 d-block d-lg-none d-xl-block">
          <p class="mb-0 fw-bold text-lg-center"><i class="fas fa-map-marker-alt text-warning mx-2"></i><span class="fw-normal">Current Location </span><span>Cuddalore, Tamil Nadu</span></p>
        </div>
      @endif
      <ul class="navbar-nav ms-auto">

        @auth
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown">
              {{ Auth::user()->name ?? 'Guest' }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li><a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">Profile</a></li>
              @if (Auth::user()->role == 'admin' || Auth::user()->role == 'owner') 
              <li><a class="dropdown-item {{ Request::is('shops*') ? 'active' : '' }}" href="{{ url('/shops') }}">Shops</a></li>
              @endif
              @if (Auth::user()->role == 'admin') 
              <li><a class="dropdown-item {{ Request::is('users*') ? 'active' : '' }}" href="{{ url('/users') }}">Users</a></li>
              @endif
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <a
            href="{{ route('login') }}"
            class="btn btn-white shadow-warning text-warning"
          >
            Log in @if (Route::has('register'))/ Register @endif
          </a>
        @endauth
        
      </ul>
    </div>
  </div>
</nav>