@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-primary" style="font-size:40px;">CARI MENTOR PRIVAT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cari Mentor Privat</li>
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
    <div id="div_search" class="row ml-3 col-md-11">
        <div class="form-group col-md-5">
            <input id="subject" class="form-control" type="text"
                placeholder="Cari Berdasarkan Subject Nama atau Keahlian Mentor">
        </div>
        <div class="form-group col-md-5">
            <input id="alamat" class="form-control" type="text" placeholder="Cari Berdasarkan Alamat Kota Mentor">
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-success" onclick="search()"><i class="fas fa-search"></i> Search</button>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mt-3">
                            <h2 id="data_tidak_tersedia" class="text-center text-danger" style="display:none;">Data Tidak
                                Tersedia.</h2>
                            @if ($data == 0)
                                <h3 class="text-center text-danger"><i>Belum Ada Data Mentor.</i></h3>
                            @else
                                <div id="data_mentor" class="row responsive" style="margin-bottom:auto;">
                                    @foreach ($data as $key => $value)
                                        <a class="card ml-3 mr-2" style="width:30%;"
                                            href="{{ url('/pengajuan/' . $value['id']) }}">
                                            <div class="card">
                                                @if ($value['fhoto'] != null)
                                                    <?php $path = $value['path_fhoto'];
                                                    $foto = $value['fhoto']; ?>
                                                    <img src="{{ url('/Foto_Profile/' . $path . '/' . $foto) }}" alt=""
                                                        style="width:100%; max-height:200px;">
                                                @else
                                                    <img src="{{ url('/TemplateHome/dist/img/user.jpg') }}" alt=""
                                                        style="width:100%; max-height:200px;">
                                                @endif
                                                <p style="background-color:black;color:white;margin-bottom:-1%;">
                                                    {{ $value['nama'] }}</p>
                                                <p style="background-color:black;color:white;margin-bottom:-1%;">
                                                    {{ $value['kota'] }}</p>
                                                <p style="background-color:black;color:white;margin-bottom:-1%;">
                                                    <i class="bg-success mr-5"> Rp.
                                                        {{ number_format($value['harga_perjam'], 0, ',', '.') }}/Jam </i>
                                                    @if ($value['total_bintang'] == null)
                                                        <b class="ml-5">0 <i class="fas fa-star"
                                                                style="color:grey;"></i> ({{ $value['jml_ulasan'] }}
                                                            Ulasan)</b>
                                                    @else
                                                        <b class="ml-5">{{ $value['total_bintang'] }} <i
                                                                class="fas fa-star" style="color:orange;"></i>
                                                            ({{ $value['jml_ulasan'] }} Ulasan)</b>
                                                    @endif
                                                </p>
                                            </div>
                                            <p style="text-align:justify">{{ substr($value['detail_skill'], 0, 100) }}...
                                            </p>
                                            <div class="btn-group" style="width:100%;margin-top:-2%;">
                                                <p>
                                                    @foreach ($value['skill'] as $val)
                                                        <button class="text-dark " type="button"
                                                            disabled>{{ $val->skill }}</button>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="text-right">
                                {{ $data_mentor->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function search() {
            var subject = $('#subject').val();
            var alamat = $('#alamat').val();
            $.ajax({
                async: false,
                type: 'post',
                url: '{{ url('/cari_data_mentor') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    subject: subject,
                    alamat: alamat
                },
                success: function(response) {
                    respon = $.parseJSON(response);
                    if (respon.response == 'success') {
                        var data_mentor = respon.data_mentor;
                        var tot_data = data_mentor.length;
                        var value = "";
                        if (tot_data != 0) {
                            for (a = 0; a < tot_data; a++) {
                                console.log(data_mentor);
                                var no = a + 1;
                                var id = data_mentor[a].id;
                                var nama = data_mentor[a].nama;
                                var kota = data_mentor[a].kota;
                                var harga_perjam = data_mentor[a].harga_perjam;
                                var harga_perjam = harga_perjam.toString(),
                                    sisa = harga_perjam.length % 3,
                                    rupiah = harga_perjam.substr(0, sisa),
                                    ribuan = harga_perjam.substr(sisa).match(/\d{3}/gi);
                                if (ribuan) {
                                    separator = sisa ? '.' : '';
                                    rupiah += separator + ribuan.join('.');
                                }
                                harga_perjam = 'Rp. ' + rupiah;

                                var detail_skill = data_mentor[a].detail_skill.substr(0, 60) + "...";
                                var fhoto = data_mentor[a].fhoto;
                                var path_fhoto = data_mentor[a].path_fhoto;
                                var total_bintang = data_mentor[a].total_bintang;
                                var jml_ulasan = data_mentor[a].jml_ulasan;
                                if (total_bintang == null) {
                                    total_bintang = "<b class='ml-5'>" + 0 +
                                        "<i class='fas fa-star' style='color:grey;'></i></b> (";
                                } else {
                                    total_bintang = "<b class='ml-5'>" + total_bintang +
                                        "<i class='fas fa-star' style='color:orange;'></i></b> (";
                                }
                                if (path_fhoto != null) {
                                    var url_fhoto = "/Foto_Profile/" + path_fhoto + "/" + fhoto;
                                } else {
                                    var url_fhoto = "/TemplateHome/dist/img/user.jpg";
                                }
                                value = value +
                                    "<a class='card ml-3 mr-2' style='width:30%;' href='/pengajuan/" + id +
                                    "'>" +
                                    "<div class='card'>" +
                                    "<img src='" + url_fhoto +
                                    "' alt='' style='width:100%; max-height:200px;'>" +
                                    "<p style='background-color:black;color:white;margin-bottom:-1%;'>" + nama +
                                    "</p>" +
                                    "<p style='background-color:black;color:white;margin-bottom:-1%;'>" + kota +
                                    "</p>" +
                                    "<p style='background-color:black;color:white;margin-bottom:-1%;'>" +
                                    "<i class='bg-success'> " + harga_perjam + "/Jam </i>" +
                                    total_bintang + jml_ulasan + " Ulasan)" +
                                    "</p>" +
                                    "</div>" +
                                    "<p style='text-align:justify'>" + detail_skill + "</p>" +
                                    "<div class='btn-group' style='width:100%;margin-top:-2%;'>" +
                                    "<p>";
                                var skillnya = data_mentor[a].skill;
                                var tot_data_skill = skillnya.length;
                                if (tot_data_skill != 0) {
                                    for (s = 0; s < tot_data_skill; s++) {
                                        value = value + "<button class='text-dark' type='button' disabled>" +
                                            skillnya[s].skill + "</button>"
                                    }
                                }
                                value = value + "</p>" +
                                    "</div>" +
                                    "</a>";
                            }
                            value = value + "</div>";
                            $('#data_tidak_tersedia').hide();
                            $('#data_mentor').empty();
                            $('#data_mentor').append(value);
                        } else {
                            $('#data_mentor').empty();
                            $('#data_tidak_tersedia').show();
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
