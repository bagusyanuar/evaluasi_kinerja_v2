<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorRkkkonsultan extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_rkkkonsultan';

    protected $fillable = [
      'name',
      'indicator_id',
    ];

    public function score()
    {
        return $this->hasMany(ScoreRkkkonsultan::class, 'sub_indicator_id');
    }

    public function singleScore()
    {
        return $this->hasOne(ScoreRkkkonsultan::class, 'sub_indicator_id');
    }

  

    public function indicator(){
        return $this->belongsTo(IndicatorRkkkonsultan::class, 'indicator_id');
    }
	
	
    public function cumulativeScore()
    {
        return $this->hasMany(ScoreRkkkonsultan::class, 'sub_indicator_id');
    }
}
