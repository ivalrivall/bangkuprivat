@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="text-primary" style="font-size:40px;">Pengajuan Sebagai Mentor</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item active">Pengajuan Sebagai Mentor</li>
              </ol>
          </div>
      </div>
      <!-- Alert Status -->
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
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body mt-3">
            @if(count($data_pengajuan) == 0)
              <div class="row">
                <div class="card col-sm-12 mb-3 text-center">
                  <h5 class="text-center text-danger"><i>Tidak Ada Data Pengajuan Sebagai Mentor.</i></h5>
                </div>
              </div>
            @else
              @foreach($data_pengajuan as $key => $value)
                <div class="row">
                  <div class="card col-sm-1 mb-3 text-center">
                    @if($value->user->fhoto != null)
                      <a><img src="{{url('/Foto_Profile/'.$value->user->path_fhoto,$value->user->fhoto)}}" class="img-circle" style="min-width:100%;max-width:70%;margin-top:10%;"></a>
                    @else
                      <a><img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle" style="min-width:100%;max-width:70%;margin-top:10%;"></a>
                    @endif
                  </div>
                  <div class="card col-sm-2 text-center">
                    <h5 style="margin-bottom:-2%;"><b>Nama</b></h5>
                    <hr>
                    <h5>{{$value->user->nama}}</h5>
                  </div>
                  <div class="card col-sm-5">
                    <h5 class="text-center" style="margin-bottom:-2%;"><b>Detail Skill</b></h5>
                    <hr>
                    <p>{{substr($value->detail_skill, 0, 100)}}...</p>
                  </div>
                  <div class="card col-sm-2 text-center">
                    @if($value->status_id == 1)
                      <h5 class="text-center"><b>Status Pengajuan</b></h5>
                      <hr>
                      <p class="text-info"><i>Menunggu Konfirmasi</i></p>
                    @else
                      <h5 class="text-center"><b>Status Pengajuan</b></h5>
                      <p class="text-danger" style="margin-bottom:-3%;"><i>Pengajuan DiTolak</i></p>
                      <hr>
                      <p class="text-info"><b>Alasan : </b>{{$value->alasan_ditolak}}</p>
                    @endif
                  </div>
                  <div class="card col-sm-2 text-center">
                    @if($value->status_id == 1)
                      <div class="row mb-1">
                        <a href="{{url('/pengajuan_mentor/approve/'.$value->id)}}" type="button" class="btn btn-sm btn-success col-sm-6"><i class="fas fa-check"></i> Terima</a>
                        <a type="button" data-toggle="modal" data-target="#Modal_reject" class="btn btn-sm btn-danger col-sm-6" title="Reject Pengajuan" onclick="reject({{$value->id}});"><i class="fas fa-times"></i> Tolak</a>
                      </div>
                    @else
                      <br>
                    @endif
                    <a href="{{url('/detail_pengajuan_mentor/'.$value->id)}}" type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Cek Detail</a>
                    <a>{{$value->created_at}}</h5>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal for reject pengajuan mentor -->
<div class="modal fade" id="Modal_reject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form class="form-horizontal" action="{{url('/pengajuan_mentor/reject')}}" method="GET">
      @csrf
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="Title_reject">Penolakan Pengajuan Sebagai Mentor</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <input id="id_pengajuan" name="id_pengajuan" type="hidden" class="form-control" readonly>
        <div class="modal-body">
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Nama</label>
              <div class="col-md-6">
                  <input id="nama_pengajuan" type="text" class="form-control" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Detail Skill</label>
              <div class="col-md-6">
                  <textarea id="detail_skill" class="form-control" readonly></textarea>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Alasan DiTolak</label>
              <div class="col-md-6">
                  <textarea id="alasan_ditolak" name="alasan_ditolak" class="form-control" placeholder="Masukkan Alasan DiTolak" required></textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-times"></i> Tolak Pengajuan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
function reject(id_pengajuan) {
    $.ajax({
         async: false,
         type:'get',
         url: `{{ url('/get_data_pengajuanmentor') }}`
         data:{ _token : '{{ csrf_token() }}',
              id_pengajuan : id_pengajuan }
         ,success:function(response){
         respon = $.parseJSON(response);
            if(respon.response == 'success')
            {
                 var data = respon.data;
                 var id_pengajuan = data.id;
                 var nama = data.nama;
                 var detail_skill = data.detail_skill;
                 $('#id_pengajuan').val(id_pengajuan);
                 $('#nama_pengajuan').val(nama);
                 $('#detail_skill').val(detail_skill);
                 $('#Title_reject').empty();
                 $('#Title_reject').append('<h3 class="modal-title text-primary" id="Title_reject">Penolakan Pengajuan '+nama+' Sebagai Mentor</h3>');
            }else{
                 console.log('Data Tidak Tersedia');
                 alert('Data Tidak Tersedia');
            }
         },
    });
}
</script>
@endsection
