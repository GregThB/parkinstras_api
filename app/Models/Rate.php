<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'mark',
        'user_id',
        'parking_id'
    ];

    public function parking() {
        return $this->belongsTo(Parking::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
