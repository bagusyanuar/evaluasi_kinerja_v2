<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    protected $table = 'indicator';

    protected $fillable = [
        'name',
        'weight'
    ];

    public function subIndicator()
    {
        return $this->hasMany(SubIndicator::class, 'indicator_id');
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
