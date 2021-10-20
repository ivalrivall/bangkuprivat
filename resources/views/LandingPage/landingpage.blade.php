<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cari Mentor Anda Bersama Kami | Bangku Privat</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ url('/landingpage/css/styleslandingpage.css') }}" rel="stylesheet" />
    <!-- Footer start  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Footer end  -->
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img class="img_navbar"
                    src="{{ asset('landingpage/assets/img/iconBPdark.png') }}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ url('/landingpage/bantuan') }}">Bantuan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="s01">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        {{-- <h1 class="mx-auto my-0 text-uppercase">Bangku Privat</h1> --}}
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Bergabung Bersama Kami Dan Temukan Mentor Terbaik
                            Anda
                            Disini...</h2>
                    </div>
                </div>
            </div>
            {{-- <form class="d-flex justify-content-center align-items-center"> --}}
            {{-- <h1 class="border">Bergabung Bersama Kami Temukan Mentor Terbaik Anda Disini...</h1> --}}
            {{-- <div class="inner-form rounded">
                    <div class="input-field first-wrap">
                        <input class="rounded" id="search" type="text" title="Pilih Subjek"
                            placeholder="Pilih Subjek" />
                    </div>
                    <div class="divider-search rounded"></div>
                    <div class="input-field second-wrap">
                        <input class="rounded" id="location" type="text" title="Masukan Lokasi Atau Wilayah"
                            placeholder="Masukan Lokasi Atau Wilayah" />
                    </div>

                    <div class="input-field third-wrap">
                        <button class="btn-search rounded" type="button">Temukan Mentor</button>
                    </div>
                </div> --}}
            {{-- </form> --}}
        </div>
    </header>

    <!-- Start Footer  -->
    <footer class="mainfooter" role="contentinfo">
        <div class="footer-middle">
            <div class="footercontainer container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <!--Column1-->
                        <div class="footer-pad">
                            <h4>Tentang</h4>
                            <ul class="list-unstyled">
                                <li><a href="#">Sejarah</a></li>
                                <li><a href="#">Visi & Misi</a></li>
                                <li><a href="#">Syarat & Ketentuan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <!--Column2-->
                        <div class="footer-pad">
                            <h4>Bantuan</h4>
                            <ul class="list-unstyled">
                                <li><a href="#Bantuan">Butuh Bantuan ?</a></li>
                                <li><a href="#Kontak">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <!--Column3-->
                        <div class="footer-pad">
                            <h4>Kanal Kami</h4>
                            <ul class="social-network social-circle">
                                <li><a href="https://www.youtube.com/channel/UCAlK8edDZkN5Ci9hiKIRf6w" target="_blank" rel="noopener" or rel="noreferrer"
                                        class="icoYoutube" title="Youtube"><i class="fa fa-youtube-play"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/bangkuprivat.id/" target="_blank" rel="noopener" or rel="noreferrer"
                                        class="icoInstagram" title="Instagram"><i class="fa fa-instagram"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://hubb.link/bangkuprivat/" target="_blank" rel="noopener" or rel="noreferrer" class="icoBangkuprivat"
                                        title="Bangku Privat"><img
                                            src="{{ asset('landingpage/assets/img/logoBP-bgwhite.png') }}"
                                            class="___class_+?43___" style="width:30px" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <!--Column4-->
                        <div class="footer-pad">
                            <h4>Komunitas Kami</h4>
                            <ul class="social-network social-circle">
                                <li><a href="https://t.me/joinchat/7yL-cRZ0SmU4MDhl" target="_blank" rel="noopener" or rel="noreferrer"
                                        class="icoTelegram" title="Telegram"><i class="fa fa-telegram"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 copy">
                        <p class="text-center">&copy; 2021 Hak Cipta Terpelihara Lembaga Kursus Bangku Privat.
                            Jelajahi
                            & Temukan Mentor</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

    <!-- Script  -->
    <link href="{{ url('/landingpage/css/styleslandingpage.css') }}" rel="stylesheet" />
    {{-- Footer start --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- Footer end --}}
    {{-- Landing Page --}}
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ url('/landingpage/js/scripts.js') }}"></script>

</body>

</html>
