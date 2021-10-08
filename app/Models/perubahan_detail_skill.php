<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perubahan_detail_skill extends Model
{
    protected $table = 'perubahan_detail_skill';
    use HasFactory;

    public function skill()
    {
        return $this->belongsTo('App\Models\master_skill');
    }

    public function perubahan_detail_mentor()
    {
        return $this->belongsTo('App\Models\perubahan_detail_mentor');
    }
}
