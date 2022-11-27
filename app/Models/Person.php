<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'user_id',
        'name',
        'email'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
