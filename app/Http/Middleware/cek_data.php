<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cek_data
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if(auth()->user()->gender_id != null && auth()->user()->tempat_lahir != null && auth()->user()->tgl_lahir != null && auth()->user()->detail_alamat_id != null && auth()->user()->no_hp != null){
          return $next($request);
        }else{
          // abort(403,'Halaman Tidak Tersedia.');
          return redirect('/akun_setting')->with('failed','Silahkan Lengkapi Biodata Diri Anda Terlebih Dahulu.');
        }
    }
}
