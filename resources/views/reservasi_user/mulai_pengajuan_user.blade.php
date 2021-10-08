@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="text-primary" style="font-size:20px;">Pastikan Biodata Anda Sudah Benar !!!</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cari_mentor') }}">Cari Mentor</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/pengajuan/reservasi') }}">Deskripsi Mentor</a></li>
                        <li class="breadcrumb-item active ">Mulai Pengajuan</li>
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
                            <form class="form-horizontal" action="{{ url('/user/pengajuan/reservasi') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <input id="harga_perjam" type="hidden" name="harga_perjam"
                                        value="{{ $data_mentor->harga_perjam }}">
                                    <input id="id_mentor" type="hidden" name="id_mentor"
                                        value="{{ $data_mentor->user_id }}">
                                    <h3 class="text-secondary text-center col-md-12">SPESIFIKASI RESERVASI</h3>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="">Kebutuhan</label><br>
                                        @foreach ($kebutuhan as $value)
                                            <input type="radio" class="kebutuhan" onclick="radio({{ $value->id }});"
                                                name="kebutuhan" value="{{ $value->id }}"> {{ $value->kebutuhan }}
                                            </br>
                                        @endforeach
                                        <input type="radio" class="kebutuhan" onclick="radio(99);" name="kebutuhan"
                                            value="99"> Lainnya</br>
                                        <input id="kebutuhan_lainnya" type="text" class="form-control"
                                            style="display:none;" name="kebutuhan_lainnya"
                                            placeholder="Silahkan Masukkan Yang Anda Butuhankan">
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:3%;">
                                        <label for="spek_kebutuhan">Ceritakan Spesifikasi Kebutuhan Anda</label>
                                        <textarea id="spek_kebutuhan" class="col-md-12 form-control" name="spek_kebutuhan"
                                            maxlength="200" style="height:100%;"
                                            placeholder="Misal : Saya bukan developer tapi saya ingin belajar ngoding, saya butuh mentor yang bisa mengajari saya dari nol."
                                            required></textarea>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="" class="col-md-12">Hari Pembelajaran dan Jam Kesediaan</label>
                                        @foreach ($hari as $key => $val)
                                            <div class="row col-md-10">
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="ml-3" name="hari_dibutuhkan[]"
                                                        value="{{ $val->id }}"> {{ $val->hari->hari }}
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="time" value="{{ $val->start_jam }}" readonly>
                                                    <label>s/d</label>
                                                    <input type="time" value="{{ $val->end_jam }}" readonly>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- <input id="jumlah_hari_dipilih" type="hidden" name="jumlah_hari_dipilih" readonly> -->
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="" class="col-md-12">Tipe Pengajaran Yang Anda Perlukan</label>
                                        @foreach ($tipe_pengajaran as $val)
                                            <input type="radio" class="ml-3" name="tipe_pengajaran"
                                                value="{{ $val->tipe_pengajaran_id }}">
                                            {{ $val->tipe_pengajaran->tipe }}
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <label for="harga_jam">Jumlah Jam Yang Anda Perlukan</label>
                                        <input id="jumlah_jam" class="col-md-12 form-control" type="number"
                                            name="jumlah_jam" placeholder="Jumlah Jam Yang Anda Perlukan" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p class="text-danger"><i>*Jumlah Jam Dikalikan dengan Jumlah Hari dan Dikalikan
                                                dengan Harga Reservasi /Jam.</i></p>
                                        <h3 id="sub_total_view"><b>Sub Total : Rp. 0</b></h3>
                                        <input id="sub_total" type="hidden" name="sub_total" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row" style="margin-left:20%;">
                                    <div class="form-group mt-4 mb-5 col-md-8">
                                        <a type="submit" href="{{ url('/cari_mentor') }}" class="btn btn-danger"><i
                                                class="fa fa-times"></i> Batalkan</a>
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i
                                                class="fa fa-save"></i> Konfirmasi Pemesanan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            console.log("Ready !");
        });

        function radio(obj) {
            if (obj == 99) {
                $('#kebutuhan_lainnya').show();
                $("#kebutuhan_lainnya").prop('required', true);
            } else {
                $('#kebutuhan_lainnya').hide();
                $("#kebutuhan_lainnya").prop('required', false);
            }
        }
        // // get value pilihan hari yang di pilih
        var countChecked = function() {
            // var n = $("input:checked").length;
            // $('#jumlah_hari_dipilih').val(n);
            $('#jumlah_jam').val("");
            $('#sub_total_view').empty();
            $('#sub_total_view').append('<h3 id="sub_total_view"><b>Sub Total : Rp. 0</b></h3>');
        };
        countChecked();
        $("input[type=checkbox]").on("click", countChecked);

        // get form input jumlah jam
        var jumlah_jam = document.getElementById("jumlah_jam");
        jumlah_jam.addEventListener("keyup", function(e) {
            var jumlah_hari_dipilih = $('input[name="hari_dibutuhkan[]"]:checked').length;
            var get_harga = $('#harga_perjam').val();
            // var jumlah_hari_dipilih = $('#jumlah_hari_dipilih').val();
            jumlah_jam.value = this.value;
            var jumlah = jumlah_jam.value;
            var sub_total = jumlah_hari_dipilih * jumlah * get_harga;

            sub_total = sub_total.toString(),
                sisa = sub_total.length % 3,
                rupiah = sub_total.substr(0, sisa),
                ribuan = sub_total.substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            total = 'Rp. ' + rupiah;
            console.log(total);
            $('#sub_total_view').empty();
            $('#sub_total_view').append('<h3 id="sub_total_view"><b>Sub Total : ' + total + '</b></h3>');
            $('#sub_total').empty();
            $('#sub_total').val(total);
        });
        // FUNCTION UNTUK CONVERT KE RUPIAH DI KEYUP
        function convertRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }
        // jumlah_jam.addEventListener('keydown', function(event) {
        //     console.log(jumlah_jam.value);
        //     $('#sub_total_view').empty();
        //     $('#sub_total_view').append('<h3 id="sub_total_view"><b>Sub Total : Rp. '+get_harga+'</b></h3>');
        // });
    </script>
@endsection
