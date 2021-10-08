<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_reservasi extends Model
{
    protected $table = 'tbl_reservasi';
    use HasFactory;

    public function kebutuhan()
    {
        return $this->belongsTo('App\Models\master_kebutuhan');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\master_status');
    }

    public function hari()
    {
        return $this->belongsTo('App\Models\master_hari');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function mentor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pembayaran()
    {
        return $this->belongsTo('App\Models\pembayaran_reservasi');
    }

    public function tipe_pengajaran()
    {
        return $this->belongsTo('App\Models\master_tipe_pengajaran');
    }
}
