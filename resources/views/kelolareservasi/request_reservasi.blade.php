@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-primary" style="font-size:40px;">REQUEST RESERVASI</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item active">Request Reservasi</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if (session('failed'))
        <div class="alert alert-danger">
          {{ session('failed') }}
        </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Request Reservasi</h3>
          </div><br>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-hover text-center" style="width:100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th style="display:none;">id_reservasi</th>
                    <th>Email</th>
                    <th>Nama Murid</th>
                    <th>Jenis Kelamin</th>
                    <th>No. HP</th>
                    <th>Kebutuhan</th>
                    <th>Spesifikasi Kebutuhan</th>
                    <th>Nama Mentor</th>
                    <th>Status</th>
                    <th style="display:none;">pembayaran_id</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @foreach($data_reservasi as $key => $val)
                  <tr>
                    <td>{{$no++}}.<a href="{{ url('/reservasi/detail/'.$val->id) }}" type="button"
                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    </td>
                    <td style="display:none;">{{$val->id}}</td>
                    <td>{{$val->user->email}}</td>
                    <td>{{$val->user->nama}}</td>
                    <td>{{$val->user->gender->gender}}</td>
                    <td>{{$val->user->no_hp}}</td>
                    <td>{{$val->kebutuhan->kebutuhan}}</td>
                    <td>{{substr($val->detail_kebutuhan, 0, 30)}}...</td>
                    <td>{{$val->mentor->nama}}</td>
                    <td>{{$val->status->status}}</td>
                    <td style="display:none;">{{$val->pembayaran_id}}</td>
                    <td>
                      @if(auth()->user()->level_id == 3)
                      @if($val->status_id == 3)
                      <a href="{{ url('/request_reservasi/approve/'.$val->id) }}" type="button"
                        class="btn btn-sm btn-success" title="Terima Reservasi"><i class="fas fa-check"></i></a>
                      <a type="button" data-toggle="modal" data-target="#Modal_Penolakan" class="btn btn-sm btn-danger"
                        title="Tolak Reservasi" onclick="menolak_reservasi(this);"><i class="fa fa-times"></i></a>
                      @elseif($val->status_id == 4)
                      <i class="text-danger">Menunggu Konfirmasi Mentor</i>
                      @elseif($val->status_id == 5)
                      <i class="text-info">Sedang Melalukan Pembayaran</i>
                      @elseif($val->status_id == 6 || $val->status_id == 7)
                      <i class="text-danger">DiTolak</i>
                      @elseif($val->status_id == 9)
                      <i class="text-danger">Pembayaran DiTolak</i>
                      @elseif($val->status_id == 8)
                      <a href="{{ url('/request_reservasi/approve/'.$val->id) }}" type="button"
                        class="btn btn-sm btn-success" title="Terima Pembayaran"><i class="fas fa-check"></i></a>
                      <a type="button" data-toggle="modal" data-target="#Modal_Penolakan" class="btn btn-sm btn-danger"
                        title="Tolak Pembayaran" onclick="menolak_reservasi(this);"><i class="fa fa-times"></i></a>
                      @if($val->pembayaran_id != null)
                      <!-- <a href="{{ url('/Pembayaran_Reservasi/'.$val->pembayaran->path_bukti,$val->pembayaran->bukti_transfer) }}" target="blank_" type="button" class="btn btn-sm btn-info"><i class="fas fa-search"></i> Cek Pembayaran</a><br> -->
                      <a type="button" data-toggle="modal" data-target="#Modal_Cek_pembayaran"
                        class="btn btn-sm btn-info text-light" title="Cek Bukti Pembayaran"
                        onclick="cek_pembayaran(this);"><i class="fa fa-search"></i> Cek</a>
                      @endif
                      @endif
                      @elseif(auth()->user()->level_id == 2)
                      @if($val->status_id == 4)
                      <a href="{{ url('/request_reservasi/approve/'.$val->id) }}" type="button"
                        class="btn btn-sm btn-success" title="Terima Reservasi"><i class="fas fa-check"></i></a>
                      <a type="button" data-toggle="modal" data-target="#Modal_Penolakan" class="btn btn-sm btn-danger"
                        title="Tolak Reservasi" onclick="menolak_reservasi(this);"><i class="fa fa-times"></i></a>
                      @elseif($val->status_id == 5)
                      <i class="text-success"> Pengajuan DiKonfirmasi</i>
                      @else
                      <i class="text-danger"> Pengajuan DiTolak</i>
                      @endif
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Untuk Penolakan. -->
<div class="modal fade" id="Modal_Penolakan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form-horizontal" action="{{url('/request_reservasi/reject')}}" method="get">
        @csrf
        <div class="modal-header">
          <h3 class="modal-title text-primary" id="Title_Penolakan">Penolakan Reservasi</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input id="id_reservasi" type="hidden" name="id_reservasi">
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Email User</label>
            <div class="col-md-6">
              <input id="email_user" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Nama User</label>
            <div class="col-md-6">
              <input id="nama_user" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Alasan Penolakan</label>
            <div class="col-md-6">
              <textarea id="alasan_tolak" name="alasan_tolak" class="form-control" placeholder="Alasan Di Tolak"
                required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"
            onclick="return confirm('Apakah Anda Yakin Menolak Reservasi?')"><i class="fa fa-check"></i> Tolak</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
            Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Cek Pembayaran -->
