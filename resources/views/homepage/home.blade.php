@extends('layouts.homepage')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="row mt-5">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body text-center">Jumlah Murid</div>
                                    <h1 class="text-center"><i class="fas fa-users"></i></h1>
                                    <h5 class="text-center">{{ $jumlah_murid }} Murid</h5>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                              <a class="small text-white stretched-link" href="{{ url('/lihatdatauser') }}">View Details</a>
                                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                          </div> -->
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body text-center">Jumlah Mentor</div>
                                    <h1 class="text-center"><i class="fas fa-user"></i></h1>
                                    <h5 class="text-center">{{ $jumlah_mentor }} Mentor</h5>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                              <a class="small text-white stretched-link" href="{{ url('/lihatdatamentor') }}">View Details</a>
                                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                          </div> -->
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body text-center">Total Reservasi</div>
                                    <h1 class="text-center"><i class="fas fa-clock"></i></h1>
                                    <h5 class="text-center">{{ $jumlah_reservasi }} Jam</h5>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                              <a class="small text-white stretched-link" href="{{ url('/reservasi') }}">View Details</a>
                                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                          </div> -->
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" style="background-color:orange;">
                                    <div class="card-body text-center">Total Biaya Reservasi</div>
                                    <h1 class="text-center"><i class="fas fa-money"></i></h1>
                                    <h5 class="text-center">Rp. {{ number_format($jumlah_biaya, 0, ',', '.') }}</h5>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                              <a class="small text-white stretched-link" href="{{ url('/reservasi') }}">View Details</a>
                                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                          </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
