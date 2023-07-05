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
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('first_name', 'LIKE', "%{$keyword}%")
            ->orWhere('last_name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%");
    }

    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }
}
