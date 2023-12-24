<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageSubIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_indicator_id',
        'name',
        'index'
    ];

    public function indicator()
    {
        return $this->belongsTo(StageIndicator::class, 'stage_indicator_id');
    }

    public function score()
    {
        return $this->hasOne(ScoreSMKKV2::class, 'stage_sub_indicator_id');
    }
}
