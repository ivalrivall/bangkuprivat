<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ulasan_mentor extends Model
{
    protected $table = 'ulasan_mentor';

    public function reservasi()
    {
        return $this->belongsTo('App\Models\tbl_reservasi');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function detail_mentor()
    {
        return $this->belongsTo('App\Models\tbl_detail_mentor');
    }
    use HasFactory;
}
