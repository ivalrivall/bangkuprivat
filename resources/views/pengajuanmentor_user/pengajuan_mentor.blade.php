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
            @if($cek_pengajuan != 0)
            <div class="text-center">
              <a href="{{url('/user/pengajuan_mentor/ulang')}}" type="button" class="btn btn-primary">Ajukan Ulang.</a>
            </div><br>
            @endif
              @foreach($data_pengajuan as $key => $value)
                <div class="row">
                  <div class="card col-sm-1 mb-3 text-center">
                    @if($value->user->fhoto != null)
                      <a><img src="{{url('/Foto_Profile/'.$value->user->path_fhoto,$value->user->fhoto)}}" class="img-circle" style="width:100%;max-height:60%;margin-top:15%;"></a>
                    @else
                      <a><img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle" style="width:100%;margin-top:15%;"></a>
                    @endif
                  </div>
                  <div class="card col-sm-2 mb-3 text-center">
                    <h5><b>Nama</b></h5>
                    <hr>
                    <h5>{{$value->user->nama}}</h5>
                  </div>
                  <div class="card col-sm-5 mb-3">
                    <h5 class="text-center"><b>Detail Skill</b></h5>
                    <hr>
                    <p>{{$value->detail_skill}}</p>
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
                  <div class="card col-sm-2 mb-3 text-center">
                    <a href="{{url('/detail_pengajuan_mentor/user/'.$value->id)}}" type="button" class="btn btn-sm btn-info mt-3"><i class="fas fa-eye"></i> Cek Detail</a>
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
@endsection
