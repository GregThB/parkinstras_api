<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingData extends Model
{
    use HasFactory;

    protected $fillable = [
        'idsurfs',
        'state',
        'open',
        'total'
    ];

    public function parking() {
        return $this->belongsTo(Parking::class);
    }
}
