<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN | LPPM UNLA</title>
    <!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- Icon Shortcut --}}
    <link rel="shortcut icon" href="{{ asset('img/ikon/Unla.png') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('admintemp') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/dist/css/adminlte.min.css">
    @livewireStyles

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.827), rgba(0, 0, 0, 0.800)), url('{{ asset('admintemp/dist/img/UNLA.jpg') }}');
            background-position: center;
            background-size: cover;
            background-color: black;
        }

        .login_oueter {
            width: 360px;
            max-width: 200%;
        }

        .logo_outer {
            text-align: center;
        }

        .logo_outer img {
            width: 120px;
            margin-bottom: 40px;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center m-0" style="height: 100vh;">
            <div class="login_oueter">
                <form style="height: 450px" action="{{ url('proses_login') }}" method="post" id="login"
                    autocomplete="off" class="bg-white border p-3">
                    <div class="form-row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <div class="col-md-12 text-center logo_outer">
                            <img class="mb-4" src="{{ asset('img/ikon/unla.png') }}" alt="" width="72">
                        </div>
                        <div class="col-md-12 text-center justify-content-center">
                            <h1 class="h3 mb-3 fw-normal">Sistem Pengelolaan LPPM</h1>
                            <hr>
                        </div>
                        <div class="col-md-12 text-center justify-content-center">
                            <h1 class="h4 mb-3 fw-normal">Silahkan Login</h1>
                        </div>
                        <div class="col-12">
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('loginError') }}</strong> Salah !!!.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" placeholder="Masukan Username Anda ..." name="username">
                                @error('username')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong> Salah !!!.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password"
                                    class="input form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Masukan Password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <div class="form-group form-check text-left">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember_me" />
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                        </div> --}}
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn col-12 sidebar-dark-white text-white" type="submit"
                                name="signin">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        $('.alert').alert()
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
