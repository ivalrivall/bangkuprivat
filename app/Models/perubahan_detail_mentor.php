<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perubahan_detail_mentor extends Model
{
    protected $table = 'perubahan_detail_mentor';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
