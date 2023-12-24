<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorAtj extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_atj';

    protected $fillable = [
      'name',
      'indicator_id',
     
    ];

    public function score()
    {
        return $this->hasMany(ScoreAtj::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreAtj::class, 'sub_indicator_id');
    }

  

    public function indicator(){
        return $this->belongsTo(IndicatorAtj::class, 'indicator_id');
    }
	
	
	
	
	
    public function cumulativeScoreAtj()
    {
        return $this->hasMany(ScoreAtj::class, 'sub_indicator_id');
    }
}
