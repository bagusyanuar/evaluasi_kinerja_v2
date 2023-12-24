<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRkkkontraktor extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rkkkontraktor';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRkkkontraktor::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRkkkontraktor::class, 'sub_indicator_id');
    }

   

    public function indicator(){
        return $this->belongsTo(IndicatorRkkkontraktor::class, 'indicator_id');
    }
	
	
	
	
	
    public function cumulativeScore()
    {
        return $this->hasMany(ScoreRkkkontraktor::class, 'sub_indicator_id');
    }
}
