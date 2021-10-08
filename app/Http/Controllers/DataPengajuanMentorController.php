<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\User;
use App\Models\tbl_detail_mentor;
use App\Models\detail_skill;
use App\Models\detail_hari;
use App\Models\detail_tipe_pengajaran;

class DataPengajuanMentorController extends Controller
{
    public function pengajuan_mentor()
    {
      $data_pengajuan = tbl_detail_mentor::where('status_id','<>',2)
                                          ->orderby('status_id','asc')
                                          ->get();
      return view('kelolapengajuanmentor.pengajuan_mentor', compact('data_pengajuan'));
    }

    public function pengajuan_approve($id)
    {
      DB::beginTransaction();
        $approve = tbl_detail_mentor::find($id);
        $approve->status_id = 2;
        $nama_user = User::find($approve->user_id);
        $nama_user->level_id = 2;
      if($approve->save() && $nama_user->save()){
        DB::commit();
        return Redirect::back()->with('success', 'Approve Pengajuan '.$nama_user->nama.' Sebagai Mentor Success !!!');
      }else{
        DB::rollback();
        return Redirect::back()->with('failed', 'Approve Pengajuan Sebagai Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
      }
    }

    public function pengajuan_reject(request $request)
    {
        DB::beginTransaction();
        $reject = tbl_detail_mentor::find($request->id_pengajuan);
        $nama_user = User::find($reject->user_id);
        $reject->status_id = 11;
        $reject->alasan_ditolak = $request->alasan_ditolak;
        if($reject->save()){
          DB::commit();
          return Redirect::back()->with('success', 'Reject Pengajuan '.$nama_user->nama.' Sebagai Mentor Success !!!');
        }else{
          DB::rollback();
          return Redirect::back()->with('failed', 'Reject Pengajuan Sebagai Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
        }
    }

    public function data_pengajuanmentor(request $request)
    {
        $id = $request->id_pengajuan;
        $data = DB::connection()->table('tbl_detail_mentor')
                        ->join('master_user','tbl_detail_mentor.user_id','=','master_user.id')
                        ->where('tbl_detail_mentor.id',$id)
                        ->select('master_user.nama','tbl_detail_mentor.id','tbl_detail_mentor.detail_skill')
                        ->first();
        return json_encode(['response'  => "success",
                            'data'  => $data]);
    }

    public function detail_pengajuan_mentor($id)
    {
      $detail_mentor = DB::connection()->table('master_user as a')
                                    ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                    ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                    ->join('master_gender as d','d.id','=','a.gender_id')
                                    ->where('b.id',$id)
                                    ->select('a.id as id_user','a.email','a.nama','a.tempat_lahir','a.tgl_lahir','a.no_hp','d.gender','a.fhoto','a.path_fhoto',
                                            'b.id as id_detail_mentor','b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','harga_perjam',
                                            'b.medsos_linkedin','b.medsos_github','b.instagram','b.document','b.path_document','c.alamat_detail','c.provinsi','c.kota','c.kecamatan','c.desa')
                                    ->first();
      $detail_skill = detail_skill::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_hari = detail_hari::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      return view('kelolapengajuanmentor.detail_pengajuan_mentor', compact('detail_mentor','detail_skill','detail_hari','detail_tipe_pengajaran'));
    }

}
