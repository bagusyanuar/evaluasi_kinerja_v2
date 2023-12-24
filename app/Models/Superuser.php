<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superuser extends Model
{
    use HasFactory;

    protected $table = 'superuser';

    protected $fillable = [
        'user_id',
        'name'
    ];
}
