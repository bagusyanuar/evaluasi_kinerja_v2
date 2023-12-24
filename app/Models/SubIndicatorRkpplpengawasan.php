<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRkpplpengawasan extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rkpplpengawasan';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRkpplpengawasan::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRkpplpengawasan::class, 'sub_indicator_id');
    }

  
    public function indicator(){
        return $this->belongsTo(IndicatorRkpplpengawasan::class, 'indicator_id');
    }
	
    public function cumulativeScore()
    {
        return $this->hasMany(ScoreRkpplpengawasan::class, 'sub_indicator_id');
    }
}
