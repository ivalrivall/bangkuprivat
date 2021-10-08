<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_reservasi extends Model
{
    use HasFactory;
    protected $table = 'detail_reservasi';

    public function reservasi()
    {
        return $this->belongsTo('App\Models\tbl_reservasi');
    }

    public function hari()
    {
        return $this->belongsTo('App\Models\master_hari');
    }

}
