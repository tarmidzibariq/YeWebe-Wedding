<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'catalogue_id',
        'name',
        'email',
        'phone_number',
        'wedding_date',
        'status'
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
