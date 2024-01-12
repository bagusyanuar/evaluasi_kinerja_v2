<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id',
        'name',
        'index',
        'roles'
    ];

    protected $casts = [
        'roles'             => 'array',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function indicators()
    {
        return $this->hasMany(StageIndicator::class, 'sub_stage_id');
    }
}
