<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRmpkpm extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rmpkpm';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function scoreRmpkpm()
    {
        return $this->hasMany(ScoreRmpkpm::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRmpkpm::class, 'sub_indicator_id');
    }

    public function indicatorRmpkpm(){
        return $this->belongsTo(IndicatorRmpkpm::class, 'indicator_id');
    }
	
	
	
    public function cumulativeScoreRmpkpm()
    {
        return $this->hasMany(ScoreRmpkpm::class, 'sub_indicator_id');
    }
}
