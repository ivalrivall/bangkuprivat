@extends('layouts.homepage')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-8">
              <h1 class="text-primary" style="font-size:35px;">DATA MENTOR</h1>
          </div>
          <div class="col-sm-4">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                  <li class="breadcrumb-item active">Data Mentor</li>
              </ol>
          </div>
      </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <!-- <a href="" type="button" class="btn btn-success"><i class="fa fa-users-plus"></i> Create Data Mentor</a> -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Mentor</h3>
          </div><br>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Jenis Kelamin</th>
                    <th>Kota Tinggal</th>
                    <th>Detail Skill</th>
                    <th>Pengalaman Mengajar</th>
                    <th>Harga /Jam</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @foreach($data_mentor as $key => $val)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$val->nama}}</td>
                      <td>{{$val->email}}</td>
                      <td>{{$val->no_hp}}</td>
                      <td>{{$val->gender}}</td>
                      <td>{{$val->kota}}</td>
                      <td>{{substr($val->detail_skill, 0, 50)}}...</td>
                      <td>{{$val->pengalaman_ngajar}} Tahun</td>
                      <td>Rp. {{ number_format($val->harga_perjam,0,",",".") }}</td>
                      <td>
                          <!-- <a href="" type="button" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a> -->
                          <a href="{{ url('/detail/mentor/'.$val->id) }}" type="button" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
