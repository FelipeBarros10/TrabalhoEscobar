<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'brand_id',
        'name',
    ];

    /**
     * Parent brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Vehicles that use this model.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}

