<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessorPPK extends Model
{
    use HasFactory;

    protected $table = 'accessor_ppk';

    protected $fillable = [
        'user_id',
        'name',
        'ppk_id'
    ];

    public function ppk()
    {
        return $this->belongsTo(PPK::class, 'ppk_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
