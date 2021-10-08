@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="text-primary" style="font-size:40px;">HISTORY RESERVASI</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item active">History Reservasi</li>
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
            @if(count($history_reservasi) == 0)
              <div class="row">
                <div class="card col-sm-12 mb-3 text-center">
                  <h5 class="text-center text-danger"><i>Tidak Ada Data History Reservasi.</i></h5>
                </div>
              </div>
            @else
              @foreach($history_reservasi as $key => $value)
                <div class="row" style="margin-bottom:auto;">
                  <div class="card col-sm-1 text-center">
                    <!-- @if($value->user->fhoto != null)
                      <a><img src="{{url('/Foto_Profile/'.$value->user->path_fhoto,$value->user->fhoto)}}" class="img-circle mt-3" style="width:100%;max-height:50%;"></a>
                    @else
                      <a><img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-3" style="width:100%;"></a>
                    @endif
                    <hr> -->
                    @if($value->mentor->fhoto != null)
                      <a><img src="{{url('/Foto_Profile/'.$value->mentor->path_fhoto,$value->mentor->fhoto)}}" class="img-circle mt-4" style="width:100%;max-height:50%;"></a>
                    @else
                      <a><img src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-4" style="width:100%;"></a>
                    @endif
                  </div>
                  <div class="card col-sm-2 mb-3 text-center">
                    <p style="margin-bottom:-2%;"><b>Nama Murid</b></br>{{$value->user->nama}}</p>
                    <hr>
                    <p><b>Nama Mentor</b></br>{{$value->mentor->nama}}</p>
                  </div>
                  <div class="card col-sm-4">
                    <p class="text-center" style="margin-bottom:-2%;"><b>Kebutuhan</b></br>{{$value->kebutuhan->kebutuhan}}</p>
                    <hr>
                    <p class="text-center"><b>Detail Kebutuhan</b></br>{{$value->detail_kebutuhan}}</p>
                  </div>
                  <div class="card col-sm-3">
                    @if($value->status_id == 3 || $value->status_id == 4)
                      <br><br>
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-info">Menunggu Konfirmasi.</i></p>
                    @elseif($value->status_id == 5)
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-primary">Silahkan Melakukan Pembayaran.</i></p>
                      <hr>
                      <a type="button" data-toggle="modal" data-target="#Modal_Bayar" class="btn btn-sm btn-info text-light" onclick="bayar({{$value->id}})"><i class="fas fa-money"></i> Bayar</a>
                    @elseif($value->status_id == 6 || $value->status_id == 7)
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-danger">Reservasi DiTolak.</i></p>
                      <hr>
                      <p class="text-center"><b>Alasan </b></br>{{$value->alasan_ditolak}}</p>
                    @elseif($value->status_id == 8)
                      @if($value->pembayaran_id != null)
                        <!-- <a href="{{ url('/Pembayaran_Reservasi/'.$value->pembayaran->path_bukti,$value->pembayaran->bukti_transfer) }}" target="blank_" type="button" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i> Cek Bukti Pembayaran</a> -->
                        <a type="button" data-toggle="modal" data-target="#Modal_Cek_pembayaran" class="btn btn-sm btn-warning" title="Cek Bukti Pembayaran" onclick="cek_pembayaran({{$value->id}});"><i class="fa fa-search"></i> Cek Pembayaran</a>
                      @endif
                      <hr>
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-success">Menunggu Konfirmasi.</i></p>
                    @elseif($value->status_id == 9)
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-danger">Pembayaran DiTolak.</i></p>
                      <hr>
                      <p class="text-center"><b>Alasan </b></br>{{$value->alasan_ditolak}}</p>
                    @elseif($value->status_id == 10)
                      <br><br>
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-success">Reservasi Sedang Berjalan.</i></p>
                    @elseif($value->status_id == 11)
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-primary">Reservasi Selesai, Silahkan Berikan Ulasan.</i></p>
                      <hr>
                      <a type="button" data-toggle="modal" data-target="#Modal_Ulasan" class="btn btn-sm btn-warning" onclick="ulasan({{$value->id}})"><i class="fas fa-pen"></i> Berikan Ulasan</a>
                    @elseif($value->status_id == 12)
                      <p class="text-center" style="margin-bottom:-2%;"><b>Status </b></br><i class="text-primary">Reservasi Selesai, Terima Kasih.</i></p>
                      <hr>
                      <a class="text-center" style="margin-top:-5%;">
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
                      <p class="text-center"><b>Ulasan : </b></br>{{$value->ulasan}}</p>
                    @endif
                  </div>
                  <div class="card col-sm-2 text-center"><br><br>
                    <a href="{{url('/detail_reservasi/user/'.$value->id)}}" type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Cek Detail</a>
                    <a>{{date('d M Y', strtotime($value->created_at))}}</p>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal for Bayar Reservasi-->
