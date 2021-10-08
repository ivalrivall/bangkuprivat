<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\User;
use App\Models\tbl_detail_mentor;
use App\Models\master_skill;
use App\Models\master_hari;
use App\Models\master_tipe_pengajaran;
use App\Models\detail_hari;
use App\Models\detail_tipe_pengajaran;
use App\Models\detail_skill;

class UserPengajuanMentorController extends Controller
{
    public function pengajuan_mentor()
    {
      $cek_ = tbl_detail_mentor::where('user_id',auth()->user()->id)->count();
      if($cek_ == 0){
        $skill = master_skill::where('status_id',2)->orderby('skill','asc')->get();
        $hari = master_hari::all();
        $tipe_pengajaran = master_tipe_pengajaran::all();
        return view('pengajuanmentor_user.mulai_pengajuan', compact('skill','hari','tipe_pengajaran'));
      }else{
        $cek_pengajuan = tbl_detail_mentor::where('user_id',auth()->user()->id)->where('status_id',11)->count();
        $data_pengajuan = tbl_detail_mentor::where('user_id',auth()->user()->id)->get();
        return view('pengajuanmentor_user.pengajuan_mentor', compact('cek_pengajuan','data_pengajuan'));
      }
    }

    public function pengajuan_ulang()
    {
      $cek_ = tbl_detail_mentor::where('user_id',auth()->user()->id)
                                ->where('status_id',1)
                                ->count();
      if($cek_ == 0){
        $skill = master_skill::where('status_id',2)->get();
        $hari = master_hari::all();
        $tipe_pengajaran = master_tipe_pengajaran::all();
        return view('pengajuanmentor_user.mulai_pengajuan', compact('skill','hari','tipe_pengajaran'));
      }else{
        return redirect('/user/pengajuan_mentor');
      }
    }

    public function cari_data_skill(Request $request)
    {
        $data = DB::connection()->select("select * from master_skill
                                          where status_id = 2
                                          and id not in($request->id)
                                          order by skill asc
                                         ");
        return json_encode(['response' => "success",
                            'data' => $data]);
    }

    public function store(Request $request)
    {
      try {
        DB::beginTransaction();
          $resume = $request->file('file_resume');
          $sub_path = time();
          $tujuan_upload = 'resume_mentor';
          $upload = $resume->getClientOriginalName();
          $extension =$resume->getClientOriginalExtension();
          $path =$resume->getRealPath();
          $resume->move($tujuan_upload.'/'.$sub_path, $upload);

          $harga_jam = preg_replace("/[^0-9]/", "", $request->harga_jam);
          $detail_mentor = new tbl_detail_mentor;
          $detail_mentor->user_id = auth()->user()->id;
          $detail_mentor->detail_skill = $request->detail_skill;
          $detail_mentor->biodata = $request->biodata;
          $detail_mentor->detail_pengajaran = $request->metode_pengajaran;
          $detail_mentor->pengalaman_ngajar = $request->pengalaman_ngajar;
          $detail_mentor->medsos_linkedin = $request->medsos_linkedin;
          $detail_mentor->medsos_github = $request->medsos_github;
          $detail_mentor->instagram = $request->medsos_instagram;
          $detail_mentor->harga_perjam = $harga_jam;
          $detail_mentor->document = $upload;
          $detail_mentor->path_document = $sub_path;
          $detail_mentor->status_id = 1;
          if($detail_mentor->save()){
            foreach($request->keahlian as $key => $skill){
              $detail_skill = new detail_skill;
              $detail_skill->detail_mentor_id = $detail_mentor->id;
              $detail_skill->skill_id = $skill;
              $detail_skill->lama_pengalaman = $request->pengalaman_bidang[$key];
              // $detail_skill->end_jam = $request->end_jam[$key];
              $detail_skill->save();
            }
            foreach($request->hari_mengajar as $key => $hari){
              $detail_hari = new detail_hari;
              $detail_hari->detail_mentor_id = $detail_mentor->id;
              $detail_hari->hari_id = $hari;
              $detail_hari->start_jam = $request->start_jam[$key];
              $detail_hari->end_jam = $request->end_jam[$key];
              $detail_hari->save();
            }
            foreach($request->tipe_pengajaran as $tipe_pengajaran){
              $detail_tipe = new detail_tipe_pengajaran;
              $detail_tipe->detail_mentor_id = $detail_mentor->id;
              $detail_tipe->tipe_pengajaran_id = $tipe_pengajaran;
              $detail_tipe->save();
            }
            DB::commit();
            return Redirect::back()->with('success', 'Pengajuan Anda Sebagai Mentor Success !!!');
          }else{
            DB::rollback();
            return Redirect::back()->with('failed', 'Pengajuan Anda Sebagai Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
          }
        }catch(Throwable $e){
          report($e);
          return false;
          return Redirect::back()->with('failed', 'Pengajuan Anda Sebagai Mentor Failed, Silahkan Cek Kembali Data Anda !!!');
        }
    }
    public function detail_pengajuan_mentor($id)
    {
      $detail_mentor = DB::connection()->table('master_user as a')
                                    ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                    ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                    ->join('master_gender as d','d.id','=','a.gender_id')
                                    ->where('b.id',$id)
                                    ->select('a.id as id_user','a.email','a.nama','a.tempat_lahir','a.tgl_lahir','a.no_hp','d.gender','a.fhoto','a.path_fhoto',
                                            'b.id as id_detail_mentor','b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','b.harga_perjam',
                                            'b.medsos_linkedin','b.medsos_github','b.instagram','b.document','b.path_document','c.alamat_detail','c.provinsi','c.kota','c.kecamatan','c.desa')
                                    ->first();
      $detail_skill = detail_skill::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_hari = detail_hari::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      return view('pengajuanmentor_user.detail_pengajuan_mentor', compact('detail_mentor','detail_skill','detail_hari','detail_tipe_pengajaran'));
    }

}
