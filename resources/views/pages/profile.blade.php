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

    <!-- Real Time Notifications -->
    <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('styles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/main.css') }}">

    <title>Employee Profile</title>

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
    <main class="main-section"> 
        <div class="container bg-white my-4">
            <div class="row d-flex align-items-start justify-content-center">
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center gap-2 p-3">
                        <img width="150px"
                            src="{{ asset("uploads/$employee->photo") }}">
    
                        <form action="{{ route('update_employee_profile') }}" method="POST"  enctype="multipart/form-data" class="d-flex flex-column gap-2 mt-2">
                            @csrf
    
                            <input type="hidden" name="eid" value="{{ $employee->eid }}">
    
                            <input id="file-upload" type="file" name="photo" class="btn btn-secondary btn-sm" required>
    
                            @error('photo')
                                <p class="text-danger" style="font-size: 14px">{{ $message }}</p>
                            @enderror
    
                            <button class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-2" type="submit" >
                                <i class="bi bi-cloud-arrow-up-fill" style="font-size: 1.25rem"></i> Upload
                            </button>
                            
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="px-2 py-4">
                        <div class="d-flex flex-column align-items-start gap-3">
    
                            <h4 class="text-right">My Profile</h4>
    
                            <form action="{{ route('update_employee_profile') }}" method= "POST" class="w-100">
                                @csrf
    
                                <input type="hidden" name="eid" value="{{ $employee->eid }}">
    
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" value="{{ $employee->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" name="password" >
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div>
                                    <button type="submit" class="btn btn-primary my-auto mx-1">Update Profile</button>
                                    <a href="{{ url('/employee/dashboard') }}" class="btn btn-secondary my-auto mx-1" role="button">
                                        Go to Home</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if (session()->get('error'))
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('error') }}',
            });
        </script>
    @endif

    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('success') }}',
            });
        </script>
    @endif

</body>
</html>
