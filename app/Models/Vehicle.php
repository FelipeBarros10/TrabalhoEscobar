<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'brand_id',
        'vehicle_model_id',
        'color_id',
        'year',
        'mileage',
        'price',
        'description',
        'main_image_url',
        'created_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function photos()
    {
        return $this->hasMany(VehiclePhoto::class);
    }

    public function primaryPhoto()
    {
        return $this->hasOne(VehiclePhoto::class)->where('is_primary', true);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

