<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreRkkkonsultan extends Model
{
    use HasFactory;

    protected $table = 'score_rkkkonsultan';
    protected $fillable = [
        'package_id',
        'evaluator_id',
        'sub_indicator_id',
        'score',
        'text',
        'file',
        'note'
    ];

    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function subIndicator(){
        return $this->belongsTo(SubIndicatorRkkkonsultan::class, 'sub_indicator_id');
    }
}
