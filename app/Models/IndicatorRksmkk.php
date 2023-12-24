<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorRksmkk extends Model
{
    use HasFactory;
    protected $table = 'indicator_rksmkk';

    protected $fillable = [
        'name',
       
    ];

    public function subIndicator()
    {
        return $this->hasMany(SubIndicatorRksmkk::class, 'indicator_id');
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
