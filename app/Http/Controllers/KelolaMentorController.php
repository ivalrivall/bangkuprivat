<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\User;
use App\Models\tbl_detail_mentor;
use App\Models\master_skill;
use App\Models\detail_skill;
use App\Models\master_hari;
use App\Models\detail_hari;
use App\Models\detail_tipe_pengajaran;
use App\Models\ulasan_mentor;

class KelolaMentorController extends Controller
{
    public function lihatdatamentor()
    {
        $data_mentor = DB::connection()->table('master_user as a')
                            ->leftjoin('tbl_detail_mentor as b','b.user_id','=','a.id')
                            ->join('master_gender as c','a.gender_id','=','c.id')
                            ->join('detail_alamat as d','a.detail_alamat_id','=','d.id')
                            ->where('a.level_id', 2)
                            ->where('b.status_id', 2)
                            ->select('a.*','c.gender','d.kota','b.detail_skill','b.pengalaman_ngajar','b.harga_perjam')
                            ->get();
        return view('kelolamentor.lihatDataMentor', compact('data_mentor'));
    }

    public function detailmentor($id)
    {
        $detail_mentor = DB::connection()->table('master_user as a')
                                      ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                      ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                      ->join('master_gender as d','d.id','=','a.gender_id')
                                      ->where('a.id',$id)
                                      ->select('a.id as id_user','a.email','a.nama','a.tempat_lahir','a.tgl_lahir','a.no_hp','d.gender','a.fhoto','a.path_fhoto',
                                              'b.id as id_detail_mentor','b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','b.harga_perjam',
                                              'b.medsos_linkedin','b.medsos_github','b.instagram','b.document','b.path_document','c.alamat_detail','c.provinsi','c.kota','c.kecamatan','c.desa')
                                      ->first();
        $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                                FROM ulasan_mentor a,
                                                     tbl_reservasi b
                                                WHERE a.reservasi_id = b.id
                                                AND b.mentor_id =:id_mentor",["id_mentor"=>$detail_mentor->id_user]);
        $detail_skill = detail_skill::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
        $detail_hari = detail_hari::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
        $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
        return view('kelolamentor.detail_mentor', compact('detail_mentor','detail_skill','detail_hari','jml_ulasan','detail_tipe_pengajaran'));
    }

    // public function edit_kelas()
    // {
    //     $data_mentor = tbl_detail_mentor::where('user_id', auth()->user()->id)->first();
    //     $skill = master_skill::where('status_id',2)->get();
    //     $hari = master_hari::all();
    //     return view('kelolamentor.edit_data_mentor', compact('data_mentor','skill','hari'));
    // }
    //
    // public function update_kelas(Request $request)
    // {
    //   dd($request->all());
    // }

    public function kelas_selesai()
    {
        $now = date('Y-m-d');
        $ulasan = DB::connection()->select('select a.id, a.bintang, a.ulasan, b.created_at, c.nama nama_mentor, c.fhoto fhoto_mentor, c.path_fhoto path_fhoto_mentor,
                                            	d.nama nama_murid, d.fhoto fhoto_murid, d.path_fhoto path_fhoto_murid
                                            FROM ulasan_mentor a,
                                                 tbl_reservasi b,
                                                 MASTER_USER c,
                                                 MASTER_USER d

                                            WHERE a.reservasi_id = b.id
                                            AND b.mentor_id = c.id
                                            AND b.user_id = d.id
                                            AND DATE_FORMAT(a.created_at, "%Y-%m-%d") = CURRENT_DATE()');
        return view('kelolamentor.kelas_selesai', compact('ulasan'));
    }
}
