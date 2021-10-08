<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perubahan_detail_tipe_pengajaran extends Model
{
    protected $table = 'perubahan_detail_tipe_pengajaran';

    public function perubahan_detail_mentor()
    {
        return $this->belongsTo('App\Models\perubahan_detail_mentor');
    }

    public function tipe_pengajaran()
    {
        return $this->belongsTo('App\Models\master_tipe_pengajaran');
    }

    use HasFactory;
}
