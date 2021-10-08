@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="text-primary" style="font-size:35px;">Detail Mentor , {{ $detail_mentor->nama }}</h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cari_mentor') }}">Cari Mentor</a></li>
                        <li class="breadcrumb-item active">Detail Mentor</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card" style="max-width:98%;">
                <!-- start detail profile -->
                <div class="card-body">
                    <div class="row">
                        <div class="card col-sm-4 mb-3">
                            <div class="media">
                                <input id="id_mentor" type="hidden" name="id_mentor"
                                    value="{{ $detail_mentor->id_mentor }}">
                                @if ($detail_mentor->fhoto != null)
                                    <img src="{{ url('/Foto_Profile/' . $detail_mentor->path_fhoto, $detail_mentor->fhoto) }}"
                                        class="img-circle mt-2 ml-2" style="width:25%;">
                                @else
                                    <img src="{{ url('/TemplateHome/dist/img/user.jpg') }}" class="img-circle mt-5"
                                        style="width:25%;">
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
                                        <i style="color:orange;">({{ $jml_ulasan[0]->total_ulasan }} Ulasan)</i>
                                    </a>
                                    <h5 class="col-md-12 ml-3"><b>{{ $detail_mentor->kota }}</b></h5><br>
                                    <h5 class="col-md-12 text-left ml-3" style="margin-top:-4%;"><b
                                            class="bg-success">Rp.
                                            {{ number_format($detail_mentor->harga_perjam, 0, ',', '.') }}/ Jam</b></h5>
                                    <div class="button-group ml-3">
                                        @if (auth()->user()->level_id != 3)
                                            <a href="{{ url('/cari_mentor') }}" type="button"
                                                class="btn btn-sm btn-danger"><i class="fa fa-times rounded-pill"></i>
                                                Cancel</a>
                                            <a href="{{ url('/pengajuan/reservasi/' . $detail_mentor->id_detail_mentor) }}"
                                                type="button" class="btn btn-sm btn-success"><i class="fa fa-check"></i>
                                                Reservasi</a>
                                        @else
                                            <a href="{{ url('/cari_mentor') }}" type="button"
                                                class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a class="col-md-12 text-left">{{ $detail_mentor->nama }} |
                                {{ $detail_mentor->pengalaman_ngajar }} Tahun Mengajar</a>
                        </div>
                        <div class="card col-sm-8 mb-3">
                            <div class="row">
                                <h4 class="row col-md-12 ml-3"><b>Deskripsi</b></h4>
                                <a class="row col-md-11 ml-3"><b>{{ $detail_mentor->detail_skill }}</b></a>
                                <a class="row col-md-11 ml-3"
                                    style="text-align:justify">{{ $detail_mentor->biodata }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end detail profile -->
                <!-- start detail pengajaran -->
                <div class="card-body">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="ml-4">
                                <table class="table" style="width:30%;margin-left:15%;margin-bottom:-1%;">
                                    <a class="ml-5"><b>KEAHLIAN</b></a>
                                    @foreach ($detail_skill as $key => $value)
                                        <tr>
                                            <td>{{ $value->skill->skill }} | {{ $value->lama_pengalaman }} Tahun
                                                Pengalaman</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card col-md-12">
                            <h3 class="text-center bg-info text-light">DETAIL PENGAJARAN</h3>
                            <div class="mb-3">
                                <div class="row ml-3">
                                    <a class="row col-md-10 ml-5"><b>Metode Pengajaran</b></a>
                                    <a class="row col-md-11 ml-5"
                                        style="text-align:justify">{{ $detail_mentor->detail_pengajaran }}</a>
                                </div>
                                <hr>
                                <div class="row ml-3">
                                    <div class="col-md-6 ml-5">
                                        <a><b>Tipe Pengajaran</b></a>
                                    </div>
                                    <div class="col-md-6 ml-5">
                                        <a class="col-md-6">|</a>
                                        @foreach ($detail_tipe_pengajaran as $key => $value)
                                            <a class="col-md-6">{{ $value->tipe_pengajaran->tipe }}</a>
                                            <a class="col-md-6">|</a>
                                        @endforeach
                                    </div>
                                </div><br>
                                <div class="row ml-3">
                                    <div class="col-md-12 ml-5">
                                        <a><b>Hari Tersedia</b></a>
                                    </div>
                                    <div class="col-md-12 ml-5">
                                        @foreach ($detail_hari as $key => $value)
                                            <div class="col-md-12">
                                                <label class="col-md-1"><b>{{ $value->hari->hari }}</b></label>
                                                <input class="col-md-1.5" type="time" value="{{ $value->start_jam }}"
                                                    readonly>
                                                <label>s/d</label>
                                                <input class="col-md-1.5" type="time" value="{{ $value->end_jam }}"
                                                    readonly>
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
                <!-- <div class="card-body">
                    <h3 class="text-center bg-info text-light">Media Sosial</h3>
                    <div class="row">
                      <div class="card col-sm-12 mb-3">
                        <table class="table" style="width:50%;margin-left:15%;margin-bottom:-1%;">
                          <tr>
                            <td>LinkedIn</td>
                            <td>:</td>
                            <td>{{ $detail_mentor->medsos_linkedin }}</td>
                          </tr>
                          <tr>
                            <td>Github</td>
                            <td>:</td>
                            <td>{{ $detail_mentor->medsos_github }}</td>
                          </tr>
                          <tr>
                            <td>Instagram</td>
                            <td>:</td>
                            <td>{{ $detail_mentor->instagram }}</td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div> -->
                <!-- end medsos -->
                <!-- Start Review -->
                <div class="card-body">
                    <div class="row">
                        <h5 class="text-warning">Ulasan</h5>
                        <a class="col-md-12">
                            @if ($jml_ulasan[0]->total_bintang == null)
                                <b>0</b>
                            @else
                                <b>{{ $jml_ulasan[0]->total_bintang }}</b>
                            @endif
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
                            <i style="color:orange;">({{ $jml_ulasan[0]->total_ulasan }} Ulasan)</i>
                        </a><br>
                        <input id="jumlah_total_ulasan" type="hidden" name="jumlah_total_ulasan"
                            value="{{ count($ulasan_mentor) }}">
                        <div id="div_ulasan" class="card col-sm-12 mt-3">
                            @if (count($ulasan_mentor) == 0)
                                <div class="row" style="margin-bottom:auto;">
                                    <div class="col-sm-12 text-center">
                                        <p style="font-size:14px;color:red;"><i>Belum Ada Ulasan.</i></p>
                                    </div>
                                </div>
                            @else
                                @foreach ($ulasan_mentor as $key => $val)
                                    <div class="row" style="margin-bottom:auto;">
                                        <div class="col-sm-1 text-center">
                                            @if ($val->fhoto != null)
                                                <a><img src="{{ url('/Foto_Profile/' . $val->path_fhoto, $val->fhoto) }}"
                                                        class="img-circle mt-2" style="max-height:70%;max-width:70%;"></a>
                                            @else
                                                <a><img src="{{ url('/TemplateHome/dist/img/user.jpg') }}"
                                                        class="img-circle mt-2" style="width:70%;"></a>
                                            @endif
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size:14px;"><b>{{ $val->nama }}</b>
                                                <?php $jml_star = $val->bintang;
                            $ulasan = $val->ulasan;
                            $created_at = $val->created_at;
                            for( $a=$jml_star;$a>0;$a--){ ?>
                                                <i class="fas fa-star" style="color:orange;"></i>
                                                <?php }
                            if($jml_star < 5){
                              $val = 5-$jml_star;
                              for( $a=$val;$a>0;$a--){ ?>
                                                <i class="fas fa-star" style="color:grey;"></i>
                                                <?php   }
                            } ?>
                                                </br>
                                                {{ $ulasan }}
                                            </p>
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <p style="font-size:14px;">{{ date('d M Y', strtotime($created_at)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button id="btn_ulasan_banyak" type="button" class="btn btn-secondary text-center col-sm-12"
                            name="button" onclick="tampil_ulasan_banyak();">Tampilkan Lebih Banyak</button>
                    </div>
                </div>
                <!-- End Review -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var jumlah_total_ulasan = $('#jumlah_total_ulasan').val();
            if (jumlah_total_ulasan == 0) {
                $('#btn_ulasan_banyak').hide();
            }
        });

        function tampil_ulasan_banyak() {
            var id_mentor = $('#id_mentor').val();
            $.ajax({
                async: false,
                type: 'get',
                url: '{{ url('/tampil_lebih_banyak') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_mentor: id_mentor
                },
                success: function(response) {
                    respon = $.parseJSON(response);
                    if (respon.response == 'success') {
                        var data_ulasan = respon.banyak_ulasan;
                        var tot_data = data_ulasan.length;
                        var value = "";
                        if (tot_data != 0) {
                            for (a = 0; a < tot_data; a++) {
                                var nama = data_ulasan[a].nama;
                                var path_fhoto = data_ulasan[a].path_fhoto;
                                var fhoto = data_ulasan[a].fhoto;
                                var tgl_ulas = data_ulasan[a].tgl_ulas;
                                var ulasan = data_ulasan[a].ulasan;
                                var bintang = data_ulasan[a].bintang;
                                if (path_fhoto != null) {
                                    var url_fhoto = "/Foto_Profile/" + path_fhoto + "/" + fhoto;
                                } else {
                                    var url_fhoto = "/TemplateHome/dist/img/user.jpg";
                                }
                                var hasil_bintang = "";
                                for (a = 0; bintang > a; bintang--) {
                                    hasil_bintang = hasil_bintang +
                                        "<i class='fas fa-star' style='color:orange;'></i> ";
                                }
                                if (bintang < 5) {
                                    var sisa_bintang = 5 - data_ulasan[a].bintang;
                                    for (b = 0; sisa_bintang > b; sisa_bintang--) {
                                        hasil_bintang = hasil_bintang +
                                            "<i class='fas fa-star' style='color:grey;'></i> ";
                                    }
                                }
                                value = value + "<div class='row' style='margin-bottom:auto;'>" +
                                    "<div class='col-sm-1 text-center'>" +
                                    "<a><img src='" + url_fhoto +
                                    "' class='img-circle mt-2' style='max-height:70%;max-width:70%;'></a>" +
                                    "</div>" +
                                    "<div class='col-sm-9'>" +
                                    "<p style='font-size:14px;'><b>" + nama + "</b>" +
                                    " " + hasil_bintang +
                                    "</br>" +
                                    ulasan + "</p>" +
                                    "</div>" +
                                    "<div class='col-sm-2 text-right'>" +
                                    "<p style='font-size:14px;'>" + tgl_ulas + "</p>" +
                                    "</div>" +
                                    "</div>";
                            }
                            value = value;
                            $('#btn_ulasan_banyak').hide();
                            $('#div_ulasan').empty();
                            $('#div_ulasan').append(value);
                        } else {
                            $('#btn_ulasan_banyak').hide();
                        }
                    } else {
                        console.log('Data Tidak Tersedia');
                        alert('Data Tidak Tersedia');
                    }
                },
            });
        }
    </script>

@endsection
