<header class="header-bg">
    <a href="{{ url('/') }}">
        <span class="logo-text">Employee Management System</span>
    </a>

    <div class="header-right-div">
        <span class="greating-text">
            <em>Hello, <strong>{{ session('username') }}</strong> </em>
        </span>
        <a href="{{ url('/logout') }}">
            <button class="logout-btn">Logout</button>
        </a>
    </div>
</header>
