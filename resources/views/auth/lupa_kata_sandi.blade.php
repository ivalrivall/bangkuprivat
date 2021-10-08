<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bangku Privat | Masuk </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/TemplateHome/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('/TemplateHome/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/TemplateHome/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card">
            <div class="login-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('TemplateHome/dist/img/logo_BP.png') }}" width="100" alt="">
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk menemukan mentor Anda</p>
                <!-- Alert Status -->
                @if (session('success'))
                 <div class="alert alert-success">
                    {{ session('success') }}
                 </div>
                @endif
                @if (session('failed'))
                 <div class="alert alert-danger text-center">
                     {{ session('failed') }}
                 </div>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3 col-12">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 col-12">
                        <input id="password-field" type="password" class="form-control" name="password"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span toggle="#password-field" class="fas fa-eye-slash toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 btndaftar">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- <div class="social-auth-links text-center mb-3 col-12 btndaftar">
                        <p>Atau</p>
                        <a href="" class="btn btn-block btn-danger">
                            <i class="fab fa-google mr-2"></i> Masuk dengan Google
                        </a>
                    </div> -->
                    <p class="mb-1 col-12">
                        <a href="#" type="button" data-toggle="modal" data-target="#ModalLupaSandi" >Saya lupa kata sandi</a>
                    </p>
                    <p class="mb-0 col-12">
                        Belum Punya Akun ?<a href="{{ route('register') }}" class="text-center"> Daftar Baru</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
<!-- Modal Lupa Kata Sandi-->
<!-- <div class="modal fade" id="ModalLupaSandi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lupa Kata Sandi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" action="#" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="">Email Anda</label>
            <input type="email" name="email_anda" class="form-control" placeholder="Masukkan Email Anda." required>
          </div>
          <button id="btn-send-kode" type="button" class="btn btn-info" onclick="send_kode();"><i class="fas fa-sign-in"></i> Send Kode</button>
          <div id="div_kode" class="form-group" style="display:none;">
            <label for="">Silahkan Masukkan Kode Anda</label>
            <input type="text" name="kode_from_email" class="form-control" placeholder="Masukkan Kode Di Email Anda." required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in"></i> Verifikasi</button>
        </div>
      </form>
    </div>
  </div>
</div> -->
    @include('Template_homepage.script')
</body>

</html>
