@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <?php $now = date('d M Y'); ?>
                    <h1 class="text-primary" style="font-size:30px;">REVIEW KELAS SELESAI Per Tgl. {{ $now }}</h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Review Kelas Selesai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mt-3">
                            @foreach ($ulasan as $key => $value)
                                <div class="row">
                                    <div class="card col-sm-2 mb-3 text-center">
                                        <h5><b>Tgl. Reservasi</b></h5>
                                        <h5>{{ date('d M Y', strtotime($value->created_at)) }}</h5>
                                        <a>
                                            <?php $jml_star = $value->bintang;
                          for( $a=$jml_star;$a>0;$a--){ ?>
                                            <i class="fas fa-star" style="color:orange;"></i>
                                            <?php }
                          if($jml_star < 5){
                            $val = 5-$jml_star;
                            for( $a=$val;$a>0;$a--){ ?>
                                            <i class="fas fa-star" style="color:grey;"></i>
                                            <?php   }
                          } ?>
                                        </a>
                                    </div>
                                    <div class="card col-sm-3 mb-3 text-center">
                                        <h5><b>Mentor</b></h5>
                                        @if ($value->fhoto_mentor != null)
                                            <a><img src="{{ url('/Foto_Profile/' . $value->path_fhoto_mentor, $value->fhoto_mentor) }}"
                                                    class="img-circle" style="width:30%;height:50px;"></a>
                                        @else
                                            <a><img src="{{ url('/TemplateHome/dist/img/user.jpg') }}"
                                                    class="img-circle" style="width:15%;height:100%"></a>
                                        @endif
                                        <h5><b>{{ $value->nama_mentor }}</b></h5>
                                    </div>
                                    <div class="card col-sm-3 mb-3 text-center">
                                        <h5><b>Murid</b></h5>
                                        @if ($value->fhoto_murid != null)
                                            <a><img src="{{ url('/Foto_Profile/' . $value->path_fhoto_murid, $value->fhoto_murid) }}"
                                                    class="img-circle" style="width:30%;height:50px;"></a>
                                        @else
                                            <a><img src="{{ url('/TemplateHome/dist/img/user.jpg') }}"
                                                    class="img-circle" style="width:15%;height:100%"></a>
                                        @endif
                                        <h5><b>{{ $value->nama_murid }}</b></h5>
                                    </div>
                                    <div class="card col-sm-4 mb-3">
                                        <h5 class="text-center"><b>Tanggapan Murid</b></h5>
                                        <p class="text-center">{{ $value->ulasan }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
