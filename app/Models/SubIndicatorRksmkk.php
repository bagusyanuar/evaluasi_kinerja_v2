<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRksmkk extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rksmkk';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRksmkk::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRksmkk::class, 'sub_indicator_id');
    }

   

    public function indicator(){
        return $this->belongsTo(IndicatorRksmkk::class, 'indicator_id');
    }
	
	
    public function cumulativeScoreRksmkk()
    {
        return $this->hasMany(ScoreRksmkk::class, 'sub_indicator_id');
    }
}
