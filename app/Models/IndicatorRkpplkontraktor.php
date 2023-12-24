<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorRkpplkontraktor extends Model
{
    use HasFactory;
    protected $table = 'indicator_rkpplkontraktor';

    protected $fillable = [
        'name',
        'weight'
    ];

    public function subIndicator()
    {
        return $this->hasMany(SubIndicatorRkpplkontraktor::class, 'indicator_id');
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
