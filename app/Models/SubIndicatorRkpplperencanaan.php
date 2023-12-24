<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRkpplperencanaan extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rkpplperencanaan';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRkpplperencanaan::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRkpplperencanaan::class, 'sub_indicator_id');
    }

   
    public function indicator(){
        return $this->belongsTo(IndicatorRkpplperencanaan::class, 'indicator_id');
    }
	
    public function cumulativeScore()
    {
        return $this->hasMany(ScoreRkpplperencanaan::class, 'sub_indicator_id');
    }
}
