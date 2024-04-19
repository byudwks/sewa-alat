<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pesanan()
    {
        return $this->hasMany(pesanan::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
