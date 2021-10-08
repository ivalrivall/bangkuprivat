@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
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
                    <form class="form-horizontal" action="{{ url('/akun_setting/profile/update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="input-group">
                                        <input type="file" name="myfoto" class="file" style="display:none;">
                                        <div class="input-group col-md-2">
                                            @if ($my_user->fhoto != null)
                                                <img src="{{ url('/Foto_Profile/' . $my_user->path_fhoto, $my_user->fhoto) }}"
                                                    id="preview" class="img-thumbnail mt-1">
                                            @else
                                                <img src="{{ url('/TemplateHome/dist/img/user.jpg') }}" id="preview"
                                                    class="img-thumbnail mt-1">
                                            @endif
                                            <button type="button" id="pilih_gambar"
                                                class="browse btn btn-sm text-light ml-4" style="margin-top:-60%;"><i
                                                    class="fas fa-camera"></i> Pilih Foto</button>
                                        </div>
                                        <h2 class="text-secondary col-md-10 mt-3">UBAH PROFIL SAYA</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2><b>DATA PRIBADI</b></h2>
                        <div class="card">
                            <div class="card-body mt-3 ml-5">
                                <div class="form-group row">
                                    <input type="hidden" name="id_user" value="{{ $my_user->id }}">
                                    <div class="col-md-12">
                                        <label for="">Email</label>
                                        <input class="form-control col-sm-4" type="email" name="email"
                                            value="{{ $my_user->email }}" placeholder="Masukkan Email Anda" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Nama Lengkap</label>
                                        <input class="form-control col-sm-4" type="text" name="nama"
                                            value="{{ $my_user->nama }}" placeholder="Masukkan Nama Anda" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Tempat Lahir</label>
                                        <input class="form-control col-sm-4" type="text" name="tempat_lahir"
                                            value="{{ $my_user->tempat_lahir }}" placeholder="Masukkan Templat Lahir Anda"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Tanggal Lahir</label>
                                        <input class="form-control col-sm-4" type="date" name="tgl_lahir"
                                            value="{{ date('Y-m-d', strtotime($my_user->tgl_lahir)) }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Jenis Kelamin</label><br>
                                        @foreach ($gender as $value)
                                            @if ($value->id == auth()->user()->gender_id)
                                                <input type="radio" name="gender" value="{{ $value->id }}" checked>
                                                {{ $value->gender }}
                                            @else
                                                <input type="radio" name="gender" value="{{ $value->id }}">
                                                {{ $value->gender }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="keahlian">No. Handphone</label>
                                        <input class="form-control col-sm-4" type="number"
                                            oninput="javascript:if(this.value.length>this.maxLength)this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="13" name="no_hp" value="{{ $my_user->no_hp }}"
                                            placeholder="Masukkan No. Handphone Anda" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2><b>DATA ALAMAT</b></h2>
                        <div class="card">
                            <div class="card-body mt-3 ml-5">
                                <div class="form-group row">
                                    <input type="hidden" name="id_detail_alamat"
                                        value="{{ $my_user->detail_alamat_id }}">
                                    @if ($my_user->detail_alamat_id != null)
                                        <div class="col-md-12">
                                            <label for="">Detail Alamat</label>
                                            <textarea class="form-control col-sm-8" name="alamat_detail"
                                                placeholder="Masukkan Detail Alamat Anda"
                                                required>{{ $my_user->detail_alamat->alamat_detail }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Provinsi</label>
                                            <input class="form-control col-sm-8" type="text" name="provinsi"
                                                value="{{ $my_user->detail_alamat->provinsi }}"
                                                placeholder="Masukkan Provinsi Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kabupaten/Kota</label>
                                            <input class="form-control col-sm-8" type="text" name="kota"
                                                value="{{ $my_user->detail_alamat->kota }}"
                                                placeholder="Masukkan Kabupaten/Kota Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kecamatan</label>
                                            <input class="form-control col-sm-8" type="text" name="kecamatan"
                                                value="{{ $my_user->detail_alamat->kecamatan }}"
                                                placeholder="Masukkan Kecamatan Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kelurahan/Desa</label>
                                            <input class="form-control col-sm-8" type="text" name="desa"
                                                value="{{ $my_user->detail_alamat->desa }}"
                                                placeholder="Masukkan Kelurahan/Desa Anda" required>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <label for="">Detail Alamat</label>
                                            <textarea class="form-control col-sm-8" name="alamat_detail"
                                                placeholder="Masukkan Detail Alamat Anda" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Provinsi</label>
                                            <input class="form-control col-sm-8" type="text" name="provinsi"
                                                placeholder="Masukkan Provinsi Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kabupaten/Kota</label>
                                            <input class="form-control col-sm-8" type="text" name="kota"
                                                placeholder="Masukkan Kabupaten/Kota Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kecamatan</label>
                                            <input class="form-control col-sm-8" type="text" name="kecamatan"
                                                placeholder="Masukkan Kecamatan Anda" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Kelurahan/Desa</label>
                                            <input class="form-control col-sm-8" type="text" name="desa"
                                                placeholder="Masukkan Kelurahan/Desa Anda" required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-center">
                            <div class="form-group mt-4 mb-5 col-md-8">
                                <a type="submit" href="{{ url('/akun_setting') }}" class="btn btn-danger"><i
                                        class="fa fa-times"></i> Cancel Perubahan</a>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?');"><i
                                        class="fa fa-save"></i> Simpan Perubahan Profile</button>
                            </div>
                        </div>
                    </form>
                    <h2><b>KATA SANDI</b></h2>
                    <div class="card">
                        <div class="card-body mt-3 ml-5">
                            <form class="form-horizontal" action="{{ url('/akun_setting/password/update') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="id_user" value="{{ $my_user->id }}">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="">Kata Sandi Lama</label>
                                        <input class="form-control col-sm-4" type="password" name="old_pass"
                                            placeholder="Masukkan Kata Sandi Lama Anda" required>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="">Kata Sandi Baru</label>
                                        <input class="form-control col-sm-6" type="password" name="new_pass"
                                            placeholder="Masukkan Kata Sandi Baru Anda" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i
                                                class="fa fa-save"></i> Simpan Perubahan Sandi</button>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Ulangi Kata Sandi Baru</label>
                                        <input class="form-control col-sm-4" type="password" name="confirm_new_pass"
                                            placeholder="Ulangi Kata Sandi Baru Anda" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script type="text/javascript">
        $(document).on("click", "#pilih_gambar", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
