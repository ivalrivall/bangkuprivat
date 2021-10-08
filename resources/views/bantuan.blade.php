@extends('layouts.homepage')
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body mt-2">
        <div class="row">
          <div class="card col-md-12">
            <h3 class="text-center bg-info text-light">PERTANYAAN UMUM</h3>
            <div class="mb-3">
              @foreach($bantuan as $key => $value)
                <div id="edit_bantuan_{{$key}}" class="row ml-3">
                  <h5 class="col-md-11 ml-2"><b>{{$value->judul_bantuan}}</b></h5>
                  @if(auth()->user()->level_id == 3)
                    <a type="button" class="btn btn-sm btn-warning text-dark" title="Edit Data Bantuan" onclick="edit_bantuan({{$key}});">
                      <i class="fas fa-pen"></i>
                    </a>
                  @endif
                  <p class="col-md-11 ml-2" style="text-align:justify;white-space: pre-line;">{{$value->bantuan}}</p>
                </div>
                <div id="text_bantuan_{{$key}}" class="ml-4" style="display:none;">
                  <form class="form-horizontal" action="{{url('/edit_bantuan/'.$value->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-11">
                          <textarea name="judul_bantuan" class="form-control col-md-12" placeholder="Masukkan Judul Bantuan" required>{{$value->judul_bantuan}}</textarea>
                        </div>
                        <div class="col-md-11">
                          <textarea name="bantuan" class="form-control col-md-12" placeholder="Masukkan Deskripsi Bantuan" style="height:200%;" required>{{$value->bantuan}}</textarea>
                        </div>
                    </div><br><br>
                      <button type="submit" class="btn btn-sm btn-info text-light" title="Simpan Edit" ><i class="fas fa-save"></i> Simpan</button>
                      <a type="button" class="btn btn-sm btn-warning text-dark" title="Cancel Edit" onclick="cancel_edit_bantuan({{$key}});"><i class="fas fa-times"></i> Cancel</a>
                  </form><br>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit_bantuan(val) {
      $('#edit_bantuan_'+val).hide();
      $('#text_bantuan_'+val).show();
  }
  function cancel_edit_bantuan(val) {
    $('#edit_bantuan_'+val).show();
    $('#text_bantuan_'+val).hide();
  }
</script>
@endsection
