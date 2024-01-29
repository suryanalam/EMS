<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons v1.5.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Bootstrap Script v5.3.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('styles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/main.css') }}">

    <title>Employee Dashboard</title>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark px-3 py-2">
        <div class="container-fluid">
            <a href="{{ url('/employee/dashboard') }}">
                <span class="logo-text">Employee Management System</span>
            </a>
    
            <div class="header-right-div">
                <span class="greating-text">
                    <em>Hello, <strong>{{ Auth::guard('web')->user()->name }}</strong></em>
                </span>
    
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle" style="font-size: 1.6rem;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end px-3"
                                aria-labelledby="navbarDarkDropdownMenuLink">
                                <li class="mb-1"><a class="dropdown-item" href="{{ route('employee_profile') }}">My
                                        profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
    
        </div>
    </header>
    <main class="text-center">
        <h1 class="m-2">Employee Dashboard</h1>
    </main>
</body>
</html>