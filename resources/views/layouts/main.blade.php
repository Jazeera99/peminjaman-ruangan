<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://czzdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>

    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .main-layout {
            display: flex;
            flex-grow: 1;
            height: 100%;
        }

        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 0px;
        }

        .table-responsive {
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            max-width: 100%;
        }

        .main-footer {
            background-color: #f0f0f0; /* Warna abu-abu */
            color: #333; /* Warna teks */
            padding: 10px 20px; /* Jarak di dalam footer */
            text-align: center; /* Teks berada di tengah */
            font-size: 14px; /* Ukuran teks */
            height: auto; /* Tinggi bisa diatur, sesuaikan di sini */
            border-top: 1px solid #ddd; /* Opsional: garis atas footer */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-container {
            display: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .close-button {
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.5rem;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="main-layout">
        <!-- Sidebar -->
        @include('includes.main.sidebar')

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            @include('includes.main.navbar')
            <h1 class="mb-3" style="margin-left: 45px; margin-top: 10px; margin-bottom: 0px; color: black;">
                @if (Auth::user()->role == 'admin')
                    WELCOME TO ADMIN
                @elseif (Auth::user()->role == 'baak')
                    WELCOME TO BAAK
                @elseif (Auth::user()->role == 'sarpras')
                    WELCOME TO SARPRAS
                @else
                    WELCOME TO {{ strtoupper(Auth::user()->name) }}
                @endif
            </h1>

            <!-- Content Area -->
            <div class="content-area mt-1">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('includes.main.footer')
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
