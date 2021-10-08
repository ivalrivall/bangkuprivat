<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Redirect;

class RegisterUserController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        $cek_email = User::where('email', $request->email)->count();
        if ($cek_email != 0) {
            DB::rollback();
            return Redirect::back()->with('failed','Register Failed, Email Telah Terdaftar !!!');
        }else{
            $register = new User;
            $register->nama = $request->name;
            $register->email = $request->email;
            $register->status_id = 2;
            $register->level_id = 1;
            $register->password = Hash::make($request->password);
            if ($register->save()) {
                DB::commit();
                return redirect('/login')->with('success','Register Success, Silahkan Login !!!');
            } else {
                DB::rollback();
                return Redirect::back()->with('failed','Register Failed, Email Telah Terdaftar !!!');
            }
        }
    }
}
