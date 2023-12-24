<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'index'
    ];

    public function sub_stages()
    {
        return $this->hasMany(SubStage::class, 'stage_id');
    }
}
