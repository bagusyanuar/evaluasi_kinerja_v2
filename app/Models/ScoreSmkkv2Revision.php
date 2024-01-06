<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreSmkkv2Revision extends Model
{
    protected $table = 'score_smkkv2_revisions';

    protected $fillable = [
        'score_smkkv2_id',
        'package_id',
        'stage_sub_indicator_id',
        'name',
        'file'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function score()
    {
        return $this->belongsTo(ScoreSMKKV2::class, 'score_smkkv2_id');
    }

    public function stage_sub_indicator()
    {
        return $this->belongsTo(StageSubIndicator::class, 'stage_sub_indicator_id');
    }
}
