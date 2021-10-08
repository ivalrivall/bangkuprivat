<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\User;
use App\Models\tbl_detail_mentor;
use App\Models\master_skill;
use App\Models\master_hari;
use App\Models\detail_skill;
use App\Models\detail_hari;
use App\Models\detail_tipe_pengajaran;
use App\Models\perubahan_detail_mentor;
use App\Models\perubahan_detail_skill;
use App\Models\perubahan_detail_hari;
use App\Models\perubahan_detail_tipe_pengajaran;

class KelolaPerubahanDataController extends Controller
{
    public function index()
    {
      $data_pengajuan = perubahan_detail_mentor::where('status_id','<>',15)->get();
      return view('kelolaperubahanmentor.pengajuan_mentor', compact('data_pengajuan'));
    }

    public function approve_perubahan($id)
    {
      try {
        DB::beginTransaction();
          $approve = perubahan_detail_mentor::find($id);
          $approve->status_id = 15;
          $nama_user = User::find($approve->user_id);
          if($approve->save()){
            $id_detail_mentor = tbl_detail_mentor::where('user_id',$approve->user_id)->first();
            $perubahan_detail_mentor = tbl_detail_mentor::find($id_detail_mentor->id);
            $perubahan_detail_mentor->detail_skill = $approve->detail_skill;
            $perubahan_detail_mentor->biodata = $approve->biodata;
            $perubahan_detail_mentor->detail_pengajaran = $approve->detail_pengajaran;
            $perubahan_detail_mentor->pengalaman_ngajar = $approve->pengalaman_ngajar;
            $perubahan_detail_mentor->harga_perjam = $approve->harga_perjam;
            $perubahan_detail_mentor->medsos_linkedin = $approve->medsos_linkedin;
            $perubahan_detail_mentor->medsos_github = $approve->medsos_github;
            $perubahan_detail_mentor->instagram = $approve->instagram;
            if($approve->document != null && $approve->path_document != null){
              $perubahan_detail_mentor->document = $approve->document;
              $perubahan_detail_mentor->path_document = $approve->path_document;
            }
            if($perubahan_detail_mentor->save()){
              $detail_skill = detail_skill::where('detail_mentor_id',$id_detail_mentor->id)->delete();
              $perubahan_skill = perubahan_detail_skill::where('perubahan_detail_mentor_id',$id)->get();
              foreach($perubahan_skill as $key => $skill){
                $detail_skill = new detail_skill;
                $detail_skill->detail_mentor_id = $id_detail_mentor->id;
                $detail_skill->skill_id = $skill->skill_id;
                $detail_skill->lama_pengalaman = $skill->lama_pengalaman;
                $detail_skill->save();
              }
              $detail_hari = detail_hari::where('detail_mentor_id',$id_detail_mentor->id)->delete();
              $perubahan_hari = perubahan_detail_hari::where('perubahan_detail_mentor_id',$id)->get();
              foreach($perubahan_hari as $key => $hari){
                $detail_hari = new detail_hari;
                $detail_hari->detail_mentor_id = $id_detail_mentor->id;
                $detail_hari->hari_id = $hari->hari_id;
                $detail_hari->start_jam = $hari->start_jam;
                $detail_hari->end_jam = $hari->end_jam;
                $detail_hari->save();
              }
              $detail_hari = detail_tipe_pengajaran::where('detail_mentor_id',$id_detail_mentor->id)->delete();
              $perubahan_tipe = perubahan_detail_tipe_pengajaran::where('perubahan_detail_mentor_id',$id)->get();
              foreach($perubahan_tipe as $tipe_pengajaran){
                $detail_tipe = new detail_tipe_pengajaran;
                $detail_tipe->detail_mentor_id = $id_detail_mentor->id;
                $detail_tipe->tipe_pengajaran_id = $tipe_pengajaran->tipe_pengajaran_id;
                $detail_tipe->save();
              }
              perubahan_detail_hari::where('perubahan_detail_mentor_id',$id)->delete();
              perubahan_detail_skill::where('perubahan_detail_mentor_id',$id)->delete();
              perubahan_detail_tipe_pengajaran::where('perubahan_detail_mentor_id',$id)->delete();
              perubahan_detail_mentor::find($id)->delete();
              DB::commit();
              return Redirect::back()->with('success', 'Approve Pengajuan '.$nama_user->nama.' Perubahan Data Mentor Success !!!');
            }else{
              DB::rollback();
              return Redirect::back()->with('failed', 'Approve Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
            }
          }else{
            DB::rollback();
            return Redirect::back()->with('failed', 'Approve Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
          }
        }catch(Throwable $e){
          report($e);
          return false;
          return Redirect::back()->with('failed', 'Approve Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
        }
    }

    public function reject_perubahan($id)
    {
        DB::beginTransaction();
        $tolak1 = perubahan_detail_hari::where('perubahan_detail_mentor_id',$id);
        if($tolak1->delete()){
          $tolak2 = perubahan_detail_skill::where('perubahan_detail_mentor_id',$id);
          if($tolak2->delete()){
            $tolak3 = perubahan_detail_tipe_pengajaran::where('perubahan_detail_mentor_id',$id);
            if($tolak3->delete()){
              $tolak4 = perubahan_detail_mentor::find($id);
              if($tolak4->delete()){
                DB::commit();
                return Redirect::back()->with('success', 'Tolak Pengajuan Success !!!');
              }else{
                DB::rollback();
                return Redirect::back()->with('failed', 'Tolak Pengajuan Failed, Silahkan Cek Kembali Data Anda !!!');
              }
            }else{
              DB::rollback();
              return Redirect::back()->with('failed', 'Tolak Pengajuan Failed, Silahkan Cek Kembali Data Anda !!!');
            }
          }else{
            DB::rollback();
            return Redirect::back()->with('failed', 'Tolak Pengajuan Failed, Silahkan Cek Kembali Data Anda !!!');
          }
        }else{
          DB::rollback();
          return Redirect::back()->with('failed', 'Tolak Pengajuan Failed, Silahkan Cek Kembali Data Anda !!!');
        }
        // $reject = perubahan_detail_mentor::find($request->id_pengajuan);
        // $nama_user = User::find($reject->user_id);
        // $reject->status_id = 16;
        // $reject->alasan_ditolak = $request->alasan_ditolak;
        // if($reject->save()){
        //   DB::commit();
        //   return Redirect::back()->with('success', 'Reject Pengajuan '.$nama_user->nama.' Perubahan Data Mentor Success !!!');
        // }else{
        //   DB::rollback();
        //   return Redirect::back()->with('failed', 'Reject Pengajuan Perubahan Data Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
        // }
    }

    public function detail($id)
    {
      $detail_perubahan = DB::connection()->table('master_user as a')
                                    ->leftjoin('perubahan_detail_mentor as b','a.id','=','b.user_id')
                                    ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                    ->join('master_gender as d','d.id','=','a.gender_id')
                                    ->where('b.id',$id)
                                    ->select('a.id as id_user','a.email','a.nama','a.tempat_lahir','a.tgl_lahir','a.no_hp','d.gender','a.fhoto','a.path_fhoto',
                                            'b.id as id_detail_mentor','b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','harga_perjam',
                                            'b.medsos_linkedin','b.medsos_github','b.instagram','b.document','b.path_document','c.alamat_detail','c.provinsi','c.kota','c.kecamatan','c.desa')
                                    ->first();
      $detail_mentor = DB::connection()->table('master_user as a')
                                    ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                    ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                    ->join('master_gender as d','d.id','=','a.gender_id')
                                    ->where('a.id',$detail_perubahan->id_user)
                                    ->select('a.id as id_user','a.email','a.nama','a.tempat_lahir','a.tgl_lahir','a.no_hp','d.gender','a.fhoto','a.path_fhoto',
                                            'b.id as id_detail_mentor','b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','harga_perjam',
                                            'b.medsos_linkedin','b.medsos_github','b.instagram','b.document','b.path_document','c.alamat_detail','c.provinsi',
                                            'c.kota','c.kecamatan','c.desa')
                                    ->first();
      $detail_skill = DB::connection()->select("select a.id, a.skill, IFNULL(b.skill_id,0) AS nilai, IFNULL(b.lama_pengalaman,0) AS lama_pengalaman, IFNULL(c.skill_id,0) AS nilai_perubahan, IFNULL(c.lama_pengalaman,0) AS lama_pengalaman_perubahan
                                                FROM master_skill a
                                                     LEFT JOIN (select skill_id, lama_pengalaman
                                                            		FROM detail_skill
                                                            		WHERE detail_mentor_id =:id_detail_mentor) b ON b.skill_id = a.id
                                                     LEFT JOIN (select skill_id, lama_pengalaman
                                                            		FROM perubahan_detail_skill
                                                            		WHERE perubahan_detail_mentor_id =:id_detail_perubahan) c ON c.skill_id = a.id
                                                ORDER BY a.id;",['id_detail_mentor'=>$detail_mentor->id_detail_mentor,"id_detail_perubahan"=>$detail_perubahan->id_detail_mentor]);
      $detail_tipe_pengajaran = DB::connection()->select("select a.id, a.tipe, IFNULL(b.tipe_pengajaran_id,0) AS nilai, IFNULL(c.tipe_pengajaran_id,0) AS nilai_perubahan
                                                          FROM master_tipe_pengajaran a
                                                               LEFT JOIN (select tipe_pengajaran_id
                                                                      		FROM detail_tipe_pengajaran
                                                                      		WHERE detail_mentor_id =:id_detail_mentor) b ON b.tipe_pengajaran_id = a.id
                                                               LEFT JOIN (select tipe_pengajaran_id
                                                                      		FROM perubahan_detail_tipe_pengajaran
                                                                      		WHERE perubahan_detail_mentor_id =:id_detail_perubahan) c ON c.tipe_pengajaran_id = a.id
                                                          ORDER BY a.id;
                                                          ",['id_detail_mentor'=>$detail_mentor->id_detail_mentor,"id_detail_perubahan"=>$detail_perubahan->id_detail_mentor]);
      $detail_hari = DB::connection()->select("select a.id, a.hari, IFNULL(b.hari_id,0) AS nilai, IFNULL(b.start_jam,0) AS start_jam, IFNULL(b.end_jam,0) AS end_jam,
                                                       IFNULL(c.hari_id,0) AS nilai_perubahan, IFNULL(c.start_jam,0) AS start_jam_perubahan, IFNULL(c.end_jam,0) AS end_jam_perubahan
                                                FROM master_hari a
                                                     LEFT JOIN (select hari_id, start_jam, end_jam
                                                            		FROM detail_hari
                                                            		WHERE detail_mentor_id =:id_detail_mentor) b ON b.hari_id = a.id
                                                     LEFT JOIN (select hari_id, start_jam, end_jam
                                                            		FROM perubahan_detail_hari
                                                            		WHERE perubahan_detail_mentor_id =:id_detail_perubahan) c ON c.hari_id = a.id
                                                ORDER BY a.id;
                                                          ",['id_detail_mentor'=>$detail_mentor->id_detail_mentor,"id_detail_perubahan"=>$detail_perubahan->id_detail_mentor]);
      return view('kelolaperubahanmentor.detail_pengajuan_mentor', compact('detail_mentor','detail_skill','detail_hari','detail_tipe_pengajaran','detail_perubahan'));
    }

}
