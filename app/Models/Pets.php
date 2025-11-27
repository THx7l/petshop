<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pets extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'pet_name',
        'pet_gender', 
        'pet_type',
        'pet_age'
    ];

    protected $dates = ['deleted_at'];

    //Relação belongsTo com User, porque precisa dela aqui?
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}