<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kelola Laundry - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side: Login Form -->
            <div class="login-form">
                 <!-- Bagian Pesan Kesalahan -->
                 @if (\Session::has('message'))
                 <div class="alert alert-danger">
                     {!! \Session::get('message') !!}
                 </div>
             @endif
                <h1>Login</h1>
                <form action="{{ url('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" placeholder="Masukkan Username" name="username" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" placeholder="Masukkan Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </form>
            </div>

            <!-- Right Side: Information Section -->
            <div class="login-primary">
                {{-- <h2>Solusi Pengelolaan Laundry Anda</h2> --}}
                <img src="{{ asset('img/laundry.jpg') }}" alt="Info Image">
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
