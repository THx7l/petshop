<?php

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Use_;

class Pet extends Model
{
    protected $fillable = [
        'user_id',
        'pet_name',
        'pet_gender',
        'pet_type',
        'pet_age'
    ];

    public function user()
    {
        return $this->belongsTo(Use_::class);
    }
}
