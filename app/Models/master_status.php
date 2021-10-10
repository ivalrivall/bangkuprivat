<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_status extends Model
{
    // 1	Non Aktif
    // 2	Aktif
    // 3	Reservasi
    // 4	Konfirmasi Admin
    // 5	Konfirmasi Mentor
    // 6	Ditolak Admin
    // 7	Ditolak Mentor
    // 8	Pembayaran Reservasi
    // 9	Pembayaran DiTolak
    // 10	Pembelajaran Sedang Berlangsung
    // 11	Resolve
    // 12	Solve
    // 13	Pengajuan Sebagai Mentor DiTolak
    // 14	Pengajuan Perubahan Data Mentor
    // 15	Perubahan Data Mentor DiTerima
    // 16	Perubahan Data Mentor DiTolak
    protected $table = 'master_status';
    use HasFactory;
}
