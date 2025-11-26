<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'last_login'
    ];

    protected $dates = ['deleted_at'];

    // CORREÇÃO: Relação hasMany com Pets
    public function pets()
    {
        return $this->hasMany(Pets::class, 'user_id');
    }
}