<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRkpplkontraktor extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rkpplkontraktor';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRkpplkontraktor::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRkpplkontraktor::class, 'sub_indicator_id');
    }

   
    public function indicator(){
        return $this->belongsTo(IndicatorRkpplkontraktor::class, 'indicator_id');
    }

	
    public function cumulativeScore()
    {
        return $this->hasMany(ScoreRkpplkontraktor::class, 'sub_indicator_id');
    }
}
