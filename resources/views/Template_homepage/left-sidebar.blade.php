<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <a class="brand-link">
            <img src="{{ asset('landingpage/assets/img/iconBPdark.png') }}" alt="Logo Bangku Privat"
                style="width:100%;">
        </a>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="row ml-2 ">
                @if (auth()->user()->fhoto != null)
                    <img src="{{ url('/Foto_Profile/' . auth()->user()->path_fhoto, auth()->user()->fhoto) }}"
                        class="elevation-2 rounded-circle " alt="User Image">
                    <a href="#" class="d-block mt-1 ml-2 nama-left">{{ auth()->user()->nama }}</a>
                @else
                    <img src="{{ url('/TemplateHome/dist/img/user.jpg') }}" class="elevation-2 rounded-circle"
                        alt="User Image">
                    <a href="#" class="d-block mt-1 ml-2 nama-left">{{ auth()->user()->nama }}</a>
                @endif
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->level_id == 3)
                    <li class="nav-header"><u>MANAGEMENT DATA</u></li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>User Management<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/lihatdatauser') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Murid</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/lihatdatamentor') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Mentor</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/manage/perubahan_data') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perubahan Data Mentor</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/pengajuan_mentor') }}" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Peng. Sebagai Mentor</p>
                            <i id="icon_bell" class="nav-icon fas fa-bell text-warning" style="display:none;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/kelas_selesai/mentor') }}" class="nav-link">
                            <i class="nav-icon fas fa-award"></i>
                            <p>Review Kelas Selesai</p>
                        </a>
                    </li>
                    <li class="nav-header"><u>TRANSAKSI</u></li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Reservasi
                                <i id="div_icon_reservasi" class="nav-icon fas fa-bell text-warning"
                                    style="display:none;"></i>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/request/reservasi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Request Reservasi</p>
                                    <i id="icon_reservasi" class="nav-icon fas fa-bell text-warning"
                                        style="display:none;"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/reservasi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Reservasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cari_mentor') }}" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>Cari Mentor</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->level_id == 2)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>Menu Mentor
                                <i id="div_icon_reservasi_mentor" class="nav-icon fas fa-bell text-warning"
                                    style="display:none;"></i>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/request/reservasi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permintaan Reservasi</p>
                                    <i id="icon_reservasi_mentor" class="nav-icon fas fa-bell text-warning"
                                        style="display:none;"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/reservasi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Reservasi</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/perubahan_data/mentor') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelola Kelas Mentor</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Menu Umum<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/history/reservasi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Histori Reservasi</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/cari_mentor') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cari Mentor</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->level_id == 1)
                    <li class="nav-header"><u>TRANSAKSI UMUM</u></li>
                    <li id="umum_cari_mentor" class="nav-item">
                        <a href="{{ url('/cari_mentor') }}" class="nav-link" disable>
                            <i class="nav-icon fas fa-search"></i>
                            <p>Cari Mentor</p>
                        </a>
                    </li>
                    <li id="umum_history_reservasi" class="nav-item">
                        <a href="{{ url('/history/reservasi') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Histori Reservasi</p>
                        </a>
                    </li>
                    <li id="umum_pengajuan_mentor" class="nav-item">
                        <a href="{{ url('/user/pengajuan_mentor') }}" class="nav-link">
                            <i class="nav-icon fas fa-hand-holding"></i>
                            <p>Pengajuan Sebagai Mentor</p>
                        </a>
                    </li>
                @endif
                <li class="nav-header"><u>LAIN-LAIN</u></li>
                <li class="nav-item">
                    <a href="{{ url('/akun_setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Akun & Pengaturan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/bantuan') }}" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Bantuan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ url('/cek_alert_pengajuan') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                respon = $.parseJSON(response);
                if (respon.response == 'success') {
                    var data = respon.data;
                    if (data != 0) {
                        $('#icon_bell').show();
                    } else {
                        $('#icon_bell').hide();
                    }
                } else {
                    $('#icon_bell').hide();
                    console.log('Data Tidak Tersedia');
                }
            },
        });
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ url('/cek_alert_reservasi') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                respon = $.parseJSON(response);
                if (respon.response == 'success') {
                    var data_admin = respon.data_admin;
                    if (data_admin != 0) {
                        $('#icon_reservasi').show();
                        $('#div_icon_reservasi').show();
                    } else {
                        $('#icon_reservasi').hide();
                        $('#div_icon_reservasi').hide();
                    }
                    var data_mentor = respon.data_mentor;
                    if (data_mentor != 0) {
                        $('#icon_reservasi_mentor').show();
                        $('#div_icon_reservasi_mentor').show();
                    } else {
                        $('#icon_reservasi_mentor').hide();
                        $('#div_icon_reservasi_mentor').hide();
                    }
                } else {
                    $('#icon_reservasi').hide();
                    $('#div_icon_reservasi').hide();
                    $('#icon_reservasi_mentor').hide();
                    $('#div_icon_reservasi_mentor').hide();
                    console.log('Data Tidak Tersedia');
                }
            },
        });
    });
</script>
