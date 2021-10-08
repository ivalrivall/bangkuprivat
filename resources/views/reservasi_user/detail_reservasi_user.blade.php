@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-8">
              <h1 class="text-primary" style="font-size:35px;">Detail Reservasi, {{$detail_reservasi->user->nama}}</h1>
          </div>
          <div class="col-sm-4">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('/request/reservasi')}}">Data Request Reservasi</a></li>
                  <li class="breadcrumb-item active">Detail Reservasi</li>
              </ol>
          </div>
            <a href="{{url('/history/reservasi')}}" type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
      </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="card" style="max-width:98%;">
      <!-- start detail profile Murid-->
      <div class="card-body">
        <h3 class="text-center bg-info text-light">PROFIL MURID</h3>
        <div class="row">
          <div class="card col-sm-6 mb-3">
            <div class="media">
              @if($detail_reservasi->user->fhoto != null)
                <img src="{{url('/Foto_profile/'.$detail_reservasi->user->path_fhoto,$detail_reservasi->user->fhoto)}}" class="img-circle mt-5" style="width:15%;">
              @else
                <img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-3" style="width:15%;">
              @endif
            	<div class="media-body">
                <div class="row ml-3">
                  <a class="col-md-5"><b>Nama</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_reservasi->user->nama}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Jenis Kelamin</b></a>
                  <a class="col-md-1">:</a>
                  @if($detail_reservasi->user->gender_id != null)
                    <a class="col-md-6 text-left">{{$detail_reservasi->user->gender->gender}}</a>
                  @else
                    <a class="col-md-6 text-left"> - </a>
                  @endif
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Tempat/Tgl. Lahir</b></a>
                  <a class="col-md-1">:</a>
                  @if($detail_reservasi->user->tempat_lahir != null)
                    <a class="col-md-6 text-left">{{$detail_reservasi->user->tempat_lahir}}, {{$detail_reservasi->user->tgl_lahir}}</a>
                  @else
                    <a class="col-md-6 text-left"> - </a>
                  @endif
                </div><br>
                <div class="row ml-3">
                  <a class="col-md-5"><b>Email</b></a>
                  <a class="col-md-1">:</a>
                  <a class="col-md-6 text-left">{{$detail_reservasi->user->email}}</a>
                </div>
                <div class="row ml-3">
                  <a class="col-md-5"><b>No. Hp/Tlp</b></a>
                  <a class="col-md-1">:</a>
                  @if($detail_reservasi->user->no_hp != null)
                    <a class="col-md-6 text-left">{{$detail_reservasi->user->no_hp}}</a>
                  @else
                    <a class="col-md-6 text-left"> - </a>
                  @endif
                </div><br>
            	</div>
            </div>
          </div>
          <div class="card col-sm-6 mb-3">
              <div class="row">
                <a class="col-md-4 text-right"><b>Provinsi</b></a>
                <a class="col-md-1 text-center">:</a>
                @if($detail_reservasi->user->detail_alamat_id != null)
                  <a class="col-md-6">{{$detail_reservasi->user->detail_alamat->provinsi}}</a>
                @else
                  <a class="col-md-6 text-left"> - </a>
                @endif
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kabupaten/Kota</b></a>
                <a class="col-md-1 text-center">:</a>
                @if($detail_reservasi->user->detail_alamat_id != null)
                  <a class="col-md-6">{{$detail_reservasi->user->detail_alamat->kota}}</a>
                @else
                  <a class="col-md-6 text-left"> - </a>
                @endif
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kecamatan</b></a>
                <a class="col-md-1 text-center">:</a>
                @if($detail_reservasi->user->detail_alamat_id != null)
                  <a class="col-md-6">{{$detail_reservasi->user->detail_alamat->kecamatan}}</a>
                @else
                  <a class="col-md-6 text-left"> - </a>
                @endif
              </div>
              <div class="row">
                <a class="col-md-4 text-right"><b>Kelurahan/Desa</b></a>
                <a class="col-md-1 text-center">:</a>
                @if($detail_reservasi->user->detail_alamat_id != null)
                  <a class="col-md-6">{{$detail_reservasi->user->detail_alamat->desa}}</a>
                @else
                  <a class="col-md-6 text-left"> - </a>
                @endif
              </div><br>
              @if($detail_reservasi->user->detail_alamat_id != null)
                <div class="row">
                  <a class="col-md-12 ml-5"><b>Detail Alamat :</b></a>
                </div>
                <a class="row col-md-10 ml-5">{{$detail_reservasi->user->detail_alamat->alamat_detail}}</a>
              @else
                <div class="row">
                  <a class="col-md-2 ml-5"><b>Detail Alamat :</b> - </a>
                </div>
              @endif
          </div>
        </div>
      </div>
      <!-- end detail profile Murid-->
      <!-- start detail Reservasi-->
      <div class="card-body">
        <div class="row">
          <div class="card" style="width:100%;">
            <h3 class="text-center bg-info text-light">DETAIL RESERVASI</h3>
            <div class="col-sm-12 mb-3">
              <div class="row ml-3">
                <a class="row col-md-10 ml-5"><b>Deskripsi Kebutuhan</b></a>
                <a class="row col-md-10 ml-5">{{$detail_reservasi->detail_kebutuhan}}</a>
              </div>
              <hr>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Kebutuhan</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  <a class="col-md-6">{{$detail_reservasi->kebutuhan->kebutuhan}}</a>
                </div>
              </div><br>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Hari Pembelajaran</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  @foreach($jadwal_reservasi as $key => $value)
                  <div class="col-md-12">
                      <label class="col-md-1">{{$value->hari->hari}}</label>
                      <input class="col-md-1.5" type="time" value="{{$value->start_jam}}" readonly>
                      <label>s/d</label>
                      <input class="col-md-1.5" type="time" value="{{$value->end_jam}}" readonly>
                  </div>
                  @endforeach
                </div>
              </div><br>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Tipe Pembelajaran</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  <a class="col-md-6">{{$detail_reservasi->tipe_pengajaran->tipe}}</a>
                </div>
              </div><br>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Jumlah Jam</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  <a class="col-md-6">{{$detail_reservasi->jumlah_jam}} Jam</a>
                </div>
              </div><br>
              <div class="row ml-3">
                <div class="col-md-12 ml-5">
                  <a><b>Total Harga</b></a>
                </div>
                <div class="col-md-12 ml-5">
                  <a class="col-md-6">Rp. {{ number_format($detail_reservasi->total_biaya,0,",",".") }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end detail Reservasi-->
      <!-- start detail profile Mentor-->
      <div class="card-body">
        <h3 class="text-center bg-info text-light">DETAIL MENTOR</h3>
        <div class="row">
          <div class="card col-sm-4 mb-3">
            <div class="media">
              @if($detail_mentor->fhoto != null)
            	 <img src="{{url('/Foto_Profile/'.$detail_mentor->path_fhoto,$detail_mentor->fhoto)}}" class="img-circle mt-2 ml-2" style="width:25%;">
              @else
                <img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-5" style="width:25%;">
              @endif
            	<div class="media-body">
                <a class="col-md-12 ml-3">
                <?php $jumlah_data = $jml_ulasan[0]->total_ulasan;
                      if($jumlah_data == 0){
                        $val = 5;
                        for( $a=$val;$a>0;$a--){ ?>
                          <i class="fas fa-star" style="color:grey;"></i>
                  <?php }
                      }else{
                        $star = $jml_ulasan[0]->total_bintang;
                        $jml_star = number_format($star/$jumlah_data);
                        for( $a=$jml_star;$a>0;$a--){ ?>
                          <i class="fas fa-star" style="color:orange;"></i>
                  <?php }
                        if($jml_star < 5){
                          $val = 5-$jml_star;
                          for( $a=$val;$a>0;$a--){ ?>
                            <i class="fas fa-star" style="color:grey;"></i>
                  <?php   }
                        }
                      }?>
                <i style="color:orange;">({{$jml_ulasan[0]->total_ulasan}} Ulasan)</i>
                </a>
                <h5 class="col-md-12 ml-3"><b>{{$detail_mentor->kota}}</b></h5><br>
                <h5 class="col-md-12 text-left ml-3" style="margin-top:-4%;"><b class="bg-success">Rp. {{ number_format($detail_mentor->harga_perjam,0,",",".") }}/ Jam</b></h5>
                @if($detail_reservasi->status_id == 10 || $detail_reservasi->status_id == 11 || $detail_reservasi->status_id == 12)
                  <p class="col-md-12 ml-3">{{$detail_mentor->no_hp}}</p>
                  <p class="col-md-12 ml-3" style="margin-top:-5%;">{{$detail_mentor->email}}</p>
                @endif
              </div>
            </div>
            <a class="col-md-12 text-left">{{$detail_mentor->nama}} | {{$detail_mentor->pengalaman_ngajar}} Tahun Mengajar</a>
          </div>
          <div class="card col-sm-8 mb-3">
            <div class="row">
              <h4 class="row col-md-12 ml-3"><b>Deskripsi</b></h4>
              <a class="row col-md-11 ml-3"><b>{{$detail_mentor->detail_skill}}</b></a>
              <a class="row col-md-11 ml-3" style="text-align:justify">{{$detail_mentor->biodata}}</a>
            </div>
          </div>
        </div>
      </div>
      <!-- end detail profile Mentor-->
      <!-- start detail pengajaran Mentor-->
      <div class="card-body">
        <div class="row">
          <div class="card col-md-12">
            <div class="ml-4">
              <table class="table" style="width:30%;margin-left:15%;margin-bottom:-1%;">
                <a class="ml-5"><b>KEAHLIAN</b></a>
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
          </div>
          <div class="card">
            <h3 class="text-center bg-info text-light">DETAIL PENGAJARAN</h3>
            <div class="mb-3">
              <div class="row ml-3">
                <a class="row col-md-10 ml-5"><b>Metode Pengajaran</b></a>
                <a class="row col-md-11 ml-5" style="text-align:justify">{{$detail_mentor->detail_pengajaran}}</a>
              </div>
              <hr>
              <div class="row ml-3">
                <div class="col-md-6 ml-5">
                  <a><b>Tipe Pengajaran</b></a>
                </div>
                <div class="col-md-6 ml-5">
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
                      <label class="col-md-1"><b>{{$value->hari->hari}}</b></label>
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
      <!-- end detail pengajaran Mentor-->
      <!-- start medsos Mentor-->
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
      <!-- end medsos Mentor-->
    </div>
  </div>
</div>
@endsection
