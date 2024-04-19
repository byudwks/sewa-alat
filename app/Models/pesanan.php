<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{

    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['post' , 'user'];


    public function scopefilter($query, array $filters) {
        $query->when($filters['searchOrder'] ?? false, function($query, $searchOrder) {
            return $query->where('tanggal_pinjam', '>=', $searchOrder);
       });

    //     $query->when($filters['searchOrder2'] ?? false, function($query, $searchOrder2) {
    //         return $query->orWhere('tanggal_pinjam', '<=', $searchOrder2);
    //    });
    }

    public function post() 
    {
        return $this->belongsTo(post::class);
    }
    public function user() 
    {
        return $this->belongsTo(user::class);
    }
}
