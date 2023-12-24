<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorSmkk extends Model
{
    use HasFactory;
    protected $table = 'indicator_smkk';

    protected $fillable = [
        'name'
       
    ];

    public function subIndicatorSmkk()
    {
        return $this->hasMany(SubIndicatorSmkk::class, 'indicator_smkk_id');
    }
	
	public function subsubIndicatorSmkk()
    {
        return $this->hasMany(SubsubIndicatorSmkk::class, 'indicator_smkk_id');
    }
	
    public function scopeFilter($query, $filter)
    {
        $query->when(
            $filter ?? false,
            function ($query, $filter) {
                return $query->where('name', 'like', '%'.$filter.'%');
            }
        );
    }
}
