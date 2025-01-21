<!-- KOtak Statistik Pengguna -->
@if (Auth::user()->role == 'admin')
    <div class="card-body d-flex align-items-center justify-content-center shadow-sm border-0 text-center" 
         style="width: 275px; height: 150px; position: center; top: 75%; left: 50%; margin-left: 50px;">
        <img src="../images/logo-user-pengguna.png" alt="PENGGUNA" 
             style="width: 80px; height: auto; max-width: 100%; object-fit: contain; margin-right: 20px;">
        <div class="text-start">
            <h5 class="mb-0">PENGGUNA</h5>
            <h1 class="mt-2">10</h1>
        </div>
    </div>
@endif

@if (Auth::user()->role == 'baak')
<div class="card shadow-sm border-0 text-center  col-sm-5" style="width: 250px; height: 150px; display: flex; align-items: center; ">
    <div class="card-body" style="display: flex; align-items: center; justify-content: space-between;">
        <img src="../images/logo-user-pengguna.png" alt="PENGGUNA" class="mb-2" style="width: 80px; height: auto; max-width: 100%; object-fit: contain; margin-right: 20px;">
        <div>
            <h5 class="mb-0">PENGGUNA</h5>
            <h1 class="mt-2">5</h1>
        </div>
    </div>
</div> 
@endif

@if (Auth::user()->role == 'sarpras')
<div class="card shadow-sm border-0 text-center" style="width: 250px; height: 150px; display: flex; align-items: center;">
    <div class="card-body" style="display: flex; align-items: center; justify-content: space-between;">
        <img src="../images/logo-user-pengguna.png" alt="PENGGUNA" class="mb-2" style="width: 80px; height: auto; max-width: 100%; object-fit: contain; margin-right: 20px;">
        <div>
            <h5 class="mb-0">PENGGUNA</h5>
            <h1 class="mt-2">2</h1>
        </div>
    </div>
</div>
@endif

