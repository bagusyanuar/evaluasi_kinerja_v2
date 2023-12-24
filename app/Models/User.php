<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'roles',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles'             => 'array',
    ];

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'user_id');
    }

    public function accessorppk()
    {
        return $this->hasOne(AccessorPPK::class, 'user_id');
    }

    public function superuser()
    {
        return $this->hasOne(Superuser::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function accessor()
    {
        return $this->hasOne(Accessor::class, 'user_id');
    }

    public function package()
    {
        return $this->hasMany(Package::class, 'vendor_id');
    }

    public function packageVendorGoing()
    {
        return $this->hasMany(Package::class, 'vendor_id');
    }

    public function packageVendorPast()
    {
        return $this->hasMany(Package::class, 'vendor_id')->where('start_at', '>', date('Y-m-d', strtotime(now('Asia/Jakarta'))));
    }

    public function scopeVendor($query, $filter)
    {
        $query->when(
            $filter ?? false,
            function ($query, $filter) {
                return $query->whereHas(
                    'vendor',
                    function ($q) use ($filter) {
                        $q->where('name', 'like', '%'.$filter.'%');
                    }
                );
            }
        );
    }

}
