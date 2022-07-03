<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'idsurfs',
        'id_city',
        'street',
        'lat',
        'long',
        'id_owner',
        'max_height',
        'wheelchair_access',
        'electric_car',
        'full_time',
        'schedules',
        'prices',
        'slug'
    ];

    protected $rules = [
        'idsurfs' => 'sometimes|required|idsurfs|unique:parkings',
    ];

    public function parking_images() {
        return $this->hasMany(ParkingImage::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function owner() {
        return $this->belongsTo(Owner::class);
    }
    
}
