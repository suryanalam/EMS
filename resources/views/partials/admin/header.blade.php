<header class="navbar navbar-expand-lg navbar-dark bg-dark px-3 py-2">
    <div class="container-fluid">
        <a href="{{ url('/') }}">
            <span class="logo-text">Employee Management System</span>
        </a>

        <div class="header-right-div">
            <span class="greating-text">
                <em>Hello, <strong>{{ Auth::guard('admin')->user()->name }}</strong></em>
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
                            <li class="mb-1"><a class="dropdown-item" href="{{ route('admin_profile') }}">My
                                    profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin_logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</header>
