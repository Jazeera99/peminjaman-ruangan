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
            background-color: #f8f9fa;
            padding: 20px;
        }

        .table-responsive {
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
        }

        table {
            width: 100%;
            max-width: 100%;
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

            <!-- Content Area -->
            <div class="content-area mt-4">
                @yield('content')
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
