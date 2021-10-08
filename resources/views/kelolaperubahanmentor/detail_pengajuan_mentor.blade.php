@extends('layouts.homepage')
@section('content')
<!-- <div class="content-header">
  <div class="container-fluid text-center">
      <h1 class="text-primary" style="font-size:40px;">Detail Mentor , {{$detail_mentor->nama}}</h1>
  </div>
  <a href="{{url('/lihatdatamentor')}}" type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
</div> -->
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-8">
              <h1 class="text-primary" style="font-size:35px;">Detail Pengajuan Mentor , {{$detail_mentor->nama}}</h1>
          </div>
          <div class="col-sm-4">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('/lihatdatamentor')}}">Data Mentor</a></li>
                  <li class="breadcrumb-item active">Detail Mentor</li>
              </ol>
          </div>
          <a href="{{url('/manage/perubahan_data')}}" type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
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
                  @if($detail_mentor->pengalaman_ngajar != $detail_perubahan->pengalaman_ngajar)
                    <a class="col-md-6 text-left text-danger">{{$detail_perubahan->pengalaman_ngajar}} Tahun Mengajar</a>
                  @else
                    <a class="col-md-6 text-left">{{$detail_mentor->pengalaman_ngajar}} Tahun Mengajar</a>
                  @endif
                </div><br>
                <div class="row ml-3">
                  @if($detail_mentor->harga_perjam != $detail_perubahan->harga_perjam)
                    @if($detail_mentor->harga_perjam < $detail_perubahan->harga_perjam)
                      <a class="col-md-5 text-left"><i class="text-danger">(DiNaikkan) </i><b class="bg-danger">Rp. {{ number_format($detail_perubahan->harga_perjam,0,",",".") }}/ Jam</b></a>
                    @else
                      <a class="col-md-5 text-left"><i class="text-danger">(DiTurunkan) </i><b class="bg-danger">Rp. {{ number_format($detail_perubahan->harga_perjam,0,",",".") }}/ Jam</b></a>
                    @endif
                  @else
                    <a class="col-md-5 text-left"><b class="bg-success">Rp. {{ number_format($detail_mentor->harga_perjam,0,",",".") }}/ Jam</b></a>
                  @endif
                  @if($detail_perubahan->document != null)
                    @if($detail_mentor->document != $detail_perubahan->document)
                      <a class="btn btn-sm btn-danger" type="button" href="{{asset('/resume_mentor/'.$detail_perubahan->path_document.'/'.$detail_perubahan->document)}}"><i class="fas fa-eye"></i> Cek Document</a>
                    @else
                      <a class="btn btn-sm btn-info" type="button" href="{{asset('/resume_mentor/'.$detail_mentor->path_document.'/'.$detail_mentor->document)}}"><i class="fas fa-eye"></i> Cek Document</a>
                    @endif
                  @else
                    <a class="btn btn-sm btn-info" type="button" href="{{asset('/resume_mentor/'.$detail_mentor->path_document.'/'.$detail_mentor->document)}}"><i class="fas fa-eye"></i> Cek Document</a>
                  @endif
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
              @if($detail_mentor->detail_skill != $detail_perubahan->detail_skill)
                <a class="row col-md-11 ml-5 text-danger"><b>{{$detail_perubahan->detail_skill}}</b></a>
              @else
                <a class="row col-md-11 ml-5"><b>{{$detail_mentor->detail_skill}}</b></a>
              @endif
              @if($detail_mentor->biodata != $detail_perubahan->biodata)
                <a class="row col-md-11 ml-5 text-danger" style="text-align:justify">{{$detail_perubahan->biodata}}</a>
              @else
                <a class="row col-md-11 ml-5" style="text-align:justify">{{$detail_mentor->biodata}}</a>
              @endif
            </div>
            <hr>
            <div class="row ml-3">
              <table class="table" style="width:30%;margin-left:15%;margin-bottom:-1%;">
                <a class="row col-md-10 ml-5"><b>KEAHLIAN</b></a>
                @foreach($detail_skill as $key => $value)
                  @if($value->nilai == 0 && $value->nilai_perubahan != 0)
                    <tr>
                      <td class="text-danger">{{$value->skill}} | {{$value->lama_pengalaman_perubahan}} Tahun Pengalaman<i class="text-danger"> (DiTambahkan)</i></td>
                    </tr>
                  @elseif($value->nilai != 0 && $value->nilai_perubahan == 0)
                    <tr>
                      <td class="text-danger">{{$value->skill}} | {{$value->lama_pengalaman_perubahan}} Tahun Pengalaman<i class="text-danger"> (DiHapus)</i></td>
                    </tr>
                  @elseif($value->nilai != 0 && $value->nilai_perubahan != 0)
                    <tr>
                      <td>{{$value->skill}} | {{$value->lama_pengalaman_perubahan}} Tahun Pengalaman</td>
                    </tr>
                  @endif
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
                @if($detail_mentor->detail_pengajaran != $detail_perubahan->detail_pengajaran)
                  <a class="row col-md-10 ml-5 text-danger" style="text-align:justify">{{$detail_perubahan->detail_pengajaran}}</a>
                @else
                  <a class="row col-md-10 ml-5" style="text-align:justify">{{$detail_mentor->detail_pengajaran}}</a>
                @endif
              </div>
              <hr>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Tipe Pengajaran</b></a>
                </div>
                <div class="col-md-12 ml-5">
                    <a class="col-md-6">|</a>
                  @foreach($detail_tipe_pengajaran as $key => $value)
                    @if($value->nilai == 0 && $value->nilai_perubahan != 0)
                      <a class="col-md-6 text-danger">{{$value->tipe}}<i class="text-danger"> (DiTambahkan)</i></a>
                    @elseif($value->nilai != 0 && $value->nilai_perubahan == 0)
                      <a class="col-md-6 text-danger">{{$value->tipe}}<i class="text-danger"> (DiHapus)</i></a>
                    @else
                      <a class="col-md-6">{{$value->tipe}}</a>
                    @endif
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
                    @if($value->nilai != $value->nilai_perubahan)
                      <div class="col-md-12">
                        @if($value->nilai == 0 && $value->nilai_perubahan != 0)
                          <label class="col-md-1 text-danger"><b>{{$value->hari}}</b><i class="text-danger"> (DiTambahkan)</i></label>
                        @else
                          <label class="col-md-1 text-danger"><b>{{$value->hari}}</b><i class="text-danger"> (DiHapus)</i></label>
                        @endif
                          <input class="col-md-1.5 text-danger" type="time" value="{{$value->start_jam_perubahan}}" readonly>
                          <label>s/d</label>
                          <input class="col-md-1.5 text-danger" type="time" value="{{$value->end_jam_perubahan}}" readonly>
                      </div>
                    @elseif($value->nilai != 0 && $value->nilai_perubahan != 0)
                      <div class="col-md-12">
                          <label class="col-md-1"><b>{{$value->hari}}</b></label>
                          <input class="col-md-1.5" type="time" value="{{$value->start_jam}}" readonly>
                          <label>s/d</label>
                          <input class="col-md-1.5" type="time" value="{{$value->end_jam}}" readonly>
                      </div>
                    @endif
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
                @if($detail_mentor->medsos_linkedin != $detail_perubahan->medsos_linkedin)
                  <td class="text-danger">{{$detail_perubahan->medsos_linkedin}}</td>
                @else
                  <td>{{$detail_mentor->medsos_linkedin}}</td>
                @endif
              </tr>
              <tr>
                <td>Github</td>
                <td>:</td>
                @if($detail_mentor->medsos_github != $detail_perubahan->medsos_github)
                  <td class="text-danger">{{$detail_perubahan->medsos_github}}</td>
                @else
                  <td>{{$detail_mentor->medsos_github}}</td>
                @endif
              </tr>
              <tr>
                <td>Instagram</td>
                <td>:</td>
                @if($detail_mentor->instagram != $detail_perubahan->instagram)
                  <td class="text-danger">{{$detail_perubahan->instagram}}</td>
                @else
                  <td>{{$detail_mentor->instagram}}</td>
                @endif
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
