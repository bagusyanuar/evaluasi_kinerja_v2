<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessorPerencanaan extends Model
{
    use HasFactory;

    protected $table = 'accessor_perencanaan';

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
