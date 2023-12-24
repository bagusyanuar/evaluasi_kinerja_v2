<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreHistory extends Model
{
    use HasFactory;
    protected $table = 'score_history';

    public function subIndicator(){
        return $this->belongsTo(SubIndicator::class, 'sub_indicator_id');
    }
    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }
}
