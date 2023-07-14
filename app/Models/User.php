<?php

namespace App\Models;

use App\Interface\MustVerifyMobile as IMustVerifyMobile;
use App\Traits\MustVerifyMobile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements IMustVerifyMobile
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyMobile;

    protected string $username = 'mobile_number';

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'mobile_number',
        'mobile_verified_at',
        'mobile_verify_code',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mobile_verify_code',
    ];

    protected $casts = [
        'mobile_verified_at' => 'datetime',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('first_name', 'LIKE', "%{$keyword}%")
            ->orWhere('last_name', 'LIKE', "%{$keyword}%")
            ->orWhere('mobile_number', 'LIKE', "%{$keyword}%");
    }

    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }
}
