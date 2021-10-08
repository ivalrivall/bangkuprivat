<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\tbl_detail_mentor;
use App\Models\master_skill;
use App\Models\master_hari;
use App\Models\detail_skill;
use App\Models\perubahan_detail_mentor;
use App\Models\perubahan_detail_skill;
use App\Models\perubahan_detail_hari;
use App\Models\perubahan_detail_tipe_pengajaran;

class PerubahanDataController extends Controller
{
    public function perubahan()
    {
      $data_mentor = tbl_detail_mentor::where('user_id',auth()->user()->id)->first();
      $hari = DB::connection()->select("select a.*, IFNULL(b.hari_id,0) AS nilai, IFNULL(b.start_jam,0) AS start_jam,
                                        IFNULL(b.end_jam,0) AS end_jam
                                        FROM master_hari a
                                             LEFT JOIN (SELECT hari_id, start_jam, end_jam
                                        		FROM detail_hari
                                        		WHERE detail_mentor_id =:id_data_mentor) b ON b.hari_id = a.id
                                        ORDER BY a.id
                                      ",["id_data_mentor"=>$data_mentor->id]);
      $detail_skill = detail_skill::where('detail_mentor_id',$data_mentor->id)->get();
      // foreach($detail_skill as $val){
      //     $data[] = json_encode($val->skill_id);
      // }
      // $data = json_encode($data);
      // $a = str_replace('"', "", $data);
      // $a = str_replace('[', "", $a);
      // $a = str_replace(']', "", $a);
      // $skill = DB::connection()->select("select * from master_skill where id not in ($a)");
      $skill = master_skill::where('status_id',2)->get();
      $tipe_pengajaran = DB::connection()->select("select a.*, IFNULL(b.tipe_pengajaran_id,0) AS nilai
                                                          FROM master_tipe_pengajaran a
                                                               LEFT JOIN (SELECT tipe_pengajaran_id
                                                          		FROM detail_tipe_pengajaran
                                                          		WHERE detail_mentor_id =:id_data_mentor) b ON b.tipe_pengajaran_id = a.id
                                                          ORDER BY a.id
                                                          ",["id_data_mentor"=>$data_mentor->id]);
      return view('perubahan_data_mentor.perubahan_data_mentor', compact('data_mentor','skill','hari','detail_skill','tipe_pengajaran'));
    }

    public function perubahan_data(Request $request)
    {
        try {
          DB::beginTransaction();
            if($request->file('file_resume') != null){
              $resume = $request->file('file_resume');
              $sub_path = $request->path_document;
              $tujuan_upload = 'resume_mentor';
              $upload = $resume->getClientOriginalName();
              $extension =$resume->getClientOriginalExtension();
              $path =$resume->getRealPath();
              $resume->move($tujuan_upload.'/'.$sub_path, $upload);
            }

            $harga_jam = preg_replace("/[^0-9]/", "", $request->harga_jam);
            $detail_mentor = new perubahan_detail_mentor;
            $detail_mentor->user_id = $request->id_mentor;
            $detail_mentor->detail_skill = $request->detail_skill;
            $detail_mentor->biodata = $request->biodata;
            $detail_mentor->detail_pengajaran = $request->metode_pengajaran;
            $detail_mentor->pengalaman_ngajar = $request->pengalaman_ngajar;
            $detail_mentor->medsos_linkedin = $request->medsos_linkedin;
            $detail_mentor->medsos_github = $request->medsos_github;
            $detail_mentor->instagram = $request->medsos_instagram;
            $detail_mentor->harga_perjam = $harga_jam;
            if($request->file('file_resume') != null){
              $detail_mentor->document = $upload;
              $detail_mentor->path_document = $sub_path;
            }
            $detail_mentor->status_id = 14;
            if($detail_mentor->save()){
              foreach($request->keahlian as $key => $skill){
                $detail_skill = new perubahan_detail_skill;
                $detail_skill->perubahan_detail_mentor_id = $detail_mentor->id;
                $detail_skill->skill_id = $skill;
                $detail_skill->lama_pengalaman = $request->pengalaman_bidang[$key];
                // $detail_skill->deskripsi_skill = $request->deskripsi_skill[$key];
                $detail_skill->save();
              }
              foreach($request->hari_mengajar as $key => $hari){
                $detail_hari = new perubahan_detail_hari;
                $detail_hari->perubahan_detail_mentor_id = $detail_mentor->id;
                $detail_hari->hari_id = $hari;
                $detail_hari->start_jam = $request->start_jam[$key];
                $detail_hari->end_jam = $request->end_jam[$key];
                $detail_hari->save();
              }
              foreach($request->tipe_pengajaran as $tipe_pengajaran){
                $detail_tipe = new perubahan_detail_tipe_pengajaran;
                $detail_tipe->perubahan_detail_mentor_id = $detail_mentor->id;
                $detail_tipe->tipe_pengajaran_id = $tipe_pengajaran;
                $detail_tipe->save();
              }
              DB::commit();
              return Redirect::back()->with('success', 'Pengajuan Perubahan Data Mentor Success !!!');
            }else{
              DB::rollback();
              return Redirect::back()->with('failed', 'Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
            }
          }catch(Throwable $e){
            report($e);
            return false;
            return Redirect::back()->with('failed', 'Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
          }
    }
}
