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
            <form class="form-horizontal" action="{{url('/update/kelas/mentor')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                  <h5 class="text-secondary col-md-12">PROFIL SAYA</h5>
                  <div class="col-md-12" style="margin-bottom:1%;">
                    <label for="detail_skill">Gambaran Anda Dalam Satu Kalimat</label>
                    <input id="detail_skill" class="col-md-12 form-control" type="text" name="detail_skill" maxlength="200" value="{{$data_mentor->detail_skill}}" placeholder="Misal : Saya ahli dalam beberapa bahasa, Software Engineer, Database Specialist, Project Management.(Maks. 200 Karakter)" required>
                  </div>
                  <div class="col-md-12" style="margin-bottom:3%;">
                    <label for="detail_skill">Biodata Singkat dan Latar Belakang</label>
                    <textarea id="biodata" class="col-md-12 form-control" name="biodata" maxlength="200" style="height:100%;" placeholder="Misal : Saya merupakan project manager pada salah satu perusahaan terkemuka di indonesia. Saya sudah banyak mengerjakan projek profesional baik swasta maupun instansi pemerintahan. Saya terbiasa menggunakan berbagai bahasa pemprograman mulai dari PHP, JavaScript, dan Java. Saya juga terbiasa dengan  HTML dan CSS serta beberapa framework pendukung seperti Laravel dan Codeigniter. Saya jga memahami metode pengembangan perangkat lunak dengan metode agile serta framework scrum." required>{{$data_mentor->biodata}}</textarea>
                  </div>
              </div>
              <div class="form-group row">
                  <h5 class="text-secondary col-md-12">KEAHLIAN / SKILL</h5>
                  <div class="col-md-12" style="margin-bottom:1%;">
                    <label for="keahlian">Keahlian</label>
                    <select id="keahlian" class=" col-md-12 form-control" name="keahlian" required>
                        <option value="">-- Pilih Keahlian Anda --</option>
                      @foreach($skill as $val)
                        <option value="{{$val->id}}">{{$val->skill}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label for="pengalaman_bidang">Lama Pengalaman Di Bidang (Dalam Tahun)</label>
                    <input id="pengalaman_bidang" class="col-md-12 form-control" type="number" name="pengalaman_bidang" placeholder="Lama Pengalaman Di Bidang" required>
                  </div>
              </div>
              <a type="button" class="btn btn-primary text-light" style="margin-bottom:3%;" onclick="tambah_skill();"><i class="fas fa-plus"></i> Tambah Keahlian atau Skill</a>
              <div class="form-group row">
                  <h5 class="text-secondary col-md-12">SPESIFIKASI PENGAJARAN</h5>
                  <div class="col-md-12" style="margin-bottom:1%;">
                    <label for="" class="col-md-12">Hari Anda Dapat Mengajar</label>
                    @foreach($hari as $val)
                    <div class="row col-md-4">
                      <div class="col-md-3">
                        <input type="checkbox" class="ml-3" name="hari_mengajar[]" value="{{$val->id}}"> {{$val->hari}}
                      </div>
                      <div class="col-md-6">
                          <input name="start_jam[]" type="time">
                          <label>s/d</label>
                          <input name="end_jam[]" type="time">
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <div class="col-md-12" style="margin-bottom:3%;">
                    <label for="metode_pengajaran">Metode Pengajaran</label>
                    <textarea id="metode_pengajaran" class="col-md-12 form-control" name="metode_pengajaran" maxlength="200" style="height:100%;" placeholder="Misal : Saya akan mengajarkan mulai dari basic pemprograman hinggi advance dan beberapa tips2 best practices yg bisa berguna bagi pemula atau programmer. Saya akan memberikan sesuai apa yang ada di lapangan dengan teknologi yang sedang berkembang dan mempunyai peluang besar selama lebih dari 5 tahun kedepan. Dan saya akan menyesuaikan seberapa jauh pengetahuan kalian, jika dirasa bisa lompat materi saya akan lakukan agar tidak banyak membuang waktu." required>{{$data_mentor->detail_pengajaran}}</textarea>
                  </div>
                  <div class="col-md-12" style="margin-bottom:1%;">
                    <label for="" class="col-md-12">Tipe Pengajaran</label>
                    <input type="checkbox" class="ml-3" name="tipe_pengajaran[]" value="Online"> Online
                    <input type="checkbox" class="ml-3" name="tipe_pengajaran[]" value="Offline"> Offline
                  </div>
                  <div class="col-md-12">
                    <label for="harga_jam">Harga /Jam</label>
                    <input id="harga_jam" class="col-md-12 form-control" type="text" name="harga_jam" placeholder="Harga Perjam" value="Rp. {{number_format($data_mentor->harga_perjam,0,',','.')}}" required>
                  </div>
                  <div class="col-md-12" style="margin-bottom:2%;">
                    <label for="pengalaman_ngajar">Pengalaman Mengajar (Dalam Tahun)</label>
                    <input id="pengalaman_ngajar" class="col-md-12 form-control" type="number" name="pengalaman_ngajar" placeholder="Pengalaman Mengajar (dalam tahun)." value="{{$data_mentor->pengalaman_ngajar}}" required>
                  </div>
              </div>
              <div class="form-group row">
                  <h5 class="text-secondary col-md-12">MEDIA SOSIAL</h5>
                  <div class="col-md-12">
                    <label for="medsos_linkedin" class="col-md-12">LinkedIn</label>
                    <input id="medsos_linkedin" class="col-md-6 form-control" type="text" name="medsos_linkedin" placeholder="Https://www.linkedin.com/in" value="{{$data_mentor->medsos_linkedin}}" required>
                  </div>
                  <div class="col-md-12">
                    <label for="medsos_github" class="col-md-12">Github</label>
                    <input id="medsos_github" class="col-md-6 form-control" type="text" name="medsos_github" placeholder="@Github" value="{{$data_mentor->medsos_github}}" required>
                  </div>
                  <div class="col-md-12" style="margin-bottom:2%;">
                    <label for="medsos_instagram" class="col-md-12">Instagram</label>
                    <input id="medsos_instagram" class="col-md-6 form-control" type="text" name="medsos_instagram" placeholder="@Instagram" value="{{$data_mentor->instagram}}" required>
                  </div>
              </div>
              <div class="form-row" style="margin-left:20%;">
                  <div class="form-group mt-4 mb-5 col-md-8">
                    <!-- <a type="submit" href="{{url('/data_pinjaman')}}" class="btn btn-warning text-dark"><i class="fa fa-reply"></i> Back</a> -->
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i class="fa fa-save"></i> Simpan Perubahan</button>
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
// form input di Harga Perjam
    var harga = document.getElementById("harga_jam");
    harga.addEventListener("keyup", function(e) {
            harga.value = convertRupiah(this.value, "Rp. ");
    });
    harga.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });
// form input di Jumlah Disetujui
    var jumlah_disetujui = document.getElementById("jml_disetujui");
    jumlah_disetujui.addEventListener("keyup", function(e) {
      var jml_pinjaman = $('#jml_pinjaman').val();
      var jml_pinjaman = parseInt(jml_pinjaman.replace(/[^,\d]/g, '').toString());
      var value = parseInt(this.value.replace(/[^,\d]/g, '').toString());
        if(value > jml_pinjaman){
            alert("Jumlah DiSetujui Melebihi Batas Pengajuan.");
            $('#jml_disetujui').val("");
        }else{
            jumlah_disetujui.value = convertRupiah(this.value, "Rp. ");
        }
    });
    jumlah_pinjaman.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });
// FUNCTION UNTUK CONVERT KE RUPIAH DI KEYUP
    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split  = number_string.split(","),
        sisa   = split[0].length % 3,
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
            && key != 8 // Backspace
            && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            && (key < 48 || key > 57) // Non digit
        ){
            evt.preventDefault();
            return;
        }
    }
</script>
@endsection
