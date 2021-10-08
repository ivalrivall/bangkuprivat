<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_skill extends Model
{
    protected $table = 'master_skill';

    public function masterstatus()
    {
        return $this->belongsTo('App\Models\master_status');
    }
    use HasFactory;
}
