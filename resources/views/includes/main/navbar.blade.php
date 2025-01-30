<nav class="navbar navbar-expand-lg" style="background-color: #FFF8F8; padding: 10px 50px 20px 20px;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#"><img src="../images/LOGO ULBI - WIDE DARK.png" alt="Logo ULBI" class="navbar-logo" style="height: 40px; margin-right: 10px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @if (Auth::user()->role == 'sarpras')
          <li class="nav-item">
            <a class="nav-link text-black" href="#"><i class="fas fa-user me-2">Hai, Sarpras</a>
          </li>
        @endif
        @if (Auth::user()->role == 'baak')
          <li class="nav-item">
            <a class="nav-link text-black" href="#"><i class="fas fa-user me-2">Hai, BAAK</a>
          </li>
        @endif
        @if (Auth::user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link text-black" href="#"><i class="fas fa-user me-2"></i>Hai, Admin</a>
          </li>
        @endif
        @if (Auth::user()->role == 'peminjam')
          <li class="nav-item">
            <a class="nav-link text-black" href="#"><i class="fas fa-user me-2">Hai, User</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Section -->
{{-- Navbar untuk Admin --}}
<nav>
  <div class="dashboard-container">
    <div class="dashboard-navbar" style="background-color: #fdfeff; padding: 10px; margin: -20px 40px 0 40px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); position: relative; z-index: 10;">
      <h2>Dashboard</h2>
      {{-- <h2>
        @if (Route::currentRouteName() === 'dashboard.admin')
          Dashboard
        @elseif (Route::currentRouteName() === 'kalendar.reservasi')
          Kalendar Peminjaman
        @elseif (Route::currentRouteName() === 'list.booking')
          List Booking
        @elseif (Route::currentRouteName() === 'list.user')
          Manage User
        @elseif (Route::currentRouteName() === 'list.ruangan')
          Manage Ruangan
        @else
          Admin
        @endif
      </h2> --}}
    </div>
  </div>  
</nav>

{{-- Navbar untuk User (Peminjam) --}}
<nav>
  <div class="dashboard-container">
    <div class="dashboard-navbar" style="background-color: #fdfeff; padding: 10px; margin: -20px 40px 0 40px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); position: relative; z-index: 10;">
      {{-- <h2>
        @if (Route::currentRouteName() === 'dashboard.peminjam')
          Dashboard
        @elseif (Route::currentRouteName() === 'kalendar.reservasi')
          Kalendar Peminjaman
        @elseif (Route::currentRouteName() === 'list.booking')
          List Booking
        @else
          (Route::currentRouteName())
        @endif
      </h2> --}}
    </div>
  </div>  
</nav>

{{-- Navbar untuk BAAK --}}
<nav>
  <div class="dashboard-container">
    <div class="dashboard-navbar" style="background-color: #fdfeff; padding: 10px; margin: -20px 40px 0 40px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); position: relative; z-index: 10;">
      {{-- <h2>
        @if (Route::currentRouteName() === 'dashboard.baak')
          Dashboard
        @elseif (Route::currentRouteName() === 'kalendar.reservasi')
          Kalendar Peminjaman
        @elseif (Route::currentRouteName() === 'list.booking')
          List Booking
        @elseif (Route::currentRouteName() === 'list.user')
          Manage User
        @elseif (Route::currentRouteName() === 'list.ruangan')
          Manage Ruangan
        @else
          BAAK
        @endif
      </h2> --}}
    </div>
  </div>  
</nav>

{{-- Navbar untuk SARPRAS --}}
<nav>
  <div class="dashboard-container">
    <div class="dashboard-navbar" style="background-color: #fdfeff; padding: 10px; margin: -20px 40px 0 40px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); position: relative; z-index: 10;">
      {{-- <h2>
        @if (Route::currentRouteName() === 'dashboard.baak')
          Dashboard
        @elseif (Route::currentRouteName() === 'kalendar.reservasi')
          Kalendar Peminjaman
        @elseif (Route::currentRouteName() === 'list.booking')
          List Booking
        @elseif (Route::currentRouteName() === 'list.user')
          Manage User
        @elseif (Route::currentRouteName() === 'list.ruangan')
          Manage Ruangan
        @else
          SARPRAS
        @endif
      </h2> --}}
    </div>
  </div>  
</nav>
