<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'master_user';

    public function level()
    {
        return $this->belongsTo('App\Models\master_level');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\master_gender');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\master_status');
    }

    public function detail_alamat()
    {
        return $this->belongsTo('App\Models\detail_alamat');
    }


    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