<div class="modal fade" id="Modal_Cek_pembayaran" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="Title_Pembayaran">Bukti Pembayaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="pembayaran_id_reservasi" type="hidden" name="id_reservasi">
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Email User</label>
          <div class="col-md-6">
            <input id="pembayaran_email_user" type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Nama User</label>
          <div class="col-md-6">
            <input id="pembayaran_nama_user" type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Atas Nama Pengirim</label>
          <div class="col-md-6">
            <input id="pembayaran_nama_pengirim" type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Bank Pengirim</label>
          <div class="col-md-6">
            <input id="pembayaran_bank_pengirim" type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="form-group row text-center">
          <label class="col-md-12 col-form-label">Bukti Transfer</label><br>
          <div class="col-md-12">
            <a id="a_img_bukti" href="https://dummyimage.com/300/09f/fff.png" target="blank_">
              <img id="img_bukti" src="https://dummyimage.com/300/09f/fff.png" alt=""
                style="min-width:250px;min-height:250px; max-width:250px;max-height:250px;">
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function menolak_reservasi(obj) {
    var data = obj.parentNode.parentNode.rowIndex;
    id_reservasi = document.getElementById("dataTable").rows[data].cells[1].innerHTML.trim();
    email_user = document.getElementById("dataTable").rows[data].cells[2].innerHTML.trim();
    nama_user = document.getElementById("dataTable").rows[data].cells[3].innerHTML.trim();
    $('#Title_Penolakan').empty();
    $('#Title_Penolakan').append('<h3 class="modal-title text-primary" id="Title_Penolakan">Menolak Reservasi, ' +
      nama_user + '</h3>');
    $('#id_reservasi').val(id_reservasi);
    $('#email_user').val(email_user);
    $('#nama_user').val(nama_user);
  }

  function cek_pembayaran(obj) {
    const url = "{{ env('MIX_APP_URL') }}"
    var data = obj.parentNode.parentNode.rowIndex;
    id_reservasi = document.getElementById("dataTable").rows[data].cells[1].innerHTML.trim();
    email_user = document.getElementById("dataTable").rows[data].cells[2].innerHTML.trim();
    nama_user = document.getElementById("dataTable").rows[data].cells[3].innerHTML.trim();
    pembayaran_id = document.getElementById("dataTable").rows[data].cells[10].innerHTML.trim();
    $('#Title_Pembayaran').empty();
    $('#Title_Pembayaran').append('<h3 class="modal-title text-primary" id="Title_Pembayaran">Bukti Pembayaran, ' +
      nama_user + '</h3>');
    $('#pembayaran_id_reservasi').val(id_reservasi);
    $('#pembayaran_email_user').val(email_user);
    $('#pembayaran_nama_user').val(nama_user);
    $.ajax({
      async: false,
      type: 'get',
      url: '{{url('/get_data_pembayaran')}}',
      data: {
        _token: '{{ csrf_token() }}',
        id_reservasi: id_reservasi
      },
      success: function (response) {
        respon = $.parseJSON(response);
        if (respon.response == 'success') {
          var data = respon.data_pembayaran;
          if (data.path_bukti != null) {
            var fhoto = url + "/Pembayaran_Reservasi/" + data.path_bukti + "/" + data.bukti_transfer;
          } else {
            var fhoto = url +"/TemplateHome/dist/img/user.jpg";
          }
          var atas_nama_pengirim = data.atas_nama_pengirim;
          var asal_bank = data.asal_bank;
          $('#img_bukti').attr('src', fhoto);
          $('#a_img_bukti').attr('href', fhoto);
          $('#pembayaran_nama_pengirim').val(atas_nama_pengirim);
          $('#pembayaran_bank_pengirim').val(asal_bank);
        } else {
          console.log('Data Tidak Tersedia');
          alert('Data Tidak Tersedia');
        }
      },
    });
  }

</script>
@endsection
