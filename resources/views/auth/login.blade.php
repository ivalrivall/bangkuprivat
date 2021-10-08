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
<div class="modal fade" id="ModalLupaSandi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lupa Kata Sandi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancel_reset();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" action="{{url('/reset/password')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="">Email Anda</label>
            <input id="send_email" type="email" name="email_anda" class="form-control" placeholder="Masukkan Email Anda." required>
          </div>
          <div class="form-group">
            <button id="btn-send-kode" type="button" class="btn btn-info" onclick="send_kode();"><i class="fas fa-sign-in"></i> Send Kode</button>
            <p style="display:none;" id="alert-email-success" class="text-success">Kode Verifikasi Telah Dikirim Ke Email Anda.</p>
            <p style="display:none;" id="alert-email-failed" class="text-danger">Email Tidak Terdaftar !!!</p>
          </div>
          <div id="div_kode" class="form-group" style="display:none;">
            <label for="">Silahkan Masukkan Kode Anda</label>
            <input id="kode_from_email" type="text" name="kode_from_email" class="form-control" placeholder="Masukkan Kode Di Email Anda." required>
          </div>
          <div class="form-group">
            <button id="btn-verif-kode" style="display:none;" type="button" class="btn btn-info" onclick="verif_kode();"><i class="fas fa-sign-in"></i> Verifikasi Kode</button>
            <p style="display:none;" id="alert-verif-success" class="text-success">Kode Verifikasi Anda Benar, Silahkan Masukkan Password Anda.</p>
            <p style="display:none;" id="alert-verif-failed" class="text-danger">Kode Verifikasi Anda Salah, Silahkan Masukkan Kode Anda Dengar Benar.</p>
          </div>
          <div id="div_new_password" class="form-group" style="display:none;">
            <label for="">Silahkan Masukkan Password Baru Anda</label>
            <input id="new_pass" type="password" name="new_pass" class="form-control" placeholder="Masukkan Password Baru Anda." required>
          </div>
          <div id="div_conf_new_password" class="form-group" style="display:none;">
            <label for="">Konfirmasi Password Baru Anda</label>
            <input id="conf_new_pass" type="password" name="new_pass" class="form-control" placeholder="Konfirmasi Password Baru Anda." required>
            <p style="display:none;" id="error_pass" class="text-danger">Password Tidak Sama !!!</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel_reset();"><i class="fas fa-times"></i> Close</button>
          <button id="btn-save" style="display:none;" type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i class="fas fa-sign-in"></i> Save Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function send_kode() {
    var email = $('#send_email').val();
    $.ajax({
         async: false,
         type:'get',
         url:'{{url('/lupa_pass/send/email')}}',
         data:{ _token : '{{ csrf_token() }}',
              email : email }
         ,success:function(response){
         respon = $.parseJSON(response);
            if(respon.response == 'success')
            {
                $('#alert-email-success').show();
                $('#alert-email-failed').hide();
                $('#div_kode').show();
                $('#btn-verif-kode').show();
            }else{
                $('#alert-email-success').hide();
                $('#alert-email-failed').show();
                $('#div_kode').hide();
                $('#btn-verif-kode').hide();
            }
         },
    });
  }
  function verif_kode() {
    $('#alert-email-success').hide();
    $('#alert-email-failed').hide();
    var kode_from_email = $('#kode_from_email').val();
    $.ajax({
         async: false,
         type:'get',
         url:'{{url('/lupa_pass/verif/kode')}}',
         data:{ _token : '{{ csrf_token() }}',
              kode_from_email : kode_from_email }
         ,success:function(response){
         respon = $.parseJSON(response);
            if(respon.response == 'success')
            {
                $('#alert-verif-success').show();
                $('#alert-verif-failed').hide();
                $('#div_new_password').show();
                $('#div_conf_new_password').show();
                $('#btn-save').show();
            }else{
                $('#alert-verif-success').hide();
                $('#alert-verif-failed').show();
                $('#div_new_password').hide();
                $('#div_conf_new_password').hide();
                $('#btn-save').hide();
            }
         },
    });
  }
// get form input verifikasi kode
var kode_from_email = document.getElementById("kode_from_email");
kode_from_email.addEventListener("keyup", function(e) {
    $('#alert-email-success').hide();
    $('#alert-email-failed').hide();
});
// get form input confirm password
var conf_new_pass = document.getElementById("conf_new_pass");
conf_new_pass.addEventListener("keyup", function(e) {
    $('#alert-verif-success').hide();
    $('#alert-verif-failed').hide();
    conf_new_pass.value = this.value;
    var val_conf_pass = conf_new_pass.value;
    var new_pass = $('#new_pass').val();
    if(new_pass != val_conf_pass){
      $('#error_pass').show();
      $('#btn-save').prop('disabled',true);
    }else{
      $('#error_pass').hide();
      $('#btn-save').prop('disabled',false);
    }
});

function cancel_reset() {
  $('#send_email').val("");
  $('#alert-email-success').hide();
  $('#alert-email-failed').hide();
  $('#div_kode').hide();
  $('#kode_from_email').val("");
  $('#btn-verif-kode').hide();
  $('#alert-verif-success').hide();
  $('#alert-verif-failed').hide();
  $('#div_new_password').hide();
  $('#div_conf_new_pass').hide();
  $('#new_pass').val("");
  $('#conf_new_pass').val("");
  $('#error_pass').hide();
  $('#btn-save').hide();
}
</script>
    @include('Template_homepage.script')
</body>

</html>
