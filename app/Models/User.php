<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes; // o "use" deve ser minúsculo

    protected $fillable = [
        'username',
        'password'
    ];
}
