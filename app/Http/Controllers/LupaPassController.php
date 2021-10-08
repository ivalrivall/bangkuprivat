<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\LupaPassMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\password_resets;
use Redirect;
use Hash;

class LupaPassController extends Controller
{
  public function index(Request $request)
  {
      $token = $request->_token;
      $email = $request->email;
      $cek_email = User::where('email',$email)->count();
      if($cek_email != 0){
        $kode = date('shi');
        $details = [
                    'title' => 'Kode Verifikasi Lupa Password Akun Bangku Private',
                    'body' => 'Kode Verifikasi Anda Adalah :',
                    'kode' => $kode
                  ];
        Mail::to($email)->send(new LupaPassMail($details));
        password_resets::where('email',$email)->delete();
        $save_log = new password_resets;
        $save_log->email = $email;
        $save_log->token = $token;
        $save_log->kode_reset = $kode;
        $save_log->save();
        return json_encode(['response' => "success"]);
      }else{
        return json_encode(['response' => "failed"]);
      }
  }

  public function cek_kode(Request $request)
  {
      $token = $request->_token;
      $kode_from_email = $request->kode_from_email;
      $cek_verifikasi = password_resets::where('token',$token)
                                         ->orderby('created_at','desc')
                                         ->first();
      if($cek_verifikasi->kode_reset == $kode_from_email)
      {
         return json_encode(['response' => "success"]);
      }else{
        return json_encode(['response' => "failed"]);
      }
  }

  public function reset_password(Request $request)
  {
      $token = $request->_token;
      $cek_ = password_resets::where('token',$token)
                               ->orderby('created_at','desc')
                               ->first();
      $cek_email = $cek_->email;
      $change_password = User::where('email',$cek_email)->first();
      $change_password->password = Hash::make($request->new_pass);
      if($change_password->save()){
        return Redirect::back()->with('success','Password Anda Berhasil Dirubah !!!');
      }else{
        return Redirect::back()->with('failed','Password Anda Gagal Dirubah, Cek Kembali Data Anda !!!');
      }

  }
}
