<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'kualifikasi',
        'npwp',
        'iujk',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package(){
        return $this->hasMany(Package::class, 'vendor_id');
    }
}
