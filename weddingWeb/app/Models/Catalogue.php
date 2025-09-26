<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'package_name',
        'description',
        'price',
        'status_publish'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalogue()
    {
        return $this->hasMany(Order::class);
    }
}
