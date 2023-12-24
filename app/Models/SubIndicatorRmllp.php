<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRmllp extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rmllp';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function scoreRmllp()
    {
        return $this->hasMany(ScoreRmllp::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRmllp::class, 'sub_indicator_id');
    }

    
    public function indicatorRmllp(){
        return $this->belongsTo(IndicatorRmllp::class, 'indicator_id');
    }
	
	
    public function cumulativeScoreRmllp()
    {
        return $this->hasMany(ScoreRmllp::class, 'sub_indicator_id');
    }
}
