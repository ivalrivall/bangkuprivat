<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perubahan_detail_hari extends Model
{
    protected $table = 'perubahan_detail_hari';

    public function perubahan_detail_mentor()
    {
        return $this->belongsTo('App\Models\perubahan_detail_mentor');
    }

    public function hari()
    {
        return $this->belongsTo('App\Models\master_hari');
    }

    use HasFactory;
}
