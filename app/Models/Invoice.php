<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'year', 'month', 'user_id'];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('invoices.name', 'LIKE', "%{$keyword}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
