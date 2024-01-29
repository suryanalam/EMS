<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google fonts CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="{{ asset('styles/auth.css') }}">
    <title>Admin Login</title>
</head>

<body>
    <section class="form-bg">
        <div class="login-bar">
            <div class="login-active">
                <a href="{{ route('admin_login') }}" class="login-bar-link">Admin</a>
            </div>
            <div>
                <a href="{{ route('login') }}" class="login-bar-link">Employee</a>
            </div>
        </div>
        <div class="form-main-div">
            <form action="{{ route('admin_login') }}" method="post" class="form-div">
                @csrf
                <div class="form-input-div">
                    <label for="email">Email:</label>
                    <input type='email' name='email' class="join-input-fields" value="{{ old('email') }}" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-input-div">
                    <label for="password">Password: </label>
                    <input type='password' name='password' class="join-input-fields" />
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="join-btn">Login</button>
            </form>
        </div>
    </section>
</body>

</html>