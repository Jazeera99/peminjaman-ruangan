<div class="sidebar" style="width: 250px; background-color: #0066f5; color: white; height: 100%; display: flex; flex-direction: column;">
  <div class="sidebar-header" style="text-align: center; padding: 15px; font-size: 18px; font-weight: bold; color: #f8f9fa; border-bottom: 1px solid #495057;">
    <button class="btn-toggle" id="toggleSidebar" style="background: none; border: none; color: white; position: absolute; left: 210px; padding: 0; outline: none;">
        <i class="fas fa-bars" style="margin: 0; padding: 0;"></i>
    </button>
    <img src="../images/logo-roomease.png" alt="Logo ROOMEASE" class="navbar-logo" style="height: 100px;"></a>
</div>
  <ul class="nav flex-column sidebar-menu">

      {{-- Sidebar untuk Admin --}}
      @if (Auth::user()->role == 'admin')
          <li class="nav-item">
              <a class="nav-link text-white" href="/dashboard/admin"><i class="fas fa-fire me-2"></i>Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('kalendar.reservasi', ['role' => 'admin']) }}"><i class="fas fa-calendar-alt me-2"></i>Kalendar Peminjaman</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="/list/list-booking"><i class="fas fa-list me-2"></i>List Booking</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('user.table') }}"><i class="fas fa-user me-2"></i>Manage User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('rooms.table', ['role' => Auth::user()->role]) }}"><i class="fas fa-door-open me-2"></i>Manage Ruangan</a>
          </li>
          <li class="nav-item">
              <!-- Form logout -->
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="nav-link text-white" style="background: none; border: none;">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
              </form>
          </li>
      @endif

      {{-- Sidebar untuk Ormawa dan UKM --}}
      @if (Auth::user()->role == 'ormawa' || Auth::user()->role == 'ukm')
          <li class="nav-item">
              <a class="nav-link text-white" href="/dashboard/peminjam"><i class="fas fa-fire me-2"></i>Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('kalendar.reservasi', ['role' => 'ormawa', 'ukm']) }}"><i class="fas fa-calendar-alt me-2"></i>Kalendar Peminjaman</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('booking') }}"><i class="fas fa-list me-2"></i>Form Peminjaman</a>
          </li>
          <li class="nav-item">
              <!-- Form logout -->
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="nav-link text-white" style="background: none; border: none;">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
              </form>
          </li>
      @endif

      {{-- Sidebar untuk BAAK --}}
      @if (Auth::user()->role == 'baak')
          <li class="nav-item">
              <a class="nav-link text-white" href="/dashboard/baak"><i class="fas fa-fire me-2"></i>Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('kalendar.reservasi', ['role' => 'baak']) }}"><i class="fas fa-calendar-alt me-2"></i>Kalendar Peminjaman</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="/baak/list-booking"><i class="fas fa-list me-2"></i>List Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('rooms.table', ['role' => Auth::user()->role]) }}"><i class="fas fa-door-open me-2"></i>Manage Ruangan</a>
          </li>
          <li class="nav-item">
              <!-- Form logout -->
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="nav-link text-white" style="background: none; border: none;">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
              </form>
          </li>
      @endif

      {{-- Sidebar untuk Sarpras --}}
      @if (Auth::user()->role == 'sarpras')
          <li class="nav-item">
              <a class="nav-link text-white" href="/dashboard/sarpras"><i class="fas fa-fire me-2"></i>Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('kalendar.reservasi', ['role' => 'sarpras']) }}"><i class="fas fa-door-open me-2"></i>Kalendar Peminjaman</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="/sarpras/list-booking"><i class="fas fa-list me-2"></i>List Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('rooms.table', ['role' => Auth::user()->role]) }}"><i class="fas fa-door-open me-2"></i>Manage Ruangan</a>
          </li> 
          <li class="nav-item">
              <!-- Form logout -->
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="nav-link text-white" style="background: none; border: none;">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
              </form>
          </li>
      @endif

  </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleSidebar");
        const mainContent = document.getElementById("mainContent");

        // Default: sidebar ditampilkan
        let sidebarVisible = true;

        toggleButton.addEventListener("click", function () {
            if (sidebarVisible) {
                // Sembunyikan sidebar
                sidebar.style.transform = "translateX(-250px)";
                mainContent.style.marginLeft = "0";
            } else {
                // Tampilkan sidebar
                sidebar.style.transform = "translateX(0)";
                mainContent.style.marginLeft = "250px";
            }
            sidebarVisible = !sidebarVisible; // Toggle status
        });
    });
</script>




