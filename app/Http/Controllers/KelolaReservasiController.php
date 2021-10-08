<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\models\tbl_reservasi;
use App\models\status_transaksi;
use App\models\detail_skill;
use App\models\detail_hari;
use App\Models\detail_tipe_pengajaran;
use App\Models\detail_reservasi;
use App\Models\ulasan_mentor;

class KelolaReservasiController extends Controller
{
  public function request_reservasi()
  {
    if(auth()->user()->level_id == 3){
      $data_reservasi = tbl_reservasi::whereIn('status_id',[3,4,5,6,7,8,9])
                                      ->orderby('id','desc')
                                      ->get();
    }elseif(auth()->user()->level_id == 2){
      $data_reservasi = tbl_reservasi::whereIn('status_id',[4,5,7])
                                      ->where('mentor_id',auth()->user()->id)
                                      ->orderby('id','desc')
                                      ->get();
    }
      return view('kelolareservasi.request_reservasi', compact('data_reservasi'));
  }

  public function reservasi_detail($id)
  {
      $detail_reservasi = tbl_reservasi::find($id);
      $detail_mentor = DB::connection()->table('master_user as a')
                                    ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                    ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                    ->where('a.id',$detail_reservasi->mentor_id)
                                    ->select('a.id as id_user','a.nama','a.no_hp','a.email','a.fhoto','a.path_fhoto','b.id as id_detail_mentor','b.detail_skill',
                                            'b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','harga_perjam','b.medsos_linkedin','b.medsos_github',
                                            'b.instagram','c.kota')
                                    ->first();
      $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                              FROM ulasan_mentor a,
                                                   tbl_reservasi b
                                              WHERE a.reservasi_id = b.id
                                              AND b.mentor_id =:id_mentor",["id_mentor"=>$detail_mentor->id_user]);
      $detail_skill = detail_skill::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_hari = detail_hari::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
      $jadwal_reservasi = detail_reservasi::where('reservasi_id',$id)->get();
      $ulasan = ulasan_mentor::where('reservasi_id',$id)->first();
      return view('kelolareservasi.detail_reservasi', compact('detail_reservasi','detail_mentor','jml_ulasan','detail_skill','detail_hari','detail_tipe_pengajaran','jadwal_reservasi','ulasan'));
  }

  public function approve($id)
  {
    DB::beginTransaction();
    if(auth()->user()->level_id == 3){
      $approve = tbl_reservasi::find($id);
      if($approve->status_id == 8){
        $approve->status_id = 10;
      }else{
        $approve->status_id = 4;
      }
    }elseif(auth()->user()->level_id == 2){
      $approve = tbl_reservasi::find($id);
      $approve->status_id = 5;
    }
    if($approve->save()){
      DB::commit();
      return Redirect::back()->with('success', 'Approve Reservasi by '.Auth()->user()->level->level.' Success !!!');
    }else{
      DB::rollback();
      return Redirect::back()->with('failed', 'Approve Reservasi Failed, Silahkan Cek Kembali Data Anda !!!');
    }
  }

  public function reject(Request $request)
  {
    DB::beginTransaction();
    if(auth()->user()->level_id == 3){
      $reject = tbl_reservasi::find($request->id_reservasi);
      $reject->status_id = 6;
      $reject->alasan_ditolak = $request->alasan_tolak;
    }elseif(auth()->user()->level_id == 2){
      $reject = tbl_reservasi::find($request->id_reservasi);
      $reject->status_id = 7;
      $reject->alasan_ditolak = $request->alasan_tolak;
    }
    if($reject->save()){
      DB::commit();
      return Redirect::back()->with('success', 'Reject Reservasi by '.Auth()->user()->level->level.' Success !!!');
    }else{
      DB::rollback();
      return Redirect::back()->with('failed', 'Reject Reservasi Failed, Silahkan Cek Kembali Data Anda !!!');
    }
  }

  public function index()
  {
      if(auth()->user()->level_id == 3){
        $data_reservasi = tbl_reservasi::whereIn('status_id',[10,11,12])
                                        ->orderby('id','desc')
                                        ->get();
      }elseif(auth()->user()->level_id == 2){
        $data_reservasi = tbl_reservasi::whereIn('status_id',[10,11,12])
                                        ->where('mentor_id',auth()->user()->id)
                                        ->orderby('id','desc')
                                        ->get();
      }
      return view('kelolareservasi.index_reservasi', compact('data_reservasi'));
  }

  public function reservasi_selesai($id)
  {
    DB::beginTransaction();
    $selesai = tbl_reservasi::find($id);
    $selesai->status_id = 11;
    if($selesai->save()){
      DB::commit();
      return Redirect::back()->with('success', 'Reservasi Telah Selesai, Terima Kasih !!!');
    }else{
      DB::rollback();
      return Redirect::back()->with('failed', 'Reservasi Belum Selesai, Mohon Menunggu !!!');
    }
  }

  public function get_data_pembayaran(Request $request)
  {
      $id_reservasi = $request->id_reservasi;
      $data_pembayaran = tbl_reservasi::join('pembayaran_reservasi','tbl_reservasi.pembayaran_id','=','pembayaran_reservasi.id')
                                        ->select('tbl_reservasi.id','pembayaran_reservasi.bukti_transfer','pembayaran_reservasi.path_bukti',
                                                'pembayaran_reservasi.atas_nama_pengirim','pembayaran_reservasi.asal_bank')
                                        ->where('tbl_reservasi.id',$id_reservasi)
                                        ->first();
      return json_encode(['response' => "success",
                          'data_pembayaran' => $data_pembayaran]);
  }
}
