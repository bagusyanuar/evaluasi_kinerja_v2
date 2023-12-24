<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorSmkk extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_smkk';

    protected $fillable = [
      'name',
      'indicator_smkk_id'
      
    ];

   /*  public function score()
    {
        return $this->hasMany(Score::class, 'sub_indicator_id');
    } */

  /*   public function singleScore()
    {
        return $this->hasOne(Score::class, 'sub_indicator_id');
    } */

   /*  public function scoreHistory()
    {
        return $this->hasMany(ScoreHistory::class, 'sub_indicator_id');
    } */

	public function subsubIndicatorSmkk()
    {
        return $this->hasMany(SubsubIndicatorSmkk::class, 'sub_indicator_smkk_id');
    } 
	
    public function indicatorSmkk(){
        return $this->belongsTo(IndicatorSmkk::class, 'indicator_smkk_id');
    }
	
/*     public function cumulativeScore()
    {
        return $this->hasMany(Score::class, 'sub_indicator_id');
    } */
}
