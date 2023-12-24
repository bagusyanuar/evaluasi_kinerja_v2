<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorPengawas extends Model
{
    use HasFactory;
    protected $table = 'indicator_pengawas';

    protected $fillable = [
        'name'
       
    ];

    public function subIndicatorPengawas()
    {
        return $this->hasMany(SubIndicatorPengawasclass, 'indicator_pengawas_id');
    }
	
	public function subsubIndicatorPengawas()
    {
        return $this->hasMany(SubsubIndicatorPengawas::class, 'indicator_pengawas_id');
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
