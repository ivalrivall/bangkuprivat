<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\tbl_bantuan;

class BantuanController extends Controller
{
    public function index()
    {
        $bantuan = tbl_bantuan::all();
        return view('bantuan', compact('bantuan'));
    }

    public function edit_bantuan(Request $request, $id)
    {
        DB::beginTransaction();
        $update_bantuan = tbl_bantuan::find($id);
        $update_bantuan->judul_bantuan = $request->judul_bantuan;
        $update_bantuan->bantuan = $request->bantuan;
        if($update_bantuan->save()){
          DB::commit();
          return Redirect::back();
        }else{
          DB::rollback();
          return Redirect::back();
        }
    }
}
