@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="text-primary" style="font-size:40px;">Detail Pengajuan Mentor , {{$detail_mentor->nama}}</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('/user/pengajuan_mentor')}}">Data Pengajuan</a></li>
                  <li class="breadcrumb-item active">Detail Mentor</li>
              </ol>
          </div>
          <a href="{{url('/user/pengajuan_mentor')}}" type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
      </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="card" style="max-width:98%;">
      <!-- start detail profile -->
      <div class="card-body">
        <h3 class="text-center bg-info text-light">PROFIL UMUM</h3>
        <div class="row">
          <div class="card col-sm-6 mb-3">
            <div class="media">
              @if($detail_mentor->fhoto != null)
                <img src="{{url('/Foto_profile/'.$detail_mentor->path_fhoto,$detail_mentor->fhoto)}}" class="img-circle mt-5" style="width:15%;">
              @else
                <img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-5" style="width:15%;">
              @endif
            	<div class="media-body">
                <div class="row ml-3">
                  <a class="col-md-5"><b>Nama</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->nama}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Jenis Kelamin</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->gender}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Tanggal Lahir</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->tgl_lahir}}</a>
                </div><br>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Email</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->email}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>No. Hp/Tlp</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->no_hp}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Pengalaman</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_mentor->pengalaman_ngajar}} Tahun Mengajar</a>
                </div><br>
                <div class="row ml-3">
                  <a class="col-md-4 text-left"><b class="bg-success">Rp. {{ number_format($detail_mentor->harga_perjam,0,",",".") }}/ Jam</b></a>
                  <a class="btn btn-sm btn-info" type="button" target="_blank" href="{{asset('/resume_mentor/'.$detail_mentor->path_document.'/'.$detail_mentor->document)}}"><i class="fas fa-eye"></i> Cek Document</a>
                </div><br>
            	</div>
            </div>
          </div>
          <div class="card col-sm-6 mb-3">
              <div class="row">
                <a class="col-md-4 text-right"><b>Provinsi</b></a>
                <a class="col-md-1 text-center">:</a>
                <a class="col-md-6">{{$detail_mentor->provinsi}}</a>
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kabupaten/Kota</b></a>
                <a class="col-md-1 text-center">:</a>
                <a class="col-md-6">{{$detail_mentor->kota}}</a>
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kecamatan</b></a>
                <a class="col-md-1 text-center">:</a>
                <a class="col-md-6">{{$detail_mentor->kecamatan}}</a>
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kelurahan/Desa</b></a>
                <a class="col-md-1 text-center">:</a>
                <a class="col-md-6">{{$detail_mentor->desa}}</a>
              </div><br>
              <div class="row">
                <a class="col-md-12 ml-5"><b>Detail Alamat :</b></a>
              </div>
              <a class="row col-md-10 ml-5">{{$detail_mentor->alamat_detail}}</a>
          </div>
        </div>
      </div>
      <!-- end detail profile -->
      <!-- start detail pengajaran -->
      <div class="card-body">
        <div class="row">
          <div class="card col-md-12">
            <h3 class="text-center bg-info text-light">DETAIL PENGAJARAN</h3>
            <div class="row ml-3">
              <h4 class="row col-md-12 ml-5"><b>Deskripsi</b></h4>
              <a class="row col-md-11 ml-5"><b>{{$detail_mentor->detail_skill}}</b></a>
              <a class="row col-md-11 ml-5" style="text-align:justify">{{$detail_mentor->biodata}}</a>
            </div>
            <hr>
            <div class="row ml-3">
              <table class="table" style="width:30%;margin-left:15%;margin-bottom:-1%;">
                <a class="row col-md-10 ml-5"><b>KEAHLIAN</b></a>
                @foreach($detail_skill as $key => $value)
                <tr>
                  <td>{{$value->skill->skill}} | {{$value->lama_pengalaman}} Tahun Pengalaman</td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                </tr>
              </table>
            </div>
            <hr>
            <div class="mb-3">
              <div class="row ml-3">
                <a class="row col-md-10 ml-5"><b>Metode Pengajaran</b></a>
                <a class="row col-md-11 ml-5" style="text-align:justify">{{$detail_mentor->detail_pengajaran}}</a>
              </div>
              <hr>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Tipe Pengajaran</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  <a class="col-md-6">|</a>
                  @foreach($detail_tipe_pengajaran as $key => $value)
                  <a class="col-md-6">{{$value->tipe_pengajaran->tipe}}</a>
                  <a class="col-md-6">|</a>
                  @endforeach
                </div>
              </div><br>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Hari Tersedia</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  @foreach($detail_hari as $key => $value)
                  <div class="col-md-12">
                      <label class="col-md-1">{{$value->hari->hari}}</label>
                      <input class="col-md-1.5" type="time" value="{{$value->start_jam}}" readonly>
                      <label>s/d</label>
                      <input class="col-md-1.5" type="time" value="{{$value->end_jam}}" readonly>
                  </div>
                  @endforeach
                </div><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end detail pengajaran -->
      <!-- start medsos -->
      <div class="card-body">
        <h3 class="text-center bg-info text-light">Media Sosial</h3>
        <div class="row">
          <div class="card col-sm-12 mb-3">
            <table class="table" style="width:50%;margin-left:15%;margin-bottom:-1%;">
              <tr>
                <td>LinkedIn</td>
                <td>:</td>
                <td>{{$detail_mentor->medsos_linkedin}}</td>
              </tr>
              <tr>
                <td>Github</td>
                <td>:</td>
                <td>{{$detail_mentor->medsos_github}}</td>
              </tr>
              <tr>
                <td>Instagram</td>
                <td>:</td>
                <td>{{$detail_mentor->instagram}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- end medsos -->
    </div>
  </div>
</div>
@endsection
