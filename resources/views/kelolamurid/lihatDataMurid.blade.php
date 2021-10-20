@extends('layouts.homepage')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="text-primary" style="font-size:35px;">DATA MURID</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Murid</li>
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
                                <table id="dataTable" class="table table-bordered table-hover text-center" style="width:100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Provinsi</th>
                                            <th>Kota Tinggal</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan</th>
                                            <th>Detail Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data_user as $key => $val)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $val->nama }}</td>
                                                <td>{{ $val->email }}</td>
                                                @if ($val->no_hp != null)
                                                    <td>{{ $val->no_hp }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                @if ($val->gender_id != null)
                                                    <td>{{ $val->gender->gender }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                @if ($val->detail_alamat_id != null)
                                                    <td>{{ $val->detail_alamat->provinsi }}</td>
                                                    <td>{{ $val->detail_alamat->kota }}</td>
                                                    <td>{{ $val->detail_alamat->kecamatan }}</td>
                                                    <td>{{ $val->detail_alamat->desa }}</td>
                                                    <td>{{ $val->detail_alamat->alamat_detail }}</td>
                                                @else
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                @endif
                                                <td>
                                                    <a href="{{ url('/detail/user/' . $val->id) }}" type="button"
                                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
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
