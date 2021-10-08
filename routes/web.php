<?php

use Illuminate\Support\Facades\Route;
use App\Models\tbl_bantuan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  // return view('welcome');
  if (auth()->user() != null) {
    return redirect('/home');
  } else {
    return view('LandingPage.landingpage');
  }
});
Route::get('/landingpage/bantuan', function () {
  // return view('welcome');
  if (auth()->user() != null) {
    return redirect('/home');
  } else {
    $bantuan = tbl_bantuan::all();
    return view('LandingPage.landingpage_bantuan', compact('bantuan'));
  }
});

Auth::routes();
// ROUTE FOR LUPA PASSWORD/KATA SANDI
Route::get('/lupa_pass/send/email', [App\Http\Controllers\LupaPassController::class, 'index']);
Route::get('/lupa_pass/verif/kode', [App\Http\Controllers\LupaPassController::class, 'cek_kode']);
Route::post('/reset/password', [App\Http\Controllers\LupaPassController::class, 'reset_password']);
// ROUTE REGISTER
Route::post('/registeruser', [App\Http\Controllers\RegisterUserController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
  Route::get('/akun_setting', [App\Http\Controllers\HomeController::class, 'akun_setting']);
  Route::post('/akun_setting/profile/update', [App\Http\Controllers\HomeController::class, 'update_profile']);
  Route::post('/akun_setting/password/update', [App\Http\Controllers\HomeController::class, 'update_password']);
  Route::get('/cek_alert_pengajuan', [App\Http\Controllers\HomeController::class, 'cek_alert_pengajuan']);
  Route::get('/cek_alert_reservasi', [App\Http\Controllers\HomeController::class, 'cek_alert_reservasi']);
  Route::get('/bantuan', [App\Http\Controllers\BantuanController::class, 'index']);
  Route::group(['middleware' => 'admin'], function () {
    // EDIT BANTUAN
    Route::patch('/edit_bantuan/{id}', [App\Http\Controllers\BantuanController::class, 'edit_bantuan']);
    // MANAGEMENT DATA MENTOR
    Route::get('/lihatdatamentor', [App\Http\Controllers\KelolaMentorController::class, 'lihatdatamentor']);
    Route::get('/detail/mentor/{id}', [App\Http\Controllers\KelolaMentorController::class, 'detailmentor']);
    Route::get('/kelas_selesai/mentor', [App\Http\Controllers\KelolaMentorController::class, 'kelas_selesai']);
    // MANAGEMENT DATA USER
    Route::get('/lihatdatauser', [App\Http\Controllers\KelolaMuridController::class, 'lihatdatauser']);
    Route::get('/detail/user/{id}', [App\Http\Controllers\KelolaMuridController::class, 'detailuser']);
    // MANAGEMENT PENGAJUAN SEBAGAI MENTOR
    Route::get('/pengajuan_mentor', [App\Http\Controllers\DataPengajuanMentorController::class, 'pengajuan_mentor']);
    Route::get('/pengajuan_mentor/approve/{id}', [App\Http\Controllers\DataPengajuanMentorController::class, 'pengajuan_approve']);
    Route::get('/pengajuan_mentor/reject', [App\Http\Controllers\DataPengajuanMentorController::class, 'pengajuan_reject']);
    Route::get('/get_data_pengajuanmentor', [App\Http\Controllers\DataPengajuanMentorController::class, 'data_pengajuanmentor']);
    Route::get('/detail_pengajuan_mentor/{id}', [App\Http\Controllers\DataPengajuanMentorController::class, 'detail_pengajuan_mentor']);
    // MANAGEMENT PERUBAHAN DATA MENTOR
    Route::get('/manage/perubahan_data', [App\Http\Controllers\KelolaPerubahanDataController::class, 'index']);
    Route::get('/manage/detail_perubahan_data/{id}', [App\Http\Controllers\KelolaPerubahanDataController::class, 'detail']);
    Route::get('/pengajuan_perubahan/approve/{id}', [App\Http\Controllers\KelolaPerubahanDataController::class, 'approve_perubahan']);
    Route::get('/pengajuan_perubahan/reject/{id}', [App\Http\Controllers\KelolaPerubahanDataController::class, 'reject_perubahan']);
    // Route::post('/pengajuan_perubahan/reject', [App\Http\Controllers\KelolaPerubahanDataController::class, 'reject_perubahan']);
  });
  Route::group(['middleware' => 'admin_mentor'], function () {
    // MANAGEMENT PENGAJUAN RESERVASI USER
    Route::get('/request/reservasi', [App\Http\Controllers\KelolaReservasiController::class, 'request_reservasi']);
    Route::get('/reservasi/detail/{id}', [App\Http\Controllers\KelolaReservasiController::class, 'reservasi_detail']);
    Route::get('/request_reservasi/approve/{id}', [App\Http\Controllers\KelolaReservasiController::class, 'approve']);
    Route::get('/request_reservasi/reject', [App\Http\Controllers\KelolaReservasiController::class, 'reject']);
    Route::get('/get_data_pembayaran', [App\Http\Controllers\KelolaReservasiController::class, 'get_data_pembayaran']);
    Route::get('/reservasi', [App\Http\Controllers\KelolaReservasiController::class, 'index']);
    Route::get('/reservasi/selesai/{id}', [App\Http\Controllers\KelolaReservasiController::class, 'reservasi_selesai']);
  });
  // CARI MENTOR FOR ALL LEVEL
  Route::get('/cari_mentor', [App\Http\Controllers\UserReservasiController::class, 'cari_mentor']);
  Route::post('/cari_data_mentor', [App\Http\Controllers\UserReservasiController::class, 'cari_data_mentor']);
  Route::get('/pengajuan/{id}', [App\Http\Controllers\UserReservasiController::class, 'pengajuan']);
  Route::get('/tampil_lebih_banyak', [App\Http\Controllers\UserReservasiController::class, 'tampil_lebih_banyak']);

  Route::group(['middleware' => 'mentor'], function () {
    // PENGAJUAN PERUBAHAN DATA MENTOR
    Route::get('/perubahan_data/mentor', [App\Http\Controllers\PerubahanDataController::class, 'perubahan']);
    Route::post('/perubahan_data/mentor/save', [App\Http\Controllers\PerubahanDataController::class, 'perubahan_data']);
  });

  Route::group(['middleware' => 'user_mentor'], function () {
    Route::group(['middleware' => 'cek_data'], function () {
      Route::get('/cari_data_skill', [App\Http\Controllers\UserPengajuanMentorController::class, 'cari_data_skill']);

      // PENGAJUAN RESERVASI USER DAN MENTOR

      Route::get('/pengajuan/reservasi/{id}', [App\Http\Controllers\UserReservasiController::class, 'pengajuan_reservasi']);
      Route::post('/user/pengajuan/reservasi', [App\Http\Controllers\UserReservasiController::class, 'store']);
      Route::get('/history/reservasi', [App\Http\Controllers\UserReservasiController::class, 'index']);
      Route::get('/detail_reservasi/user/{id}', [App\Http\Controllers\UserReservasiController::class, 'detail']);
      Route::get('/get_data_reservasi', [App\Http\Controllers\UserReservasiController::class, 'get_data_reservasi']);
      Route::get('/get_data_pembayaran_user', [App\Http\Controllers\UserReservasiController::class, 'get_data_pembayaran']);
      Route::post('/pembayaran/reservasi', [App\Http\Controllers\UserReservasiController::class, 'pembayaran']);
      Route::get('/get_datamentor/ulas', [App\Http\Controllers\UserReservasiController::class, 'get_data_mentor']);
      Route::post('/beri/ulasan', [App\Http\Controllers\UserReservasiController::class, 'ulasan']);
      Route::group(['middleware' => 'user'], function () {
        // PENGAJUAN SEBAGAI MENTOR USER
        Route::get('/user/pengajuan_mentor', [App\Http\Controllers\UserPengajuanMentorController::class, 'pengajuan_mentor']);
        Route::get('/user/pengajuan_mentor/ulang', [App\Http\Controllers\UserPengajuanMentorController::class, 'pengajuan_ulang']);
        Route::post('/user/pengajuan_mentor', [App\Http\Controllers\UserPengajuanMentorController::class, 'store']);
        Route::get('/detail_pengajuan_mentor/user/{id}', [App\Http\Controllers\UserPengajuanMentorController::class, 'detail_pengajuan_mentor']);
      });
    });
  });
});
