@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="text-primary" style="font-size:40px;">DATA RESERVASI</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <li class="breadcrumb-item active">Data Reservasi</li>
              </ol>
          </div>
      </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Reservasi</h3>
          </div><br>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Murid</th>
                    <th>Jenis Kelamin</th>
                    <th>No. HP</th>
                    <th>Kebutuhan</th>
                    <th>Spesifikasi Kebutuhan</th>
                    <th>Nama Mentor</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @foreach($data_reservasi as $key => $val)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$val->user->email}}</td>
                      <td>{{$val->user->nama}}</td>
                      <td>{{$val->user->gender->gender}}</td>
                      <td>{{$val->user->no_hp}}</td>
                      <td>{{$val->kebutuhan->kebutuhan}}</td>
                      <td>{{substr($val->detail_kebutuhan, 0, 30)}}...</td>
                      <td>{{$val->mentor->nama}}</td>
                      <td class="text-info"><i>{{$val->status->status}}</i></td>
                      <td>
                        @if(auth()->user()->level_id == 2 && $val->status_id == 10)
                          <a href="{{ url('/reservasi/selesai/'.$val->id) }}" type="button" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Selesai</a>
                        @endif
                        <a href="{{ url('/reservasi/detail/'.$val->id) }}" type="button" class="btn btn-sm btn-info mt-1"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
