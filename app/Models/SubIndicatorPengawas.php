<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubIndicatorPengawas extends Model
{
    use HasFactory;
    protected $table = 'sub_indicator_pengawas';

    protected $fillable = [
      'name',
      'indicator_pengawas_id'
      
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
	public function subsubIndicatorPengawas()
    {
        return $this->hasMany(SubsubIndicatorPengawas::class, 'sub_indicator_pengawas_id');
    } 
	
    public function indicatorPengawas(){
        return $this->belongsTo(IndicatorPengawas::class, 'indicator_pengawas_id');
    }
	
/*     public function cumulativeScore()
    {
        return $this->hasMany(Score::class, 'sub_indicator_id');
    } */
}
