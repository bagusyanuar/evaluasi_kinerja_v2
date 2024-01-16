<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessorPengawasan extends Model
{
    use HasFactory;

    protected $table = 'accessor_pengawasan';

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
