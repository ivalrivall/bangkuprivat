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
                <input id="harga_perjam" type="hidden" name="harga_perjam" value="{{ $data_mentor->harga_perjam }}">
                <input id="id_mentor" type="hidden" name="id_mentor" value="{{ $data_mentor->user_id }}">
                <h3 class="text-secondary text-center col-md-12">SPESIFIKASI RESERVASI</h3>
                <div class="col-md-12" style="margin-bottom:1%;">
                  <label for="">Kebutuhan</label><br>
                  @foreach ($kebutuhan as $value)
                  <input type="radio" class="kebutuhan" onclick="radio({{ $value->id }});" name="kebutuhan"
                    value="{{ $value->id }}"> {{ $value->kebutuhan }}
                  <br>
                  @endforeach
                  <input type="radio" class="kebutuhan" onclick="radio(99);" name="kebutuhan" value="99"> Lainnya</br>
                  <input id="kebutuhan_lainnya" type="text" class="form-control" style="display:none;"
                    name="kebutuhan_lainnya" placeholder="Silahkan Masukkan Yang Anda Butuhankan">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="spek_kebutuhan">Ceritakan Spesifikasi Kebutuhan Anda</label>
                  <textarea id="spek_kebutuhan" class="form-control" name="spek_kebutuhan" maxlength="200" rows="4"
                    placeholder="Misal : Saya bukan developer tapi saya ingin belajar ngoding, saya butuh mentor yang bisa mengajari saya dari nol."
                    required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="">Hari Pembelajaran dan Jam Kesediaan</label>
                  <label>Pilih Hari</label>
                  <select class="form-control" style="width: 100px" name="hari_dibutuhkan_select" id="day_request"
                    onchange="showDiv(this)">
                    <option value="select" disabled selected>Pilih</option>
                    @foreach ($hari as $key => $val)
                    <option value="{{ $val->id }}-{{ $val->hari->id }}">{{ $val->hari->hari }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12 my-2"></div>
                @foreach ($hari as $key => $val)
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-3" style="display: none" id="select_availibility-{{$val->hari->id}}">
                      <label>Ketersediaan</label>
                      <div class="input-group">
                        <input type="time" class="form-control" value="{{ $val->start_jam }}" readonly>
                        <span class="input-group-text">Sampai</span>
                        <input type="time" class="form-control" value="{{ $val->end_jam }}" readonly>
                      </div>
                    </div>
                    <div class="col-3" style="display: none" id="select_time-{{$val->hari->id}}">
                      <div class="row">
                        <div class="col-6">
                          <label>Pilih Jam Mulai</label>
                          <select class="form-control" style="width: 100px;display:none" name="time_start"
                            id="time_start-{{$val->hari->id}}">
                            <option value="select" disabled selected>Pilih</option>
                            @foreach ($ketersediaan as $kts)
                            @if ($val->start_jam < $kts && $val->end_jam > $kts)
                              <option value="{{ $kts }}">{{ $kts }}</option>
                              @endif
                              @endforeach
                          </select>
                        </div>
                        <div class="col-6">
                          <label>Pilih Jam Selesai</label>
                          <select class="form-control" style="width: 100px;display:none" name="time_end"
                            id="time_end-{{$val->hari->id}}">
                            <option value="select" disabled selected>Pilih</option>
                            @foreach ($ketersediaan as $kts)
                            @if ($val->start_jam < $kts && $val->end_jam > $kts)
                              <option value="{{ $kts }}">{{ $kts }}</option>
                              @endif
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3"></div>
                    </div>
                    <div class="col-3" style="display: none" id="select_date-{{$val->hari->id}}">
                      <div class="form-group">
                        <label>Pilih Tanggal</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                          </div>
                          <input type="text" name="date" id="date" autocomplete="off"
                            class="form-control float-right datepicker-{{$val->hari->hari}}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="form-group row">
                <!-- <input id="jumlah_hari_dipilih" type="hidden" name="jumlah_hari_dipilih" readonly> -->
                <div class="col-md-12" style="margin-bottom:1%;">
                  <label for="">Tipe Pengajaran Yang Anda Perlukan</label>
                  <br>
                  @foreach ($tipe_pengajaran as $val)
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipe_pengajaran"
                      value="{{ $val->tipe_pengajaran_id }}">
                    <label class="form-check-label">
                      {{ $val->tipe_pengajaran->tipe }}
                    </label>
                  </div>
                  @endforeach
                </div>
                <div class="col-md-12 mb-3">
                  <label for="harga_jam">Jumlah Jam Yang Anda Perlukan</label>
                  <input id="jumlah_jam" class="col-md-12 form-control" type="number" name="jumlah_jam"
                    placeholder="Jumlah Jam Yang Anda Perlukan" required>
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
                  <a type="submit" href="{{ url('/cari_mentor') }}" class="btn btn-danger"><i class="fa fa-times"></i>
                    Batalkan</a>
                  <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i class="fa fa-save"></i>
                    Konfirmasi Pemesanan</button>
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
  $(document).ready(function () {
    console.log("Ready !");
    var availableDates = ["9-10-2021", "14-10-2021", "15-10-2021"];

    function available(date) {
      dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
      if ($.inArray(dmy, availableDates) != -1) {
        return [true, "", "Available"];
      } else {
        return [false, "", "unAvailable"];
      }
    }
    $('.datepicker-Senin').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,2,3,4,5,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Selasa').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,1,3,4,5,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Rabu').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,1,2,4,5,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Kamis').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,1,2,3,5,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Jumat').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,1,2,3,4,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Sabtu').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "0,1,2,3,4,5",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
    $('.datepicker-Minggu').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-1',
      daysOfWeekDisabled: "1,2,3,4,5,6",
      todayHighlight: true,
      language: 'id-ID'
    }).on("changeDate", function(e) {
      // console.log('e change date', moment(e.date).format('YYYY-MM-DD'))
      document.getElementById(`date`).value = e.date;
    });
  });

  function showDiv(val) {
    for (let i = 1; i <= 7; i++) {
      const elStart = document.getElementById(`time_start-${i}`);
      const elEnd = document.getElementById(`time_end-${i}`);
      const time = document.getElementById(`select_time-${i}`);
      const date = document.getElementById(`select_date-${i}`);
      const availibility = document.getElementById(`select_availibility-${i}`);
      if (elStart !== null) {
        elStart.style.display = 'none'
      }
      if (elEnd !== null) {
        elEnd.style.display = 'none'
      }
      if (time !== null) {
        time.style.display = 'none'
      }
      if (date !== null) {
        date.style.display = 'none'
      }
      if (availibility !== null) {
        availibility.style.display = 'none'
      }
    }
    // console.log('00', document.getElementById(`time_start-0`))
    // document.getElementById(`time_start-1`).style.display = 'block';
    // document.getElementById(`time_start-2`).style.display = 'block';
    // document.getElementById(`time_start-3`).style.display = 'block';
    // document.getElementById(`time_start-4`).style.display = 'block';
    // document.getElementById(`time_start-5`).style.display = 'block';
    // document.getElementById(`time_start-6`).style.display = 'block';
    // document.getElementById(`time_start-7`).style.display = 'block';

    const dayRequest = document.getElementById("day_request").value;
    const idDay = dayRequest.split('-')[1];
    document.getElementById(`time_start-${idDay}`).style.display = 'block';
    document.getElementById(`time_end-${idDay}`).style.display = 'block';
    document.getElementById(`select_time-${idDay}`).style.display = 'block';
    document.getElementById(`select_date-${idDay}`).style.display = 'block';
    document.getElementById(`select_availibility-${idDay}`).style.display = 'block';
  }


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
  var countChecked = function () {
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
  var time_start = document.getElementById("time_start");
  var time_end = document.getElementById("time_end");

  // time_start.addEventListener("selected")
  time_start.addEventListener('change', function () {
    // alert(this.value);
    var jumlah_hari_dipilih = $('input[name="hari_dibutuhkan[]"]:checked').length;
    var get_harga = $('#harga_perjam').val();
    jumlah_jam.value = this.value;
    var jumlah = jumlah_jam.value;
    // if
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
  }, false);
  jumlah_jam.addEventListener("keyup", function (e) {
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
  // function convertRupiah(angka, prefix) {
  //     var number_string = angka.replace(/[^,\d]/g, "").toString(),
  //         split = number_string.split(","),
  //         sisa = split[0].length % 3,
  //         rupiah = split[0].substr(0, sisa),
  //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  //     if (ribuan) {
  //         separator = sisa ? "." : "";
  //         rupiah += separator + ribuan.join(".");
  //     }
  //     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  //     return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
  // }
  // jumlah_jam.addEventListener('keydown', function(event) {
  //     console.log(jumlah_jam.value);
  //     $('#sub_total_view').empty();
  //     $('#sub_total_view').append('<h3 id="sub_total_view"><b>Sub Total : Rp. '+get_harga+'</b></h3>');
  // });
  // $(function () {
  //      $('#datetimepicker5').datetimepicker({
  //          defaultDate: "11/1/2013",
  //          disabledDates: [
  //              moment("12/25/2013"),
  //              new Date(2013, 11 - 1, 21),
  //              "11/22/2013 00:53"
  //          ]
  //      });
  //  });

</script>
@endsection
