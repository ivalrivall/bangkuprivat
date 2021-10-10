@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="text-primary" style="font-size:40px;">Selamat Datang, {{ $detail_user->nama }}</h1>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active">Home</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card" style="max-width:98%;">
                <div class="card-body">
                    <h3 class="text-center bg-info text-light">PROFIL ANDA</h3>
                    <div class="row">
                        <div class="card col-sm-6 mb-3">
                            <div class="media">
                                @if ($detail_user->fhoto != null)
                                    <img src="{{ url('/Foto_Profile/' . $detail_user->path_fhoto, $detail_user->fhoto) }}"
                                        class="img-circle mt-3" style="width:15%;">
                                @else
                                    <img src="{{ url('/TemplateHome/dist/img/user.jpg') }}" class="img-circle mt-3"
                                        style="width:15%;">
                                @endif
                                <div class="media-body">
                                    <div class="row ml-3">
                                        <a class="col-md-3"><b>Nama</b></a>
                                        <a class="col-md-1">:</a>
                                        <a class="col-md-6 text-left">{{ $detail_user->nama }}</a>
                                    </div>
                                    <div class="row ml-3">
                                        <a class="col-md-3"><b>Jenis Kelamin</b></a>
                                        <a class="col-md-1">:</a>
                                        @if ($detail_user->gender_id != null)
                                            <a class="col-md-6 text-left">{{ $detail_user->gender->gender }}</a>
                                        @else
                                            <a class="col-md-6 text-left"> - </a>
                                        @endif
                                    </div>
                                    <div class="row ml-3">
                                        <a class="col-md-3"><b>Tempat/Tgl. Lahir</b></a>
                                        <a class="col-md-1">:</a>
                                        @if ($detail_user->tempat_lahir != null)
                                            <a class="col-md-6 text-left">{{ $detail_user->tempat_lahir }},
                                                {{ $detail_user->tgl_lahir }}</a>
                                        @else
                                            <a class="col-md-6 text-left"> - </a>
                                        @endif
                                    </div><br>
                                    <div class="row ml-3">
                                        <a class="col-md-3"><b>Email</b></a>
                                        <a class="col-md-1">:</a>
                                        <a class="col-md-6 text-left">{{ $detail_user->email }}</a>
                                    </div>
                                    <div class="row ml-3">
                                        <a class="col-md-3"><b>No. Hp/Tlp</b></a>
                                        <a class="col-md-1">:</a>
                                        @if ($detail_user->no_hp != null)
                                            <a class="col-md-6 text-left">{{ $detail_user->no_hp }}</a>
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
                                @if ($detail_user->detail_alamat_id != null)
                                    <a class="col-md-3">{{ $detail_user->detail_alamat->provinsi }}</a>
                                @else
                                    <a class="col-md-6 text-left"> - </a>
                                @endif
                            </div>
                            <div class="row">
                                <a class="col-md-4 text-right"><b>Kabupaten/Kota</b></a>
                                <a class="col-md-1 text-center">:</a>
                                @if ($detail_user->detail_alamat_id != null)
                                    <a class="col-md-3">{{ $detail_user->detail_alamat->kota }}</a>
                                @else
                                    <a class="col-md-6 text-left"> - </a>
                                @endif
                            </div>
                            <div class="row">
                                <a class="col-md-4 text-right"><b>Kecamatan</b></a>
                                <a class="col-md-1 text-center">:</a>
                                @if ($detail_user->detail_alamat_id != null)
                                    <a class="col-md-3">{{ $detail_user->detail_alamat->kecamatan }}</a>
                                @else
                                    <a class="col-md-6 text-left"> - </a>
                                @endif
                            </div>
                            <div class="row">
                                <a class="col-md-4 text-right"><b>Kelurahan/Desa</b></a>
                                <a class="col-md-1 text-center">:</a>
                                @if ($detail_user->detail_alamat_id != null)
                                    <a class="col-md-3">{{ $detail_user->detail_alamat->desa }}</a>
                                @else
                                    <a class="col-md-6 text-left"> - </a>
                                @endif
                            </div><br>
                            @if ($detail_user->detail_alamat_id != null)
                                <div class="row">
                                    <a class="col-md-4 text-right"><b>Detail Alamat</b></a>
                                    <a class="col-md-1 text-center">:</a>
                                    {{-- Diubah Satria --}}
                                    <a class="row col-md-7">{{ $detail_user->detail_alamat->alamat_detail }}</a>
                                </div>
                            @else
                                <div class="row">
                                    <a class="col-md-12 ml-5"><b>Detail Alamat :</b> - </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
