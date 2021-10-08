<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bangku Privat | Daftar </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('TemplateHome/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('TemplateHome/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('TemplateHome/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition register-page">
    <div class="register-box">


        <div class="card">
            <div class="register-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ url('TemplateHome/dist/img/logo_BP.png') }}" width="100" alt="">
                </a>
            </div>

            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar Baru dan Temukan Mentor Anda</p>
                <!-- Alert Status -->
                @if (session('failed'))
                 <div class="alert alert-danger">
                     {{ session('failed') }}
                 </div>
                @endif
                <form class="form-horizontal" action="{{ url('/registeruser') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control " name="name" placeholder="Nama Lengkap"
                            title="Silahkan isikan nama anda" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-field1" type="password" class="form-control" name="password"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span toggle="#password-field1" class="fas fa-eye-slash toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="icheck-primary col-12">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms">
                                Saya menyetujui <a href="#">syarat & ketentuan</a>
                            </label>
                        </div>

                        <!-- /.col -->
                        <div class="col-12 btndaftar">
                            <button type="submit" class="btn btn-primary btn-block" value="submit">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <span>Sudah punya akun ?</span><a href="{{ route('login') }}" class="text-center"> Masuk</a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    @include('Template_homepage.script')
</body>

</html>
