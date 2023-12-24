<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_stage_id',
        'name',
        'index'
    ];

    public function sub_stage()
    {
        return $this->belongsTo(SubStage::class, 'sub_stage_id');
    }

    public function sub_indicators()
    {
        return $this->hasMany(StageSubIndicator::class, 'stage_indicator_id');
    }
}
