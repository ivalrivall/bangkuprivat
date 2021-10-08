<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Hash;
use File;
use App\Models\User;
use App\Models\detail_alamat;
use App\Models\master_gender;
use App\Models\tbl_detail_mentor;
use App\Models\tbl_reservasi;
use App\Models\detail_skill;
use App\Models\detail_hari;
use App\Models\detail_tipe_pengajaran;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  public function cek_alert_pengajuan()
  {
    $cek_data = tbl_detail_mentor::where('status_id', 1)->count();
    return json_encode([
      'response' => "success",
      'data' => $cek_data
    ]);
  }
  public function cek_alert_reservasi()
  {
    $cek_data_req_admin = tbl_reservasi::where('status_id', 3)->count();
    $cek_data_req_mentor = tbl_reservasi::where('status_id', 4)->where('mentor_id', auth()->user()->id)->count();
    return json_encode([
      'response' => "success",
      'data_admin' => $cek_data_req_admin,
      'data_mentor' => $cek_data_req_mentor
    ]);
  }

  public function home()
  {
    $my_user = auth()->user();
    if ($my_user->tempat_lahir == null && $my_user->tgl_lahir == null && $my_user->gender_id == null && $my_user->no_hp == null && $my_user->detail_alamat_id == null) {
      return redirect('/akun_setting')->with('failed', 'Silahkan Lengkapi Biodata Diri Anda Terlebih Dahulu.');
    } else {
      $id = auth()->user()->id;
      if (auth()->user()->level_id == 1) {
        // JIKA LOGIN SEBAGAI MURID, TAMPIL HOME PAGE INI.
        $detail_user = User::find($id);
        return view('homepage.homepage_murid', compact('detail_user'));
      } elseif (auth()->user()->level_id == 2) {
        // JIKA LOGIN SEBAGAI MENTOR, TAMPIL HOME PAGE INI.
        $detail_mentor = DB::connection()->table('master_user as a')
          ->leftjoin('tbl_detail_mentor as b', 'a.id', '=', 'b.user_id')
          ->join('detail_alamat as c', 'c.id', '=', 'a.detail_alamat_id')
          ->join('master_gender as d', 'd.id', '=', 'a.gender_id')
          ->where('a.id', $id)
          ->select(
            'a.id as id_user',
            'a.email',
            'a.nama',
            'a.tempat_lahir',
            'a.tgl_lahir',
            'a.no_hp',
            'd.gender',
            'a.fhoto',
            'a.path_fhoto',
            'b.id as id_detail_mentor',
            'b.detail_skill',
            'b.biodata',
            'b.detail_pengajaran',
            'b.pengalaman_ngajar',
            'b.harga_perjam',
            'b.medsos_linkedin',
            'b.medsos_github',
            'b.instagram',
            'b.document',
            'b.path_document',
            'c.alamat_detail',
            'c.provinsi',
            'c.kota',
            'c.kecamatan',
            'c.desa'
          )
          ->first();
        $detail_skill = detail_skill::where('detail_mentor_id', $detail_mentor->id_detail_mentor)->get();
        $detail_hari = detail_hari::where('detail_mentor_id', $detail_mentor->id_detail_mentor)->get();
        $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id', $detail_mentor->id_detail_mentor)->get();
        $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                                    FROM ulasan_mentor a,
                                                         tbl_reservasi b
                                                    WHERE a.reservasi_id = b.id
                                                    AND b.mentor_id =$id");
        return view('homepage.homepage_mentor', compact('detail_mentor', 'detail_skill', 'detail_hari', 'detail_tipe_pengajaran', 'jml_ulasan'));
      } elseif (auth()->user()->level_id == 3) {
        // JIKA LOGIN SEBAGAI ADMIN, TAMPIL HOME PAGE INI.
        $jumlah_murid = User::where('level_id', 1)->count();
        $jumlah_mentor = User::where('level_id', 2)->count();
        $jam_reservasi = DB::connection()->select("select sum(jumlah_jam) as total_reservasi from tbl_reservasi where status_id = 12");
        $jumlah_reservasi = $jam_reservasi[0]->total_reservasi;
        $biaya_reservasi = DB::connection()->select("select sum(total_biaya) as total_biaya from tbl_reservasi where status_id = 12");
        $jumlah_biaya = $biaya_reservasi[0]->total_biaya;
        return view('homepage.home', compact('jumlah_murid', 'jumlah_mentor', 'jumlah_reservasi', 'jumlah_biaya'));
      }
    }
  }

  public function akun_setting()
  {
    $my_user = User::find(auth()->user()->id);
    $gender = master_gender::all();
    return view('homepage.akun_pengaturan', compact('my_user', 'gender'));
  }

  public function update_profile(Request $request)
  {
    $cek_user = User::find($request->id_user);
    if ($request->myfoto != null) {
      $myfoto = $request->file('myfoto');
      if ($cek_user->path_fhoto != null) {
        $sub_path = $cek_user->path_fhoto;
      } else {
        $sub_path = time();
      }
      $tujuan_upload = 'Foto_Profile';
      $upload = $myfoto->getClientOriginalName();
      $extension = $myfoto->getClientOriginalExtension();
      $path = $myfoto->getRealPath();
      $myfoto->move($tujuan_upload . '/' . $sub_path, $upload);
    }
    DB::beginTransaction();
    $cek_email = User::where('id', '<>', $request->id_user)->where('email', '=', $request->email)->count();
    if ($cek_email != 0) {
      DB::rollback();
      return Redirect::back()->with('failed', 'Update Your Profile Failed, Email Telah Tersedia !!!');
    } else {
      if ($request->id_detail_alamat == null) {
        $ubah_alamat = new detail_alamat;
      } else {
        $ubah_alamat = detail_alamat::find($request->id_detail_alamat);
      }
      $ubah_alamat->alamat_detail = $request->alamat_detail;
      $ubah_alamat->provinsi = $request->provinsi;
      $ubah_alamat->kota = $request->kota;
      $ubah_alamat->kecamatan = $request->kecamatan;
      $ubah_alamat->desa = $request->desa;
      if ($ubah_alamat->save()) {
        $ubah_profile = User::find($request->id_user);
        $ubah_profile->email = $request->email;
        $ubah_profile->nama = $request->nama;
        $ubah_profile->tempat_lahir = $request->tempat_lahir;
        $ubah_profile->tgl_lahir = $request->tgl_lahir;
        $ubah_profile->gender_id = $request->gender;
        $ubah_profile->no_hp = $request->no_hp;
        $ubah_profile->detail_alamat_id = $ubah_alamat->id;
        if ($request->myfoto != null) {
          $ubah_profile->fhoto = $upload;
          $ubah_profile->path_fhoto = $sub_path;
        }
        if ($ubah_profile->save()) {
          DB::commit();
          return Redirect::back()->with('success', 'Update Your Profile Success !!!');
        } else {
          DB::rollback();
          return Redirect::back()->with('failed', 'Update Your Profile Failed, Silahkan Cek Kembali Data Anda !!!');
        }
      } else {
        DB::rollback();
        return Redirect::back()->with('failed', 'Update Your Profile Failed, Silahkan Cek Kembali Data Anda !!!');
      }
    }
  }

  public function update_password(Request $request)
  {
    DB::beginTransaction();
    $old_pass = $request->old_pass;
    $new_pass = $request->new_pass;
    $conf_new_pass = $request->confirm_new_pass;
    $cek_password = User::find($request->id_user);
    if (!Hash::check($old_pass, $cek_password->password)) {
      DB::rollback();
      return Redirect::back()->with('failed', 'Update Your Password Failed, Password Lama Anda Salah !!!');
    } else {
      if (Hash::check($new_pass, $cek_password->password)) {
        DB::rollback();
        return Redirect::back()->with('failed', 'Update Your Password Failed, Tidak Dapat Menggunakan Password Lama !!!');
      } else {
        if ($new_pass == $conf_new_pass) {
          $reset = DB::table('master_user')
            ->where('id', $request->id_user)
            ->update([
              'password' => Hash::make($new_pass)
            ]);
          if ($reset != 0) {
            DB::commit();
            return Redirect::back()->with('success', 'Update Your Password Success !!!');
          } else {
            DB::rollback();
            return Redirect::back()->with('failed', 'Update Your Password Failed, Silahkan Cek Kembali Data Anda !!!');
          }
        } else {
          DB::rollback();
          return Redirect::back()->with('failed', 'Update Your Password Failed, Password Baru Anda Tidak Sesuai !!!');
        }
      }
    }
  }
}