<div class="modal fade" id="Modal_Bayar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form class="form-horizontal" action="{{url('/pembayaran/reservasi')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="Title_bayar">Pembayaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <input id="id_reservasi" name="id_reservasi" type="hidden" class="form-control" readonly>
        <div class="modal-body card mx-2">
          <div class="row">
              <div class="col-md-12">
                <a style="text-align:justify;">*<i>Setelah melakukan pembayaran harap konfirmasi ke admin melalui nomor yang tersedia pada saat proses reservasi sebelumnya.</i></a>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <a style="text-align:justify;">**<i>Setelah melakukan pembayaran mentor akan menghubungi anda mengenai proses pembelajaran.</i></a>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <a style="text-align:justify;">***<i>Setelah proses pembayaran terlaksana proses pembelajaran akan dimulai sesuai jadwal yang ditentukan.</i></a>
              </div>
          </div><br>
          <div class="row mx-2">
            <div class="card col-sm-6 mb-3 text-center">
              <h5>Transfer Pembayaran</h5>
              <h5 id="sub_total">Sub Total : <b>1.000</b></h5>
              @foreach($tbl_informasi as $key => $val)
              <div class="row card-body" style="margin-left:20%;">
                <div class="col-md-1">
                  <i class="fas fa-home"></i>
                </div>
                <div class="col-md-7">
                  <a class="text-primary">{{$val->nama_bank}}</br>{{$val->no_rekening}}</br>{{$val->atas_nama}}</a>
                </div>
              </div>
              @if(count($tbl_informasi) > 1 && $key == 0)
                <h5>or</h5><br>
              @endif
              @endforeach
            </div>
            <div class="card col-sm-6 mb-3">
              <label><b>Upload Bukti Transfer</b></label>
              <input type="file" class="form-control" name="bukti_transfer" required><br>
              <label><b>Asal Bank</b></label>
              <input type="text" class="form-control" name="asal_bank" placeholder="Masukkan Bank Yang Digunakan" required><br>
              <label><b>Atas Nama Pengirim</b></label>
              <input type="text" class="form-control" name="atas_nama_pengirim" placeholder="Masukkan Atas Nama Pengirim" required><br>
            </div><br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i class="fa fa-save"></i> Simpan Pembayaran</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Untuk Ulasan. -->
<div class="modal fade" id="Modal_Ulasan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form class="form-horizontal" action="{{url('/beri/ulasan')}}" method="POST">
      @csrf
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="Title_Penolakan">Ulasan Hasil Pembelajaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <input id="id_reservasi_ulasan" type="hidden" name="id_reservasi">
          <div class="row">
            <div class="card col-sm-12 mb-3">
              <div class="media">
                <img id="ulas_fhoto" src="{{url('/TemplateHome/dist/img/user.jpg')}}" class="img-circle mt-5" style="width:15%;">
              	<div class="media-body">
                  <div class="row ml-3">
                    <a class="col-md-3"><b>Nama</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_nama" class="col-md-6 text-left">nama</a>
                  </div>
                  <div class="row ml-3">
                    <a class="col-md-3"><b>Jenis Kelamin</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_gender" class="col-md-6 text-left">gender</a>
                  </div>
                  <div class="row ml-3">
                    <a class="col-md-3"><b>Tanggal Lahir</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_tgl_lahir" class="col-md-6 text-left">tgl_lahir</a>
                  </div><br>
                  <div class="row ml-3">
                    <a class="col-md-3"><b>Email</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_email" class="col-md-6 text-left">email</a>
                  </div>
                  <div class="row ml-3">
                    <a class="col-md-3"><b>No. Hp/Tlp</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_no_hp" class="col-md-6 text-left">no_hp</a>
                  </div>
                  <div class="row ml-3">
                    <a class="col-md-3"><b>Pengalaman</b></a>
                    <a class="col-md-1">:</a>
                    <a id="ulas_tahun_ngajar" class="col-md-6 text-left">Tahun Mengajar</a>
                  </div><br>
                  <div class="row ml-3">
                    <a id="ulas_harga_perjam" class="col-md-4 text-left"><b class="bg-success">Rp. harga_perjam / Jam</b></a>
                  </div><br>
              	</div>
              </div>
            </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Berikan Rating Anda</label>
              <!-- untuk rating bintang -->
              <div class="col-md-6 mt-1 ml-2">
                  <a id="bintang_1" type="button" onclick="cek_bintang(1)" style="color:grey;"><i class="fas fa-star"></i></a>
                  <a id="bintang_2" type="button" onclick="cek_bintang(2)" style="color:grey;"><i class="fas fa-star"></i></a>
                  <a id="bintang_3" type="button" onclick="cek_bintang(3)" style="color:grey;"><i class="fas fa-star"></i></a>
                  <a id="bintang_4" type="button" onclick="cek_bintang(4)" style="color:grey;"><i class="fas fa-star"></i></a>
                  <a id="bintang_5" type="button" onclick="cek_bintang(5)" style="color:grey;"><i class="fas fa-star"></i></a>
              </div>
              <input id="jml_bintang" type="hidden" name="jml_bintang">
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Berikan Ulasan Anda</label>
              <div class="col-md-6">
                  <textarea name="ulasan" class="form-control" placeholder="Berikan Ulasan Anda" required></textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')"><i class="fas fa-pen"></i> Ulas</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Cek Pembayaran -->
<div class="modal fade" id="Modal_Cek_pembayaran" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="Title_Pembayaran">Bukti Pembayaran {{auth()->user()->nama}}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Email User</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" value="{{auth()->user()->email}}" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Nama User</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" value="{{auth()->user()->nama}}" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Atas Nama Pengirim</label>
              <div class="col-md-6">
                  <input id="pembayaran_nama_pengirim" type="text" class="form-control" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">Bank Pengirim</label>
              <div class="col-md-6">
                  <input id="pembayaran_bank_pengirim" type="text" class="form-control" readonly>
              </div>
          </div>
          <div class="form-group row text-center">
              <label class="col-md-12 col-form-label">Bukti Transfer</label><br>
              <div class="col-md-12">
                  <a id="a_img_bukti" href="{{ url('/Pembayaran_Reservasi/') }}" target="blank_">
                    <img id="img_bukti" src="{{ url('/Pembayaran_Reservasi/') }}" alt="" style="min-width:250px;min-height:250px; max-width:250px;max-height:250px;">
                  </a>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function bayar(id_reservasi) {
    $.ajax({
         async: false,
         type:'get',
         url:'/get_data_reservasi',
         data:{ _token : '{{ csrf_token() }}',
              id_reservasi : id_reservasi }
         ,success:function(response){
         respon = $.parseJSON(response);
            if(respon.response == 'success')
            {
                 var data = respon.data_reservasi;
                 var id_reservasi = data.id;
                 var total_biaya = data.total_biaya;
                 $('#id_reservasi').val(id_reservasi);
                 var total_biaya = total_biaya.toString(),
                   sisa 	= total_biaya.length % 3,
                   rupiah 	= total_biaya.substr(0, sisa),
                   ribuan 	= total_biaya.substr(sisa).match(/\d{3}/gi);
                   if (ribuan) {
                           separator = sisa ? '.' : '';
                           rupiah += separator + ribuan.join('.');
                        }
                   total_biaya = 'Rp. '+rupiah;
                 $('#sub_total').empty();
                 $('#sub_total').append('<h5 id="sub_total">Sub Total : <b>'+total_biaya+'</b></h5>');
            }else{
                 console.log('Data Tidak Tersedia');
                 alert('Data Tidak Tersedia');
            }
         },
    });
}
function cek_pembayaran(obj)
{
     var id_reservasi = obj;
     $.ajax({
          async: false,
          type:'get',
          url:'{{url('/get_data_pembayaran_user')}}',
          data:{ _token : '{{ csrf_token() }}',
               id_reservasi : id_reservasi }
          ,success:function(response){
          respon = $.parseJSON(response);
             if(respon.response == 'success')
             {
                  var data = respon.data_pembayaran;
                  if(data.path_bukti != null){
                    var fhoto = "/Pembayaran_Reservasi/"+data.path_bukti+"/"+data.bukti_transfer;
                  }else{
                    var fhoto = "/TemplateHome/dist/img/user.jpg";
                  }
                  var atas_nama_pengirim = data.atas_nama_pengirim;
                  var asal_bank = data.asal_bank;
                  $('#img_bukti').attr('src',fhoto);
                  $('#a_img_bukti').attr('href',fhoto);
                  $('#pembayaran_nama_pengirim').val(atas_nama_pengirim);
                  $('#pembayaran_bank_pengirim').val(asal_bank);
             }else{
                  console.log('Data Tidak Tersedia');
                  alert('Data Tidak Tersedia');
             }
          },
     });
}
function ulasan(id_reservasi) {
    $.ajax({
         async: false,
         type:'get',
         url:'/get_datamentor/ulas',
         data:{ _token : '{{ csrf_token() }}',
              id_reservasi : id_reservasi }
         ,success:function(response){
         respon = $.parseJSON(response);
            if(respon.response == 'success')
            {
                 var data = respon.data;
                 $('#id_reservasi_ulasan').val(id_reservasi);
                 if(data.path_fhoto != null){
                   var fhoto = "/Foto_Profile/"+data.path_fhoto+"/"+data.fhoto;
                 }else{
                   var fhoto = "/TemplateHome/dist/img/user.jpg";
                 }
                 var email = data.email;
                 var nama = data.nama;
                 var gender = data.gender;
                 var tgl_lahir = data.tgl_lahir;
                 var no_hp = data.no_hp;
                 var pengalaman_ngajar = data.pengalaman_ngajar;
                 var harga_perjam = data.harga_perjam;
                 var harga_perjam = harga_perjam.toString(),
                   sisa 	= harga_perjam.length % 3,
                   rupiah 	= harga_perjam.substr(0, sisa),
                   ribuan 	= harga_perjam.substr(sisa).match(/\d{3}/gi);
                   if (ribuan) {
                           separator = sisa ? '.' : '';
                           rupiah += separator + ribuan.join('.');
                        }
                   harga_perjam = 'Rp. '+rupiah;
                 $('#ulas_fhoto').attr('src',fhoto);
                 $('#ulas_nama').empty();
                 $('#ulas_nama').append('<a id="ulas_nama" class="col-md-6 text-left">'+nama+'</a>');
                 $('#ulas_gender').empty();
                 $('#ulas_gender').append('<a id="ulas_gender" class="col-md-6 text-left">'+gender+'</a>');
                 $('#ulas_tgl_lahir').empty();
                 $('#ulas_tgl_lahir').append('<a id="ulas_tgl_lahir" class="col-md-6 text-left">'+tgl_lahir+'</a>');
                 $('#ulas_email').empty();
                 $('#ulas_email').append('<a id="ulas_email" class="col-md-6 text-left">'+email+'</a>');
                 $('#ulas_no_hp').empty();
                 $('#ulas_no_hp').append('<a id="ulas_no_hp" class="col-md-6 text-left">'+no_hp+'</a>');
                 $('#ulas_tahun_ngajar').empty();
                 $('#ulas_tahun_ngajar').append('<a id="ulas_tahun_ngajar" class="col-md-6 text-left">'+pengalaman_ngajar+' Tahun Mengajar</a>');
                 $('#ulas_harga_perjam').empty();
                 $('#ulas_harga_perjam').append('<a id="ulas_harga_perjam" class="col-md-4 text-left"><b class="bg-success">'+harga_perjam+' / Jam</b></a>');
            }else{
                 console.log('Data Tidak Tersedia');
                 alert('Data Tidak Tersedia');
            }
         },
    });
}
function cek_bintang(val) {
  if(val == 1){
    $('#bintang_1').attr('style', 'color:orange');
    $('#bintang_2').attr('style', 'color:grey');
    $('#bintang_3').attr('style', 'color:grey');
    $('#bintang_4').attr('style', 'color:grey');
    $('#bintang_5').attr('style', 'color:grey');
    $('#jml_bintang').val(1);
  }else if(val == 2){
    $('#bintang_1').attr('style', 'color:orange');
    $('#bintang_2').attr('style', 'color:orange');
    $('#bintang_3').attr('style', 'color:grey');
    $('#bintang_4').attr('style', 'color:grey');
    $('#bintang_5').attr('style', 'color:grey');
    $('#jml_bintang').val(2);
  }else if(val == 3){
    $('#bintang_1').attr('style', 'color:orange');
    $('#bintang_2').attr('style', 'color:orange');
    $('#bintang_3').attr('style', 'color:orange');
    $('#bintang_4').attr('style', 'color:grey');
    $('#bintang_5').attr('style', 'color:grey');
    $('#jml_bintang').val(3);
  }else if(val == 4){
    $('#bintang_1').attr('style', 'color:orange');
    $('#bintang_2').attr('style', 'color:orange');
    $('#bintang_3').attr('style', 'color:orange');
    $('#bintang_4').attr('style', 'color:orange');
    $('#bintang_5').attr('style', 'color:grey');
    $('#jml_bintang').val(4);
  }else if(val == 5){
    $('#bintang_1').attr('style', 'color:orange');
    $('#bintang_2').attr('style', 'color:orange');
    $('#bintang_3').attr('style', 'color:orange');
    $('#bintang_4').attr('style', 'color:orange');
    $('#bintang_5').attr('style', 'color:orange');
    $('#jml_bintang').val(5);
  }
}
</script>
@endsection
