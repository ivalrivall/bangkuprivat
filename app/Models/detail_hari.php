<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_hari extends Model
{
    protected $table = 'detail_hari';

    public function detail_mentor()
    {
        return $this->belongsTo('App\Models\tbl_detail_mentor');
    }

    public function hari()
    {
        return $this->belongsTo('App\Models\master_hari');
    }

    use HasFactory;
}
