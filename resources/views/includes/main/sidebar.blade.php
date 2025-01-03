<div class="sidebar" style="width: 250px; background-color: #0066f5; color: white; height: 100%; display: flex; flex-direction: column;">
  <div class="sidebar-header" style="text-align: center; padding: 15px; font-size: 18px; font-weight: bold; color: #f8f9fa; border-bottom: 1px solid #495057;">
    ROOMEASE
  </div>
  <ul class="nav flex-column sidebar-menu">
    
    {{-- @if (Auth::user()->role == 'USER') --}}
      {{-- <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('user.dashboard') }}"><i class="fas fa-fire me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.kalendar-reservasi') }}"><i class="fas fa-door-open me-2"></i>Kalendar Peminjaman</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.list-booking') }}"><i class="fas fa-list me-2"></i>List Booking </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('user/profil') }}"><i class="fas fa-key me-2"></i>Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-key me-2"></i>Ganti Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
      </li> 
    @endif --}}

    {{-- @if (Auth::admin()->role == 'ADMIN') --}}
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.kalendar-reservasi') }}"><i class="fas fa-door-open me-2"></i>Kalendar Peminjaman</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.list-booking') }}"><i class="fas fa-list me-2"></i>List Booking </a>
      </li>
      <li class="nav-item dropdown"> 
        <a class="nav-link text-white dropdown-toggle" id="dataUserdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-list me-2"></i>Manage User</a>
        <ul class="dropdown-menu" aria-labelledby="dataUserDropdown">
          <li><a class="dropdown-item" href="includes/content/tables/user-baak">BAAK</a></li>
          <li><a class="dropdown-item" href="includes/content/tables/user-sarpras">Sarpras</a></li> 
        </ul>
      </li>
      <li class="nav-item dropdown"> 
        <a class="nav-link text-white dropdown-toggle" id="dataRuangandropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-list me-2"></i>Manage Ruangan</a>
        <ul class="dropdown-menu" aria-labelledby="dataRuanganDropdown">
          <li><a class="dropdown-item" href="/includes/content/tables/data-ruangan">BAAK</a></li>
          <li><a class="dropdown-item" href="/includes/content/tables/data-ruangan">Sarpras</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('user/profil') }}"><i class="fas fa-key me-2"></i>Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-key me-2"></i>Ganti Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
      </li>
    {{-- @endif --}}

    {{-- @if (Auth::baak()->role == 'BAAK') --}}
      {{-- <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('baak.dashboard') }}"><i class="fas fa-fire me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.kalendar-reservasi') }}"><i class="fas fa-door-open me-2"></i>Kalendar Peminjaman</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.list-booking') }}"><i class="fas fa-list me-2"></i>List Booking </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('includes.content.tables.data-ruangan') }}"><i class="fas fa-list me-2"></i>Manage Ruangan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-key me-2"></i>Ganti Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
      </li> --}}
    {{-- @endif --}}

    {{-- @if (Auth::sarpras()->role == 'SARPRAS') --}}
      {{-- <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('sarpras.dashboard') }}"><i class="fas fa-fire me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.kalendar-reservasi') }}"><i class="fas fa-door-open me-2"></i>Kalendar Peminjaman</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.list-booking') }}"><i class="fas fa-list me-2"></i>List Booking </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('includes.content.tables.data-ruangan') }}"><i class="fas fa-list me-2"></i>Manage Ruangan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-key me-2"></i>Ganti Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
      </li> --}}
  {{-- @endif --}}
  </ul>
</div>