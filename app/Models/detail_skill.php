<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_skill extends Model
{
    protected $table = 'detail_skill';
    use HasFactory;

    public function skill()
    {
        return $this->belongsTo('App\Models\master_skill');
    }

    public function detail_mentor()
    {
        return $this->belongsTo('App\Models\tbl_detail_mentor');
    }
}
