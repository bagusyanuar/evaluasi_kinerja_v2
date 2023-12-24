<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPK extends Model
{
    use HasFactory;

    protected $table = 'ppk';

    protected $fillable = [
      'name'
    ];

    public function accessorppk()
    {
        return $this->hasMany(AccessorPPK::class, 'ppk_id');
    }

    public function package(){
        return $this->hasMany(Package::class,'ppk_id');
    }
}
