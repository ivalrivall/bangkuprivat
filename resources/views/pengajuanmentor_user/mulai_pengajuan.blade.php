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
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
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
                            <form class="form-horizontal" action="{{ url('/user/pengajuan_mentor') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <label style="font-size:12px;" class="text-danger"><i>*Note: Jangan Masukkan Kontak
                                        Pribadi (No. HP, Email, dan Sejenisnya Pada Kolom Gambaran, Biodata, dan Metode
                                        Pengajaran).</i></label><br>
                                <div class="form-group row">
                                    <h5 class="text-secondary col-md-12">PROFIL SAYA</h5>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="detail_skill">Gambaran Anda Dalam Satu Kalimat</label>
                                        <input id="detail_skill" class="col-md-12 form-control" type="text"
                                            name="detail_skill" maxlength="500"
                                            placeholder="Misal : Saya ahli dalam beberapa bahasa, Software Engineer, Database Specialist, Project Management.(Maks. 200 Karakter)"
                                            required>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:3%;">
                                        <label for="detail_skill">Biodata Singkat dan Latar Belakang</label>
                                        <textarea id="biodata" class="col-md-12 form-control" name="biodata" maxlength="500"
                                            style="height:120%;"
                                            placeholder="Misal : Saya merupakan project manager pada salah satu perusahaan terkemuka di indonesia. Saya sudah banyak mengerjakan projek profesional baik swasta maupun instansi pemerintahan. Saya terbiasa menggunakan berbagai bahasa pemprograman mulai dari PHP, JavaScript, dan Java. Saya juga terbiasa dengan  HTML dan CSS serta beberapa framework pendukung seperti Laravel dan Codeigniter. Saya jga memahami metode pengembangan perangkat lunak dengan metode agile serta framework scrum."
                                            required></textarea>
                                    </div>
                                </div><br>
                                <div id="tambah_skill" class="form-group row">
                                    <h5 class="text-secondary col-md-12">KEAHLIAN / SKILL</h5>
                                    <div id="div_keahlian0" class="form-group row col-md-12">
                                        <!-- <div class="col-md-3">
                        </div> -->
                                        <div class="col-md-3">
                                            <label for="keahlian">Nama Keahlian</label>
                                            <select id="keahlian0" onfocus="this.size=5;" onblur="this.size=5;"
                                                onchange="this.size=5; this.blur();" onfocusout="this.size=null;"
                                                class="col-md-12 form-control" name="keahlian[]" onclick="pilih_skill(0);"
                                                required>
                                                <option value="">-- Pilih Keahlian Anda --</option>
                                                @foreach ($skill as $val)
                                                    <option value="{{ $val->id }}">{{ $val->skill }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pengalaman_bidang">Lama Pengalaman (Dalam Tahun)</label>
                                            <input id="pengalaman_bidang0" class="col-md-12 form-control" type="number"
                                                name="pengalaman_bidang[]" placeholder="Lama Pengalaman Di Bidang" required>
                                        </div>
                                        <!-- <div class="col-md-12">
                          <label class="col-md-12" for="deskripsi_bidang">Deskripsi Singkat Dengan Keahlian Tersebut</label><br>
                          <textarea class="form-control col-md-12" id="deskripsi_bidang" name="deskripsi_bidang[]" placeholder="Misal: Saya terbiasa menggunakan bahasa tersebut untuk pembuatan program POS Main."></textarea>
                        </div> -->
                                    </div>
                                </div>
                                <a type="button" class="btn btn-primary text-light" style="margin-bottom:3%;"
                                    onclick="tambah_skill();"><i class="fas fa-plus"></i> Tambah Keahlian atau Skill</a>
                                <div class="form-group row">
                                    <h5 class="text-secondary col-md-12">SPESIFIKASI PENGAJARAN</h5>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="" class="col-md-12">Hari Anda Dapat Mengajar</label>
                                        @foreach ($hari as $val)
                                            <div class="row col-md-12">
                                                <div class="col-md-2">
                                                    <input id="hari_mengajar{{ $val->id }}" type="checkbox"
                                                        class="ml-3" name="hari_mengajar[]"
                                                        value="{{ $val->id }}" onclick="checkbox({{ $val->id }})">
                                                    {{ $val->hari }}
                                                </div>
                                                <div class="col-md-10">
                                                    <input id="start_jam{{ $val->id }}" name="start_jam[]"
                                                        type="time">
                                                    <label>s/d</label>
                                                    <input id="end_jam{{ $val->id }}" name="end_jam[]" type="time">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:3%;">
                                        <label for="metode_pengajaran">Metode Pengajaran</label>
                                        <textarea id="metode_pengajaran" class="col-md-12 form-control"
                                            name="metode_pengajaran" maxlength="1000" style="height:120%;"
                                            placeholder="Misal : Saya akan mengajarkan mulai dari basic pemprograman hinggi advance dan beberapa tips2 best practices yg bisa berguna bagi pemula atau programmer. Saya akan memberikan sesuai apa yang ada di lapangan dengan teknologi yang sedang berkembang dan mempunyai peluang besar selama lebih dari 5 tahun kedepan. Dan saya akan menyesuaikan seberapa jauh pengetahuan kalian, jika dirasa bisa lompat materi saya akan lakukan agar tidak banyak membuang waktu."
                                            required></textarea>
                                    </div>
                                    <div class="col-md-12 mt-5" style="margin-bottom:1%;">
                                        <label for="" class="col-md-12">Tipe Pengajaran</label>
                                        @foreach ($tipe_pengajaran as $val)
                                            <input type="checkbox" class="ml-3" name="tipe_pengajaran[]"
                                                value="{{ $val->id }}"> {{ $val->tipe }}
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <label for="harga_jam">Harga /Jam</label>
                                        <input id="harga_jam" class="col-md-12 form-control" type="text" name="harga_jam"
                                            placeholder="Harga Perjam" required>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:2%;">
                                        <label for="pengalaman_ngajar">Pengalaman Mengajar (Dalam Tahun)</label>
                                        <input id="pengalaman_ngajar" class="col-md-12 form-control" type="number"
                                            name="pengalaman_ngajar" placeholder="Pengalaman Mengajar (dalam tahun)."
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <h5 class="text-secondary col-md-12">MEDIA SOSIAL</h5>
                                    <div class="col-md-12">
                                        <label for="medsos_linkedin" class="col-md-12">LinkedIn</label>
                                        <input id="medsos_linkedin" class="col-md-6 form-control" type="text"
                                            name="medsos_linkedin" placeholder="Https://www.linkedin.com/in" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="medsos_github" class="col-md-12">Github</label>
                                        <input id="medsos_github" class="col-md-6 form-control" type="text"
                                            name="medsos_github" placeholder="@Github" required>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:2%;">
                                        <label for="medsos_instagram" class="col-md-12">Instagram</label>
                                        <input id="medsos_instagram" class="col-md-6 form-control" type="text"
                                            name="medsos_instagram" placeholder="@Instagram" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <h5 class="text-secondary col-md-12">DATA SPESIFIKASI (CV)</h5>
                                    <div class="col-md-12" style="margin-bottom:1%;">
                                        <label for="file_resume" class="col-md-12">Resume</label>
                                        <input id="file_resume" class="col-md-6 form-control" type="file" name="file_resume"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-left:20%;">
                                    <div class="form-group mt-4 mb-5 col-md-8">
                                        <!-- <a type="submit" href="{{ url('/data_pinjaman') }}" class="btn btn-warning text-dark"><i class="fa fa-reply"></i> Back</a> -->
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i
                                                class="fa fa-save"></i> Ajukan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="start_jam[]"').prop('disabled', true);
            $('input[name="end_jam[]"').prop('disabled', true);
            $('input[name="hari_mengajar"]:checked').each(function() {
                console.log(this.value);
            });
        });

        function checkbox(val) {
            console.log(val);
            if ($('#hari_mengajar' + val).is(':checked')) {
                $('#start_jam' + val).prop('disabled', false);
                $('#end_jam' + val).prop('disabled', false);
            } else {
                $('#start_jam' + val).prop('disabled', true);
                $('#end_jam' + val).prop('disabled', true);
            }
        }

        function pilih_skill(id) {
            // $('select').change(function(){
            var a = [];
            $.each($("#tambah_skill select option:selected"), function() {
                a.push($(this).val());
            });
            var val = a.join(", ");
            // alert(val);
            id = id + 1;
            $('#keahlian' + id).empty();
            // var id_skill_next = "keahlian"+id;
            $.ajax({
                async: false,
                type: 'get',
                url: '{{ url('/cari_data_skill') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: val
                },
                success: function(response) {
                    respon = $.parseJSON(response);
                    if (respon.response == 'success') {
                        var data = respon.data;
                        var tot_data = data.length;
                        var op = "<option value=''>-- Pilih Keahlian --</option>";
                        // var op = "<select id="+id_skill_next+" onfocus='this.size=5;' onblur='this.size=5;' onchange='this.size=5;"
                        // +"this.blur();' onfocusout='this.size=null;'class='col-md-12 form-control' name='keahlian[]' required>";
                        if (tot_data != 0) {
                            for (a = 0; a < tot_data; a++) {
                                op = op + "<option value=" + data[a].id + ">" + data[a].skill + "</option>";
                            }
                            // op = op+"</select>";
                            $('#keahlian' + id).append(op);
                            $('#keahlian' + id).val("");
                        }
                    } else {
                        console.log('Data Tidak Tersedia');
                    }
                },
            });
        }

        function tambah_skill() {
            var jml = $('#tambah_skill > div').length;
            var get_id = jml - 1;

            var val_skill = $('#keahlian' + get_id).val();
            var val_bidang = $('#pengalaman_bidang' + get_id).val();

            var id_skill_next = "keahlian" + jml;
            var id_pengalaman_next = "pengalaman_bidang" + jml;
            var id_div_next = "div_keahlian" + jml;

            if (val_skill != "" && val_bidang != "") {
                var a = [];
                $.each($("#tambah_skill select option:selected"), function() {
                    a.push($(this).val());
                });
                var val = a.join(", ");
                $.ajax({
                    async: false,
                    type: 'get',
                    url: '{{ url('/cari_data_skill') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: val
                    },
                    success: function(response) {
                        respon = $.parseJSON(response);
                        if (respon.response == 'success') {
                            var data = respon.data;
                            var tot_data = data.length;
                            var value = "<div id=" + id_div_next + " class='form-group row col-md-12'>" +
                                "<!-- <div class='col-md-3'>" +
                                "</div> -->" +
                                "<div class='col-md-3'>" +
                                "<label for='keahlian'>Nama Keahlian</label>" +
                                "<select id=" + id_skill_next +
                                " onfocus='this.size=5;' onblur='this.size=5;' onchange='this.size=5;" +
                                "this.blur();' onfocusout='this.size=null;'class='col-md-12 form-control' onclick='pilih_skill(" +
                                jml + ");' name='keahlian[]' required>" +
                                "<option value=''>-- Pilih Keahlian Anda --</option>";
                            if (tot_data != 0) {
                                for (a = 0; a < tot_data; a++) {
                                    value = value + "<option value=" + data[a].id + ">" + data[a].skill +
                                        "</option>";
                                }
                                value = value + "</select>" +
                                    "</div>" +
                                    "<div class='col-md-3'>" +
                                    "<label for='pengalaman_bidang'>Lama Pengalaman (Dalam Tahun)</label>" +
                                    "<input id=" + id_pengalaman_next +
                                    " class='col-md-12 form-control' type='number' name='pengalaman_bidang[]' placeholder='Lama Pengalaman Di Bidang' required>" +
                                    "</div>" +
                                    "<div class='col-md-3'>" +
                                    "<button type='button' class='btn btn-sm btn-danger' onclick='hapus_keahlian(" +
                                    jml + ")'><i class='fas fa-times'></i></button>" +
                                    "</div>"
                                    // +"<div class='col-md-12'>"
                                    //   +"<label class='col-md-12' for='deskripsi_bidang'>Deskripsi Singkat Dengan Keahlian Tersebut</label><br>"
                                    //   +"<textarea class='form-control col-md-12' id='deskripsi_bidang' name='deskripsi_bidang[]' placeholder='Misal: Saya terbiasa menggunakan bahasa tersebut untuk pembuatan program POS Main.'></textarea>"
                                    // +"</div>"
                                    +
                                    "</div>";
                                $('#tambah_skill').append(value);
                            }
                        } else {
                            console.log('Data Tidak Tersedia');
                        }
                    },
                });
            } else {
                alert('Silahkan Pilih Keahlian dan Lama Pengalaman Keahlian Anda Sebelumnya.');
            }
        }

        function hapus_keahlian(val) {
            $('#div_keahlian' + val).remove();
        }

        // form input di Harga Perjam
        var harga = document.getElementById("harga_jam");
        harga.addEventListener("keyup", function(e) {
            harga.value = convertRupiah(this.value, "Rp. ");
        });
        harga.addEventListener('keydown', function(event) {
            return isNumberKey(event);
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
        // FUNCTION UNTUK NUMBER KEY DI KEYDOWN
        function isNumberKey(evt) {
            key = evt.which || evt.keyCode;
            if (key != 188 // Comma
                &&
                key != 8 // Backspace
                &&
                key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
                &&
                (key < 48 || key > 57) // Non digit
            ) {
                evt.preventDefault();
                return;
            }
        }
    </script>
@endsection
