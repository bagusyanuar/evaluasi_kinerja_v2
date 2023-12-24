<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreSMKKV2 extends Model
{
    use HasFactory;

    protected $table = 'score_smkkv2';

    protected $fillable = [
        'package_id',
        'evaluator_id',
        'stage_sub_indicator_id',
        'score',
        'score_text',
        'note_ppk',
        'note_balai',
        'file'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function stage_sub_indicator()
    {
        return $this->belongsTo(StageSubIndicator::class, 'stage_sub_indicator_id');
    }
}
