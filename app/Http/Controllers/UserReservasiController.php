<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Carbon\Carbon;
use App\Models\User;
use App\Models\tbl_informasi;
use App\Models\tbl_detail_mentor;
use App\Models\tbl_reservasi;
use App\Models\detail_skill;
use App\Models\detail_hari;
use App\Models\master_kebutuhan;
use App\Models\detail_tipe_pengajaran;
use App\Models\pembayaran_reservasi;
use App\Models\ulasan_mentor;
use App\Models\detail_reservasi;
use PhpParser\Node\Stmt\Foreach_;

class UserReservasiController extends Controller
{
  public function cari_mentor()
  {
      $data_mentor = DB::connection()->table('tbl_detail_mentor as a')
                                     ->join('master_user as b','a.user_id','=','b.id')
                                     ->join('detail_alamat as c','b.detail_alamat_id','=','c.id')
                                     ->select('a.id', 'b.id as id_user', 'b.nama', 'b.fhoto', 'b.path_fhoto', 'c.kota', 'a.harga_perjam', 'a.detail_skill')
                                     ->where('a.status_id',2)
                                     ->where('user_id','<>',auth()->user()->id)
                                     ->simplePaginate(9);
      if(count($data_mentor) != 0){
        foreach($data_mentor as $key => $val){
          $skill = DB::connection()->select("select c.skill
                                              FROM tbl_detail_mentor a
                                                 LEFT JOIN detail_skill b ON  b.detail_mentor_id = a.id
                                                 JOIN master_skill c ON b.skill_id = c.id
                                              where detail_mentor_id = $val->id");
          $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                                  FROM ulasan_mentor a,
                                                       tbl_reservasi b
                                                  WHERE a.reservasi_id = b.id
                                                  AND b.mentor_id =$val->id_user");
            $data[] = array(
                            "id" => $val->id,
                            "nama" => $val->nama,
                            "fhoto" => $val->fhoto,
                            "path_fhoto" => $val->path_fhoto,
                            "kota" => $val->kota,
                            "harga_perjam" => $val->harga_perjam,
                            "detail_skill" => $val->detail_skill,
                            "skill" => $skill,
                            "jml_ulasan" => $jml_ulasan[0]->total_ulasan,
                            "total_bintang" => $jml_ulasan[0]->total_bintang,
                           );
        }
      }else{
        $data = 0;
      }
      return view('reservasi_user.cari_mentor', compact('data_mentor','data'));
  }

  public function cari_data_mentor(Request $request)
  {
    $subject = $request->subject;
    $alamat = $request->alamat;
    $user_id = auth()->user()->id;
    if(auth()->user()->level_id == 2){
      $query = "select a.id, b.id as id_user, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                FROM
                     MASTER_USER b,
                     detail_alamat c,
                     tbl_detail_mentor a
                     LEFT JOIN(select a.detail_mentor_id, b.id, b.skill
                            		FROM detail_skill a,
                            		     master_skill b
                            		WHERE a.skill_id = b.id) d ON d.detail_mentor_id = a.id
                WHERE a.user_id = b.id
                AND b.id = $user_id
                AND a.status_id = 2
                AND b.detail_alamat_id = c.id
                ";
    }else{
      $query = "select a.id, b.id as id_user, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                FROM
                     MASTER_USER b,
                     detail_alamat c,
                     tbl_detail_mentor a
                     LEFT JOIN(select a.detail_mentor_id, b.id, b.skill
                            		FROM detail_skill a,
                            		     master_skill b
                            		WHERE a.skill_id = b.id) d ON d.detail_mentor_id = a.id
                WHERE a.user_id = b.id
                AND a.status_id = 2
                AND b.detail_alamat_id = c.id
                ";
    }
      if($subject != null){
        if($alamat != null){
          $data_mentor = DB::connection()->select("$query AND (b.nama LIKE '%$subject%' OR d.skill LIKE '%$subject%')
                                                  AND c.kota LIKE '%$alamat%'
                                                  GROUP BY a.id, b.id, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                                                  ");
        }else{
          $data_mentor = DB::connection()->select("$query AND (b.nama LIKE '%$subject%' OR d.skill LIKE '%$subject%')
                                                  GROUP BY a.id, b.id, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                                                    ");
        }
      }else{
        if($alamat != null){
          $data_mentor = DB::connection()->select("$query AND c.kota LIKE '%$alamat%'
                                                  GROUP BY a.id, b.id, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                                                  ");
        }else{
          $data_mentor = DB::connection()->select("$query
                                                  GROUP BY a.id, b.id, b.nama, b.fhoto, b.path_fhoto, c.kota, a.harga_perjam, a.detail_skill
                                                  ");
        }
      }
      if(count($data_mentor) != 0){
        foreach($data_mentor as $key => $val){
            $skill = DB::connection()->select("select c.skill
                                              FROM tbl_detail_mentor a
                                                 LEFT JOIN detail_skill b ON  b.detail_mentor_id = a.id
                                                 JOIN master_skill c ON b.skill_id = c.id
                                              where detail_mentor_id = $val->id");
            $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                                    FROM ulasan_mentor a,
                                                         tbl_reservasi b
                                                    WHERE a.reservasi_id = b.id
                                                    AND b.mentor_id =$val->id_user");
            $data[] = array(
                            "id" => $val->id,
                            "nama" => $val->nama,
                            "fhoto" => $val->fhoto,
                            "path_fhoto" => $val->path_fhoto,
                            "kota" => $val->kota,
                            "harga_perjam" => $val->harga_perjam,
                            "detail_skill" => $val->detail_skill,
                            "skill" => $skill,
                            "jml_ulasan" => $jml_ulasan[0]->total_ulasan,
                            "total_bintang" => $jml_ulasan[0]->total_bintang,
                           );
        }
      }else{
        $data = 0;
      }
    return json_encode(['response' => "success",
                        'data_mentor' => $data]);
  }

  public function pengajuan($id)
  {
    $detail_mentor = DB::connection()->table('master_user as a')
                                  ->leftjoin('tbl_detail_mentor as b','a.id','=','b.user_id')
                                  ->join('detail_alamat as c','c.id','=','a.detail_alamat_id')
                                  ->where('b.id',$id)
                                  ->select('a.id as id_user','a.nama','a.no_hp','a.fhoto','a.path_fhoto','b.id as id_detail_mentor','b.user_id as id_mentor',
                                          'b.detail_skill','b.biodata','b.detail_pengajaran','b.pengalaman_ngajar','b.harga_perjam','b.medsos_linkedin',
                                          'b.medsos_github','b.instagram','c.kota')
                                  ->first();
    $jml_ulasan = DB::connection()->select("select SUM(a.bintang) AS total_bintang, COUNT(a.id) AS total_ulasan
                                            FROM ulasan_mentor a,
                                                 tbl_reservasi b
                                            WHERE a.reservasi_id = b.id
                                            AND b.mentor_id =:id_mentor",["id_mentor"=>$detail_mentor->id_user]);
    $ulasan_mentor = ulasan_mentor::join('tbl_reservasi','ulasan_mentor.reservasi_id','=','tbl_reservasi.id')
                                    ->join('master_user','tbl_reservasi.user_id','=','master_user.id')
                                    ->where('tbl_reservasi.mentor_id',$detail_mentor->id_user)
                                    ->select('master_user.nama','master_user.path_fhoto','master_user.fhoto',
                                             'ulasan_mentor.created_at','ulasan_mentor.ulasan','ulasan_mentor.bintang')
                                    ->limit(5)
                                    ->get();
    $detail_skill = detail_skill::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
    $detail_hari = detail_hari::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
    $detail_reservasi = detail_reservasi::whereHas('reservasi', function($q) use ($detail_mentor) {
        $q->where('mentor_id', $detail_mentor->id_user)
        ->whereIn('status_id', [10,5,8]);
    })->get();
    // $current = strtotime('00:00:00');
    // $end = strtotime('24:00:00');
    // $ketersediaan = [];
    // while ($current <= $end) {
    //     $ketersediaan[] = date('H:i:s', $current);
    //     $current = strtotime('+60 minutes', $current);
    // }
    // foreach ($ketersediaan as $key => $value) {
    //     foreach ($detail_hari as $k => $dh) {
    //         if ($value >= $dh->start_jam && $value <= $dh->end_jam) {
    //             $detail_hari[$k]->ketersediaan .= $value.'-';
    //         }
    //     }
    // }
    // get ketersediaan
    // foreach ($detail_hari as $key => $value) {
    //     $value->ketersediaan = explode('-', $value->ketersediaan);
    //     $value->ketersediaan = array_filter($value->ketersediaan);
    // }
    // $detail_hari = collect($detail_hari)->toArray();
    // remove ketersediaan if any reservation
    // if (count($detail_reservasi) > 0) {
    //     // dd($detail_reservasi);
    //     // dd($detail_hari);
    //     $indexDeleted = [];
    //     foreach ($detail_hari as $k => $v) {
    //         $reservasi = collect($detail_reservasi)->filter(function($q) use ($v) {
    //             return $q['hari_id'] == $v['hari_id'];
    //         })->all();
    //         $detail_hari[$k]['ketersediaan'] = collect($v['ketersediaan'])->map(function($item, $key) use ($detail_hari, $reservasi, $indexDeleted) {
    //             $result = '';
    //             foreach ($reservasi as $ri => $rv) {
    //                 $result .= "$item";
    //                 if ($item >= $rv->start_jam && $item <= $rv->end_jam) {
    //                     // dd($item > $rv->start_jam);
    //                     // dd($item);
    //                     // dd($key);
    //                     // dd($rv->start_jam);
    //                     if ($item == $rv->start_jam || $item == $rv->end_jam) {
    //                         // unset([$key]);
    //                         // $result .= "$item";
    //                         // $detail_hari[$key]['ketersediaan'] = array_merge($detail_hari[$key]['ketersediaan'], [$v]);
    //                         // dd($detail_hari[$key]['ketersediaan'][$k]);
    //                         $result .= "#";
    //                         // unset($detail_hari[$key]['ketersediaan'][$k]);
    //                         // $detail_hari[$key]['ketersediaan'] = array_merge($detail_hari[$key]['ketersediaan'], [$v]);
    //                     } else if ($item > $rv->start_jam && $item < $rv->end_jam) {
    //                         // unset($value->ketersediaan[$k]);
    //                         $result .= "#";
    //                         // $indexDeleted[] = $key;
    //                         // unset($detail_hari[$key]['ketersediaan'][$k]);
    //                         // $detail_hari[$key]['ketersediaan'] = array_merge($detail_hari[$key]['ketersediaan'], [$v]);
    //                     }
    //                 }
    //             }
    //             return $result;
    //         })->toArray();
    //     }
    //     dd($detail_hari);
    // }
    $detail_tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$detail_mentor->id_detail_mentor)->get();
    return view('reservasi_user.pengajuan_reservasi_user', compact('detail_mentor','detail_skill','detail_hari','jml_ulasan','ulasan_mentor','detail_tipe_pengajaran'));
  }

  public function tampil_lebih_banyak(Request $request)
  {
      $banyak_ulasan = DB::connection()->select("select c.nama, c.path_fhoto, c.fhoto, DATE_FORMAT(a.created_at,'%d %M %Y') as tgl_ulas, a.ulasan, a.bintang
                                                 FROM ulasan_mentor a,
                                                      tbl_reservasi b,
                                                      master_user c
                                                 WHERE a.reservasi_id = b.id
                                                 AND b.user_id = c.id
                                                 AND b.mentor_id =:id_mentor",["id_mentor"=>$request->id_mentor]);
      return json_encode(['response'  => "success",
                          'banyak_ulasan'  => $banyak_ulasan]);

  }

  public function pengajuan_reservasi(Request $request, $id)
  {
      $data_mentor = tbl_detail_mentor::find($id);
      $hari = detail_hari::where('detail_mentor_id',$id)->get();
      // $hari = $hari->map(function($q) {
      //   $q->start_jam = str_replace(':','.', $q->start_jam);
      //   $q->end_jam = str_replace(':','.', $q->end_jam);
      //   return $q;
      // });
      $tipe_pengajaran = detail_tipe_pengajaran::where('detail_mentor_id',$id)->get();
      $kebutuhan = master_kebutuhan::whereIn('id',[1,2,3])->get();
      // keterisian berdasarkan status: Pembelajaran Sedang Berlangsung,Konfirmasi Mentor,Konfirmasi Admin
      $keterisian = tbl_reservasi::where('mentor_id',$id)->whereIn('status_id',[10,5,4])
        ->orderby('id','desc')
        ->get();

        $default = $request->default ?? '19:00';
        $interval = $request->interval ?? '+60 minutes';
        $output = [];

        $current = strtotime('00:00');
        $end = strtotime('23:59');

        foreach ($hari as $key => $value) {
            while ($current <= $end) {
                // if ($hari->start_jam > $current) {
                    $ketersediaan[] = date('H:i:s', $current);
                // }
                // if ($hari->end_jam < $end) {
                    // $ketersediaan[] = date('H.i', $current);
                // }
                $current = strtotime($interval, $current);
            }
        }
      return view('reservasi_user.mulai_pengajuan_user', compact('data_mentor','hari','tipe_pengajaran','kebutuhan','keterisian','ketersediaan'));
  }

  public function store(Request $request)
  {
      DB::beginTransaction();
      $sub_total = preg_replace("/[^0-9]/", "", $request->sub_total);
      if($request->kebutuhan == 99 && $request->kebutuhan_lainnya != null){
        $create_kebutuhan = new master_kebutuhan;
        $create_kebutuhan->kebutuhan = $request->kebutuhan_lainnya;
        $create_kebutuhan->save();
        $id_kebutuhan = $create_kebutuhan->id;
      }else{
        $id_kebutuhan = $request->kebutuhan;
      }
      $pengajuan_reservasi = new tbl_reservasi;
      $pengajuan_reservasi->user_id = auth()->user()->id;
      $pengajuan_reservasi->mentor_id = $request->id_mentor;
      $pengajuan_reservasi->kebutuhan_id = $id_kebutuhan;
      $pengajuan_reservasi->detail_kebutuhan = $request->spek_kebutuhan;
      $pengajuan_reservasi->jumlah_jam = $request->jumlah_jam;
      $pengajuan_reservasi->tipe_pengajaran_id = $request->tipe_pengajaran;
      $pengajuan_reservasi->total_biaya = $sub_total;
      $pengajuan_reservasi->status_id = 3;
      if($pengajuan_reservasi->save()){
        $hari = $request->hari_dibutuhkan;
        if (is_array($hari)) {
          $detail_hari = detail_hari::whereIn('id',$hari)->get();
        } else {
          $detail_hari = detail_hari::whereIn('id',[$hari])->get();
        }
        foreach($detail_hari as $key => $val){
          $detail_reservasi = new detail_reservasi;
          $detail_reservasi->reservasi_id = $pengajuan_reservasi->id;
          $detail_reservasi->hari_id = $val->hari_id;
          // $detail_reservasi->start_jam = str_replace('.00', ':', $request->time_start[$key]).'00:00';
          // $detail_reservasi->end_jam = str_replace('.00', ':', $request->time_end[$key]).'00:00';
          $detail_reservasi->start_jam = $request->time_start;
          $detail_reservasi->end_jam = $request->time_end;
          $detail_reservasi->tanggal = $request->date;
          $detail_reservasi->save();
        }
        DB::commit();
        return redirect('/cari_mentor')->with('success', 'Pengajuan Reservasi Anda Success !!!');
      }else{
        DB::rollback();
        return Redirect::back()->with('failed', 'Pengajuan Reservasi Anda Failed, Silahkan Cek Kembali Data Anda !!!');
      }
  }

  public function index()
  {
      $history_reservasi = tbl_reservasi::where('tbl_reservasi.user_id',auth()->user()->id)
                                      ->leftjoin('ulasan_mentor','ulasan_mentor.reservasi_id','=','tbl_reservasi.id')
                                      ->orderby('tbl_reservasi.id','desc')
                                      ->select('tbl_reservasi.*','ulasan_mentor.bintang','ulasan_mentor.ulasan')
                                      ->get();
      $tbl_informasi = tbl_informasi::all();
      return view('reservasi_user.history_reservasi', compact('history_reservasi','tbl_informasi'));
  }

  public function detail($id)
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
      return view('reservasi_user.detail_reservasi_user', compact('detail_reservasi','detail_mentor','detail_skill','jml_ulasan','detail_hari','detail_tipe_pengajaran','jadwal_reservasi'));
  }

  public function get_data_reservasi(Request $request)
  {
      $data_reservasi = tbl_reservasi::find($request->id_reservasi);
      return json_encode(['response'  => "success",
                          'data_reservasi'  => $data_reservasi]);
  }

  public function pembayaran(Request $request)
  {
      DB::beginTransaction();
      $bukti = $request->file('bukti_transfer');
      $tujuan_upload = 'Pembayaran_Reservasi';
      $sub_path = time();
      $upload = $bukti->getClientOriginalName();
      $extension =$bukti->getClientOriginalExtension();
      $path =$bukti->getRealPath();
      $bukti->move($tujuan_upload.'/'.$sub_path, $upload);

      $create_data_pembayaran = new pembayaran_reservasi;
      $create_data_pembayaran->bukti_transfer = $upload;
      $create_data_pembayaran->path_bukti = $sub_path;
      $create_data_pembayaran->atas_nama_pengirim = $request->atas_nama_pengirim;
      $create_data_pembayaran->asal_bank = $request->asal_bank;
      if($create_data_pembayaran->save()){
        $bayar = tbl_reservasi::find($request->id_reservasi);
        $bayar->pembayaran_id = $create_data_pembayaran->id;
        $bayar->status_id = 8;
        if($bayar->save()){
          DB::commit();
          return Redirect::back()->with('success', 'Upload Bukti Pembayaran Success, Mohon Menunggu Konfirmasi !!!');
        }else{
          DB::rollback();
          return Redirect::back()->with('failed', 'Upload Bukti Pembayaran Failed, Silahkan Cek Kembali Data Anda !!!');
        }
      }else{
        DB::rollback();
        return Redirect::back()->with('failed', 'Upload Bukti Pembayaran Failed, Silahkan Cek Kembali Data Anda !!!');
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

  public function get_data_mentor(Request $request)
  {
      $data_reservasi = tbl_reservasi::join('master_user','tbl_reservasi.mentor_id','=','master_user.id')
                                      ->leftjoin('tbl_detail_mentor','tbl_detail_mentor.user_id','=','master_user.id')
                                      ->join('master_gender','master_user.gender_id','=','master_gender.id')
                                      ->where('tbl_reservasi.id',$request->id_reservasi)
                                      ->select('tbl_reservasi.id as id_reservasi','tbl_detail_mentor.pengalaman_ngajar','tbl_detail_mentor.harga_perjam','master_user.*','master_gender.gender')
                                      ->first();
      return json_encode(['response'  => "success",
                          'data'  => $data_reservasi]);
  }

  public function ulasan(Request $request)
  {
    DB::beginTransaction();
    $ulas = new ulasan_mentor;
    $ulas->reservasi_id = $request->id_reservasi;
    $ulas->bintang = $request->jml_bintang;
    $ulas->ulasan = $request->ulasan;
    if($ulas->save()){
      $update = tbl_reservasi::find($request->id_reservasi);
      $update->status_id = 12;
      if($update->save()){
        DB::commit();
        return Redirect::back()->with('success', 'Ulas Hasil Pembelajaran Success, Terima Kasih !!!');
      }else{
        DB::rollback();
        return Redirect::back()->with('failed', 'Ulas Hasil Pembelajaran Failed, Silahkan Cek Kembali Data Anda !!!');
      }
    }else{
      DB::rollback();
      return Redirect::back()->with('failed', 'Ulas Hasil Pembelajaran Failed, Silahkan Cek Kembali Data Anda !!!');
    }
  }
}
